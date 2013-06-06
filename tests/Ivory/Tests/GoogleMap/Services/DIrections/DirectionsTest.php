<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Directions;

use \DateTime;
use Ivory\GoogleMap\Services\Directions\Directions;
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Directions\DirectionsStatus;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * Directions test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\Directions */
    protected $directions;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        sleep(2);

        $this->directions = new Directions();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directions);
    }

    public function testRouteWithOriginAndDestination()
    {
        $response = $this->directions->route('Lille', 'Paris');

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequest()
    {
        $request = new DirectionsRequest();
        $request->setOrigin(50.629381, 3.057268);
        $request->setDestination(48.856633, 2.352254);
        $request->setTravelMode(TravelMode::DRIVING);
        $request->setProvideRouteAlternatives(true);
        $request->setUnitSystem(UnitSystem::METRIC);
        $request->setRegion('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndStringWaypointAndOptimizeWaypoint()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->addWaypoint('Compiègne');
        $request->setDestination('Paris');

        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndCoordinateWaypoint()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->addWaypoint(49.418079, 2.826190);
        $request->setDestination('Paris');

        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndAvoidTolls()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->setDestination('Paris');
        $request->setAvoidTolls(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndAvoidHighways()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->setDestination('Paris');
        $request->setAvoidHighways(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndLanguage()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->setDestination('Paris');
        $request->setLanguage('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndDepartureTime()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('601-625 Ashbury Street, San Francisco');
        $request->setDestination('Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime(new DateTime());

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndArrivalTime()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('601-625 Ashbury Street, San Francisco');
        $request->setDestination('Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setArrivalTime(new DateTime('+2 hours'));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndDepartureTimeAndArrivalTime()
    {
        $request = new DirectionsRequest();
        $request->setOrigin('601-625 Ashbury Street, San Francisco');
        $request->setDestination('Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setArrivalTime(new DateTime());
        $request->setArrivalTime(new DateTime('+2 hours'));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     */
    public function testRouteWithXmlFormat()
    {
        $this->directions->setFormat('xml');
        $this->directions->route('Lille', 'Paris');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The route arguments are invalid.
     * The available prototypes are:
     * - function route(string $origin, string $destination)
     * - function route(Ivory\GoogleMap\Services\Directions\DirectionsRequest $request)
     */
    public function testRouteWithInvalidRequestParameters()
    {
        $this->directions->route(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request is not valid. It needs at least an origin and a destination.
     * If you add waypoint to the directions request, it needs at least a location.
     */
    public function testRouteWithInvalidRequest()
    {
        $this->directions->route(new DirectionsRequest());
    }
}
