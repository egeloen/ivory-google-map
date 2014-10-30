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

use Ivory\GoogleMap\Services\Directions\Directions;
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Directions\DirectionsStatus;
use Ivory\GoogleMap\Services\Directions\DirectionsWaypoint;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\HttpAdapter\SocketHttpAdapter;

/**
 * Directions test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\Directions */
    private $directions;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        sleep(5);

        $this->directions = new Directions(new SocketHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directions);
    }

    public function testInheritance()
    {
        $this->assertServiceInstance($this->directions);
    }

    /**
     * @dataProvider requestProvider
     */
    public function testRouteWithJsonFormat(DirectionsRequest $request)
    {
        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    /**
     * @dataProvider requestProvider
     */
    public function testRouteWithXmlFormat(DirectionsRequest $request)
    {
        $this->directions->setFormat(Directions::FORMAT_XML);
        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithInvalidRequest()
    {
        $response = $this->directions->route(new DirectionsRequest(null, null));

        $this->assertSame(DirectionsStatus::INVALID_REQUEST, $response->getStatus());
        $this->assertEmpty($response->getRoutes());
    }

    /**
     * Gets the request provider.
     *
     * @return array The request provider.
     */
    public function requestProvider()
    {
        $fullRequest = new DirectionsRequest('50.629381, 3.057268', '48.856633, 2.352254');
        $fullRequest->setTravelMode(TravelMode::DRIVING);
        $fullRequest->setProvideRouteAlternatives(true);
        $fullRequest->setUnitSystem(UnitSystem::METRIC);
        $fullRequest->setRegion('fr');

        $stringWaypointRequest = new DirectionsRequest('Lille', 'Paris');
        $stringWaypointRequest->addWaypoint(new DirectionsWaypoint('Compiègne'));

        $coordinateWaypointRequest = new DirectionsRequest('Lille', 'Paris');
        $coordinateWaypointRequest->addWaypoint(new DirectionsWaypoint('49.418079, 2.826190'));

        $optimizeWaypointRequest = new DirectionsRequest('Lille', 'Paris');
        $optimizeWaypointRequest->addWaypoint(new DirectionsWaypoint('Compiègne'));
        $optimizeWaypointRequest->setOptimizeWaypoints(true);

        $stopoverWaypointRequest = new DirectionsRequest('Lille', 'Paris');
        $stopoverWaypointRequest->addWaypoint(new DirectionsWaypoint('Compiègne', true));

        $avoidTollsRequest = new DirectionsRequest('Lille', 'Paris');
        $avoidTollsRequest->setAvoidTolls(true);

        $avoidHighwaysRequest = new DirectionsRequest('Lille', 'Paris');
        $avoidHighwaysRequest->setAvoidHighways(true);

        $languageRequest = new DirectionsRequest('Lille', 'Paris');
        $languageRequest->setLanguage('fr');

        $transitDepartureRequest = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');
        $transitDepartureRequest->setTravelMode(TravelMode::TRANSIT);
        $transitDepartureRequest->setDepartureTime(new \DateTime());

        $transitArrivalRequest = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');
        $transitArrivalRequest->setTravelMode(TravelMode::TRANSIT);
        $transitArrivalRequest->setArrivalTime(new \DateTime('+2 hours'));

        $transitDepartureArrivalRequest = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');
        $transitDepartureArrivalRequest->setTravelMode(TravelMode::TRANSIT);
        $transitDepartureArrivalRequest->setArrivalTime(new \DateTime());
        $transitDepartureArrivalRequest->setArrivalTime(new \DateTime('+2 hours'));

        return array(
            array($fullRequest),
            array($stringWaypointRequest),
            array($coordinateWaypointRequest),
            array($optimizeWaypointRequest),
            array($stopoverWaypointRequest),
            array($avoidTollsRequest),
            array($avoidHighwaysRequest),
            array($languageRequest),
            array($transitDepartureRequest),
            array($transitArrivalRequest),
            array($transitDepartureArrivalRequest),
        );
    }
}
