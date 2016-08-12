<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Geocoder\GeocoderProvider;
use Ivory\GoogleMap\Service\Geocoder\GeocoderRequest;
use Ivory\GoogleMap\Service\Geocoder\GeocoderStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderProviderTest extends AbstractServiceTest
{
    /**
     * @var GeocoderProvider
     */
    private $geocoder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->geocoder = new GeocoderProvider($this->getClient(), $this->getMessageFactory());
    }

    public function testLimit()
    {
        $this->geocoder->limit($limit = 1);

        $this->assertSame($limit, $this->geocoder->getLimit());
    }

    public function testLocale()
    {
        $this->geocoder->setLocale($locale = 'fr');

        $this->assertSame($locale, $this->geocoder->getLocale());
    }

    public function testGeocode()
    {
        $response = $this->geocoder->geocode('Paris');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithIp()
    {
        $response = $this->geocoder->geocode('66.249.64.1');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithRequest()
    {
        $request = new GeocoderRequest('Paris');
        $request->setBound(new Bound(new Coordinate(48.815573, 2.224199), new Coordinate(48.9021449, 2.4699208)));
        $request->setRegion('fr');
        $request->setLanguage('pl');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithBound()
    {
        $request = new GeocoderRequest('Paris');
        $request->setBound(new Bound(new Coordinate(48.815573, 2.224199), new Coordinate(48.9021449, 2.4699208)));

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithRegion()
    {
        $request = new GeocoderRequest('Paris');
        $request->setRegion('fr');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithLanguage()
    {
        $request = new GeocoderRequest('Paris');
        $request->setLanguage('pl');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithHttps()
    {
        $this->geocoder->setHttps(true);

        $response = $this->geocoder->geocode('Paris');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithXmlFormat()
    {
        $this->geocoder->setFormat(GeocoderProvider::FORMAT_XML);
        $response = $this->geocoder->geocode('Paris');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithLimit()
    {
        $this->geocoder->limit(1);
        $response = $this->geocoder->geocode('Chelsea, New York, NY, USA');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertCount(1, $response->getResults());
    }

    public function testGeocodeWithLocale()
    {
        $this->geocoder->setLocale('fr');
        $response = $this->geocoder->geocode('Paris');

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithBusinessAccount()
    {
        $this->geocoder = new GeocoderProvider(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createGeocoderRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo(
                    $url = 'https://maps.googleapis.com/maps/api/geocoder/json?foo=bar&signature=signature'
                )
            )
            ->will($this->returnValue($httpRequest = $this->createHttpRequestMock()));

        $client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->identicalTo($httpRequest))
            ->will($this->returnValue($httpResponse = $this->createHttpResponseMock()));

        $httpResponse
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($httpStream = $this->createHttpStreamMock()));

        $httpStream
            ->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue('{"status":"OK","results":[]}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/geocode/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->geocoder->setBusinessAccount($businessAccount);

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getResults());
    }

    public function testReverse()
    {
        $response = $this->geocoder->reverse(48.856633, 2.352254);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testReverseWithXmlFormat()
    {
        $this->geocoder->setFormat(GeocoderProvider::FORMAT_XML);

        $response = $this->geocoder->reverse(48.856633, 2.352254);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testName()
    {
        $this->assertSame('ivory_google_map', $this->geocoder->getName());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClient
     */
    private function createHttpClientMock()
    {
        return $this->createMock(HttpClient::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MessageFactory
     */
    private function createMessageFactoryMock()
    {
        return $this->createMock(MessageFactory::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequestInterface
     */
    private function createHttpRequestMock()
    {
        return $this->createMock(RequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    private function createHttpResponseMock()
    {
        return $this->createMock(ResponseInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StreamInterface
     */
    private function createHttpStreamMock()
    {
        return $this->createMock(StreamInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BusinessAccount
     */
    private function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GeocoderRequest
     */
    private function createGeocoderRequestMock()
    {
        return $this->createMock(GeocoderRequest::class);
    }
}
