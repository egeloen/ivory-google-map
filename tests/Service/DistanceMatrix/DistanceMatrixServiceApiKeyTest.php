<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceApiKeyTest extends DistanceMatrixServiceTest
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
    public function testProcessWithCoordinates($format)
    {
        $request = new DistanceMatrixRequest(
            [new CoordinateLocation(new Coordinate(49.262428, -123.113136))],
            [new CoordinateLocation(new Coordinate(37.775328, -122.418938))]
        );

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithDepartureTime($format)
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithArrivalTime($format)
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithTravelMode($format)
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::BICYCLING);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAvoid($format)
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithRegion($format)
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithUnitSystem($format)
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::IMPERIAL);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithLanguage($format)
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithPlaceIds($format)
    {
        $request = new DistanceMatrixRequest(
            [new PlaceIdLocation('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c')],
            [new PlaceIdLocation('ChIJC_jkvdJv5kcRNX4NW3iuID8')]
        );

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
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

        $this->service->process($this->createRequest());
    }

    /**
     * @return \DateTime
     */
    private function getDepartureTime()
    {
        return $this->getDateTime('departure', '+1 hour');
    }

    /**
     * @return \DateTime
     */
    private function getArrivalTime()
    {
        return $this->getDateTime('arrival', '+4 hours');
    }
}
