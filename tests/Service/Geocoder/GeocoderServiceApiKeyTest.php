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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressType;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderCoordinateRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceApiKeyTest extends AbstractServiceTest
{
    /**
     * @var GeocoderService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        //sleep(2);

        parent::setUp();

        $this->service = new GeocoderService($this->getClient(), $this->getMessageFactory());
        $this->service->setKey($_SERVER['API_KEY']);
    }

    public function testGeocodePlaceId()
    {
        $response = $this->service->geocode($request = new GeocoderPlaceIdRequest('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c'));

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
    }

    public function testGeocodeWithResultType()
    {
        $request = new GeocoderCoordinateRequest(new Coordinate(50.637004, 3.063646));
        $request->setResultTypes([GeocoderAddressType::POSTAL_CODE]);

        $response = $this->service->geocode($request);

        $this->assertSame(GeocoderStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
    }
}
