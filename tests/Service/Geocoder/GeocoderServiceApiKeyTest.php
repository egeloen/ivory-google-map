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

use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceApiKeyTest extends GeocoderServiceTest
{
    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testGeocodePlaceId()
    {
        $request = new GeocoderPlaceIdRequest('ChIJLU7jZClu5kcR4PcOOO6p3I0');

        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }

    /**
     *
     */
    public function testGeocodeWithResultType()
    {
        $request = $this->createCoordinateRequest();
        $request->setResultTypes([GeocoderAddressType::POSTAL_CODE]);

        $response = $this->service->geocode($request);

        $this->assertGeocoderResponse($response, $request);
    }
}
