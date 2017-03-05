<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionServiceApiKeyTest extends DirectionServiceTest
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
    public function testRouteWithCoordinates($format)
    {
        $request = new DirectionRequest(
            new CoordinateLocation(new Coordinate(48.873491, 2.295929)),
            new CoordinateLocation(new Coordinate(48.865869, 2.319885))
        );

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithDepartureTime($format)
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
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
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithAddressWaypoint($format)
    {
        $location = new AddressLocation('Statue du Général De Gaulle, Paris');

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint($location));
        $request->setOptimizeWaypoints(true);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithCoordinateWaypoint($format)
    {
        $location = new CoordinateLocation(new Coordinate(48.867513, 2.313604));

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint($location));
        $request->setOptimizeWaypoints(true);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithStopoverWaypoint($format)
    {
        $location = new AddressLocation('Statue du Général De Gaulle, Paris');

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint($location, true));

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithAvoid($format)
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithTravelMode($format)
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::DRIVING);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithAlternatives($format)
    {
        $request = $this->createRequest();
        $request->setProvideRouteAlternatives(true);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithTransit($format)
    {
        $request = new DirectionRequest(
            new AddressLocation('Brooklyn'),
            new AddressLocation('Queens')
        );

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime($this->getDepartureTime());
        $request->setArrivalTime($this->getArrivalTime());

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithUnitSystem($format)
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::METRIC);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithRegion($format)
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithLanguage($format)
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithPlaceId($format)
    {
        $request = $this->createRequest();

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithPlaceIdWaypoint($format)
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw')));
        $request->setOptimizeWaypoints(true);

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithStopoverPlaceIdWaypoint($format)
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw'), true));

        $this->service->setFormat($format);
        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
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

        $this->service->route($this->createRequest());
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
