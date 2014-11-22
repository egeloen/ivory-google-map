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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;
use Ivory\GoogleMap\Services\Geocoding\GeocoderStatus;
use Ivory\HttpAdapter\SocketHttpAdapter;

/**
 * Geocoder provider test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderProviderTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderProvider */
    private $geocoderProvider;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderProvider = new GeocoderProvider(new SocketHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderProvider);
    }

    public function testInheritance()
    {
        $this->assertServiceInstance($this->geocoderProvider);
    }

    public function testSetMaxResults()
    {
        $this->assertSame($this->geocoderProvider, $this->geocoderProvider->setMaxResults(10));
    }

    /**
     * @dataProvider geocodedDataProvider
     */
    public function testGeocodedDataWithJsonFormat($request)
    {
        $response = $this->geocoderProvider->getGeocodedData($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    /**
     * @dataProvider geocodedDataProvider
     */
    public function testGeocodedDataWithXmlFormat($request)
    {
        $this->geocoderProvider->setFormat(GeocoderProvider::FORMAT_XML);
        $response = $this->geocoderProvider->getGeocodedData($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodedDataWithInvalidRequest()
    {
        $response = $this->geocoderProvider->getGeocodedData(new GeocoderRequest(''));

        $this->assertSame(GeocoderStatus::ZERO_RESULTS, $response->getStatus());
        $this->assertEmpty($response->getResults());
    }

    /**
     * @dataProvider reversedDataProvider
     */
    public function testReversedData($longitude, $latitude)
    {
        $response = $this->geocoderProvider->getReversedData(array($longitude, $latitude));

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getResults());
    }

    public function testReversedDataWithInvalidRequest()
    {
        $response = $this->geocoderProvider->getReversedData(array('foo', 'bar'));

        $this->assertSame(GeocoderStatus::ZERO_RESULTS, $response->getStatus());
        $this->assertEmpty($response->getResults());
    }

    public function testGetName()
    {
        $this->assertSame('ivory_google_map', $this->geocoderProvider->getName());
    }

    /**
     * Gets the geocoded data provider.
     *
     * @return array The geocoded data provider.
     */
    public function geocodedDataProvider()
    {
        $addressRequest = new GeocoderRequest('Paris');
        $coordinateRequest = new GeocoderRequest(new Coordinate(48.815573, 2.224199));
        $ipRequest = new GeocoderRequest('111.111.111.111');

        $boundRequest = new GeocoderRequest('Paris');
        $boundRequest->setBound(new Bound(new Coordinate(48.815573, 2.224199), new Coordinate(48.9021449, 2.4699208)));

        $regionRequest = new GeocoderRequest('Paris');
        $regionRequest->setRegion('FR');

        $languageRequest = new GeocoderRequest('Paris');
        $languageRequest->setLanguage('PL');

        return array(
            array($addressRequest),
            array($coordinateRequest),
            array($ipRequest),
            array($boundRequest),
            array($regionRequest),
            array($languageRequest),
        );
    }

    /**
     * Gets the reversed data provider.
     *
     * @return array The reversed data provider.
     */
    public function reversedDataProvider()
    {
        return array(
            array(48.856633, 2.352254),
        );
    }
}
