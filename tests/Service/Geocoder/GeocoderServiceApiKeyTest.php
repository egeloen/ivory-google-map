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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceApiKeyTest extends GeocoderServiceTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithComponents($format)
    {
        $request = new GeocoderAddressRequest('Grand place');
        $request->setComponents([
            GeocoderComponentType::COUNTRY     => 'fr',
            GeocoderComponentType::POSTAL_CODE => 59800,
        ]);

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithBound($format)
    {
        $request = $this->createAddressRequest();
        $request->setBound(new Bound(
            new Coordinate(48.815573, 2.224199),
            new Coordinate(48.9021449, 2.4699208)
        ));

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithRegion($format)
    {
        $request = $this->createAddressRequest();
        $request->setRegion('fr');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeAddressWithLanguage($format)
    {
        $request = $this->createAddressRequest();
        $request->setLanguage('pl');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocoderCoordinate($format)
    {
        $request = $this->createCoordinateRequest();

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocoderCoordinateWithLanguage($format)
    {
        $request = $this->createCoordinateRequest();
        $request->setLanguage('pl');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodePlaceId($format)
    {
        $request = new GeocoderPlaceIdRequest('ChIJLU7jZClu5kcR4PcOOO6p3I0');

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testGeocodeWithResultType($format)
    {
        $request = $this->createCoordinateRequest();
        $request->setResultTypes([GeocoderAddressType::POSTAL_CODE]);

        $this->service->setFormat($format);
        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     *
     * @expectedException \Http\Client\Common\Exception\ClientErrorException
     * @expectedExceptionMessage REQUEST_DENIED
     */
    public function testErrorRequest($format)
    {
        $this->service->setFormat($format);
        $this->service->setKey('invalid');

        $this->service->geocode($this->createAddressRequest());
    }
}
