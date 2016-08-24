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
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Geocoder\Request\AbstractGeocoderRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderCoordinateRequest;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceTest extends AbstractServiceTest
{
    /**
     * @var GeocoderService
     */
    private $geocoder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        //sleep(2);

        parent::setUp();

        $this->geocoder = new GeocoderService($this->getClient(), $this->getMessageFactory());
    }

    public function testGeocodeAddress()
    {
        $response = $this->geocoder->geocode($this->createRequest());

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeAddressWithComponents()
    {
        $request = new GeocoderAddressRequest('Grand place');
        $request->setComponents([
            GeocoderComponentType::COUNTRY     => 'fr',
            GeocoderComponentType::POSTAL_CODE => 59800,
        ]);

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeAddressWithBound()
    {
        $request = $this->createRequest();
        $request->setBound(new Bound(new Coordinate(48.815573, 2.224199), new Coordinate(48.9021449, 2.4699208)));

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeAddressWithRegion()
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeAddressWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('pl');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocoderCoordinate()
    {
        $request = new GeocoderCoordinateRequest(new Coordinate(48.865475, 2.321118));
        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocoderCoordinateWithLanguage()
    {
        $request = new GeocoderCoordinateRequest(new Coordinate(48.865475, 2.321118));
        $request->setLanguage('fr');

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithHttp()
    {
        $this->geocoder->setHttps(false);

        $response = $this->geocoder->geocode($this->createRequest());

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithXmlFormat()
    {
        $this->geocoder->setFormat(GeocoderService::FORMAT_XML);

        $response = $this->geocoder->geocode($this->createRequest());

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithKey()
    {
        $this->geocoder = new GeocoderService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->geocoder->setKey('api-key');

        $request = $this->createGeocoderRequestMock();
        $request
            ->expects($this->once())
            ->method('build')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo(
                    $url = 'https://maps.googleapis.com/maps/api/geocode/json?foo=bar&key=api-key'
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

        $response = $this->geocoder->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getResults());
    }

    public function testGeocodeWithBusinessAccount()
    {
        $this->geocoder = new GeocoderService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createGeocoderRequestMock();
        $request
            ->expects($this->once())
            ->method('build')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo(
                    $url = 'https://maps.googleapis.com/maps/api/geocode/json?foo=bar&signature=signature'
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

    /**
     * @return GeocoderAddressRequest
     */
    private function createRequest()
    {
        return new GeocoderAddressRequest('Paris');
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
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractGeocoderRequest
     */
    private function createGeocoderRequestMock()
    {
        return $this->createMock(AbstractGeocoderRequest::class);
    }
}
