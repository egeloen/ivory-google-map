<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding;

use Geocoder\HttpAdapter\CurlHttpAdapter;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;

/**
 * Geocoder provider test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderProvider */
    protected $geocoderProvider;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderProvider = new GeocoderProvider(new CurlHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderProvider);
    }

    public function testInitialState()
    {
        $this->assertSame('http://maps.googleapis.com/maps/api/geocode', $this->geocoderProvider->getUrl());
        $this->assertFalse($this->geocoderProvider->isHttps());
        $this->assertSame('json', $this->geocoderProvider->getFormat());
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Utils\XmlParser', $this->geocoderProvider->getXmlParser());
        $this->assertFalse($this->geocoderProvider->hasBusinessAccount());
        $this->assertNull($this->geocoderProvider->getBusinessAccount());
    }

    public function testUrlWithValieValue()
    {
        $this->geocoderProvider->setUrl('http://foo');

        $this->assertSame('http://foo', $this->geocoderProvider->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder provider url must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->geocoderProvider->setUrl(true);
    }

    public function testHttpsWithValidValue()
    {
        $this->geocoderProvider->setHttps(true);

        $this->assertTrue($this->geocoderProvider->isHttps());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder provider https flag must be a boolean value.
     */
    public function testHttpsWithInvalidValue()
    {
        $this->geocoderProvider->setHttps('foo');
    }

    public function testUrlWithHttps()
    {
        $this->geocoderProvider->setUrl('http://foo');
        $this->geocoderProvider->setHttps(true);

        $this->assertSame('https://foo', $this->geocoderProvider->getUrl());
    }

    public function testFormatWithJsonValue()
    {
        $this->geocoderProvider->setFormat('json');

        $this->assertSame('json', $this->geocoderProvider->getFormat());
    }

    public function testFormatWithXmlFormat()
    {
        $this->geocoderProvider->setFormat('xml');

        $this->assertSame('xml', $this->geocoderProvider->getFormat());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder provider format can only be : json, xml.
     */
    public function testFormatWithInvalidValue()
    {
        $this->geocoderProvider->setFormat('foo');
    }

    public function testXmlParser()
    {
        $xmlParser = $this->getMock('Ivory\GoogleMap\Services\Utils\XmlParser');
        $this->geocoderProvider->setXmlParser($xmlParser);

        $this->assertSame($xmlParser, $this->geocoderProvider->getXmlParser());
    }

    public function testBusinessAccount()
    {
        $businessAccount = $this->getMockBuilder('Ivory\GoogleMap\Services\BusinessAccount')
            ->disableOriginalConstructor()
            ->getMock();

        $this->geocoderProvider->setBusinessAccount($businessAccount);

        $this->assertTrue($this->geocoderProvider->hasBusinessAccount());
        $this->assertSame($businessAccount, $this->geocoderProvider->getBusinessAccount());

        $this->geocoderProvider->setBusinessAccount();

        $this->assertFalse($this->geocoderProvider->hasBusinessAccount());
        $this->assertNull($this->geocoderProvider->getBusinessAccount());
    }

    public function testGeocodedDataWithAddress()
    {
        $response = $this->geocoderProvider->getGeocodedData('Paris');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    public function testGeocdedDataWithIp()
    {
        $response = $this->geocoderProvider->getGeocodedData('111.111.111.111');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    public function testGeocodedDataWithGeocoderRequest()
    {
        $request = new GeocoderRequest();
        $request->setAddress('Paris');
        $request->setBound(48.815573, 2.224199, 48.9021449, 2.4699208);
        $request->setRegion('FR');
        $request->setLanguage('PL');

        $response = $this->geocoderProvider->getGeocodedData($request);

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    public function testGeocodedDataWithXmlFormat()
    {
        $this->geocoderProvider->setFormat('xml');
        $response = $this->geocoderProvider->getGeocodedData('Paris');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geolocate argument is invalid.
     * The available prototypes are :
     * - function geocode(string $address)
     * - function geocode(Ivory\GoogleMap\Services\Geocoding\GeocoderRequest $request)
     */
    public function testGeocodedDataWithInvalidValue()
    {
        $this->geocoderProvider->getGeocodedData(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request is not valid. It needs at least an address or a coordinate.
     */
    public function testGeocodedDataWithInvalidGeocoderRequest()
    {
        $request = new GeocoderRequest();

        $this->geocoderProvider->getGeocodedData($request);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The service result is not valid.
     */
    public function testGeocodedDataWithInvalidResult()
    {
        $httpAdapterMock = $this->getMock('Geocoder\HttpAdapter\HttpAdapterInterface');
        $httpAdapterMock
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $this->geocoderProvider = new GeocoderProvider($httpAdapterMock);
        $this->geocoderProvider->getGeocodedData('Paris');
    }

    public function testReversedData()
    {
        $response = $this->geocoderProvider->getReversedData(array(48.856633, 2.352254));

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    public function testSignUrlWithoutBusinessAccount()
    {
        $method = new \ReflectionMethod($this->geocoderProvider, 'signUrl');
        $method->setAccessible(true);

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $this->assertSame($url, $method->invoke($this->geocoderProvider, $url));
    }

    public function testSignUrlWithBusinessAccount()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $businessAccount = $this->getMockBuilder('Ivory\GoogleMap\Services\BusinessAccount')
            ->disableOriginalConstructor()
            ->getMock();

        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo($url))
            ->will($this->returnValue('url'));

        $this->geocoderProvider->setBusinessAccount($businessAccount);

        $method = new \ReflectionMethod($this->geocoderProvider, 'signUrl');
        $method->setAccessible(true);

        $this->assertSame('url', $method->invoke($this->geocoderProvider, $url));
    }

    public function testName()
    {
        $this->assertSame('ivory_google_map', $this->geocoderProvider->getName());
    }
}
