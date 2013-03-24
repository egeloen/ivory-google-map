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

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The method "Ivory\GoogleMap\Services\Geocoding\GeocoderProvider::parseXML" is not
     * supported.
     */
    public function testGeocodedDataWithXmlFormat()
    {
        $this->geocoderProvider->setFormat('xml');
        $this->geocoderProvider->getGeocodedData('Paris');
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

    public function testReversedData()
    {
        $response = $this->geocoderProvider->getReversedData(array(48.856633, 2.352254));

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse', $response);

        $this->assertNotEmpty($response->getResults());
        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
    }

    public function testName()
    {
        $this->assertSame('ivory_google_map', $this->geocoderProvider->getName());
    }
}
