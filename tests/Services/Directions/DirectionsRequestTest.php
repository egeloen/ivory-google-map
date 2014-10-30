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

use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * Directions request test.
 *
 * @author GeLo <gelon.eric@gmail.com>
 */
class DirectionsRequestTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsRequest */
    private $directionsRequest;

    /** @var string */
    private $origin;

    /** @var string */
    private $destination;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsRequest = new DirectionsRequest($this->origin = 'origin', $this->destination = 'destination');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->destination);
        unset($this->origin);
        unset($this->directionsRequest);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->directionsRequest->hasOrigin());
        $this->assertSame($this->origin, $this->directionsRequest->getOrigin());

        $this->assertTrue($this->directionsRequest->hasDestination());
        $this->assertSame($this->destination, $this->directionsRequest->getDestination());

        $this->assertFalse($this->directionsRequest->hasAvoidHighways());
        $this->assertFalse($this->directionsRequest->hasAvoidTolls());
        $this->assertFalse($this->directionsRequest->hasOptimizeWaypoints());
        $this->assertFalse($this->directionsRequest->hasDepartureTime());
        $this->assertFalse($this->directionsRequest->hasArrivalTime());
        $this->assertFalse($this->directionsRequest->hasProvideRouteAlternatives());
        $this->assertFalse($this->directionsRequest->hasRegion());
        $this->assertFalse($this->directionsRequest->hasLanguage());
        $this->assertFalse($this->directionsRequest->hasTravelMode());
        $this->assertFalse($this->directionsRequest->hasUnitSystem());
        $this->assertFalse($this->directionsRequest->hasWaypoints());
    }

    public function testSetAvoidHightways()
    {
        $this->directionsRequest->setAvoidHighways(true);

        $this->assertTrue($this->directionsRequest->hasAvoidHighways());
        $this->assertTrue($this->directionsRequest->getAvoidHighways());
    }

    public function testResetAvoidHighways()
    {
        $this->directionsRequest->setAvoidHighways(true);
        $this->directionsRequest->setAvoidHighways(null);

        $this->assertFalse($this->directionsRequest->hasAvoidHighways());
        $this->assertNull($this->directionsRequest->getAvoidHighways());
    }

    public function testSetAvoidTolls()
    {
        $this->directionsRequest->setAvoidTolls(true);

        $this->assertTrue($this->directionsRequest->hasAvoidTolls());
        $this->assertTrue($this->directionsRequest->getAvoidTolls());
    }

    public function testResetAvoidTolls()
    {
        $this->directionsRequest->setAvoidTolls(true);
        $this->directionsRequest->setAvoidTolls(null);

        $this->assertFalse($this->directionsRequest->hasAvoidTolls());
        $this->assertNull($this->directionsRequest->getAvoidTolls());
    }

    /**
     * @dataProvider locationProvider
     */
    public function testSetDestination($destination)
    {
        $this->directionsRequest->setDestination($destination);

        $this->assertTrue($this->directionsRequest->hasDestination());
        $this->assertSame($destination, $this->directionsRequest->getDestination());
    }

    public function testSetOptimizeWaypoints()
    {
        $this->directionsRequest->setOptimizeWaypoints(true);

        $this->assertTrue($this->directionsRequest->hasOptimizeWaypoints());
        $this->assertTrue($this->directionsRequest->getOptimizeWaypoints());
    }

    public function testResetOptimizeWaypoints()
    {
        $this->directionsRequest->setOptimizeWaypoints(true);
        $this->directionsRequest->setOptimizeWaypoints(null);

        $this->assertFalse($this->directionsRequest->hasOptimizeWaypoints());
        $this->assertNull($this->directionsRequest->getOptimizeWaypoints());
    }

    /**
     * @dataProvider locationProvider
     */
    public function testSetOrigin($origin)
    {
        $this->directionsRequest->setOrigin($origin);

        $this->assertTrue($this->directionsRequest->hasOrigin());
        $this->assertSame($origin, $this->directionsRequest->getOrigin());
    }

    public function testSetDepartureTime()
    {
        $this->directionsRequest->setDepartureTime($departureTime = new \DateTime());

        $this->assertTrue($this->directionsRequest->hasDepartureTime());
        $this->assertSame($departureTime, $this->directionsRequest->getDepartureTime());
    }

    public function testResetDepartureTime()
    {
        $this->directionsRequest->setDepartureTime(new \DateTime());
        $this->directionsRequest->setDepartureTime(null);

        $this->assertFalse($this->directionsRequest->hasDepartureTime());
        $this->assertNull($this->directionsRequest->getDepartureTime());
    }

    public function testSetArrivalTime()
    {
        $this->directionsRequest->setArrivalTime($arrivalTime = new \DateTime());

        $this->assertTrue($this->directionsRequest->hasArrivalTime());
        $this->assertSame($arrivalTime, $this->directionsRequest->getArrivalTime());
    }

    public function testResetArrivalTime()
    {
        $this->directionsRequest->setArrivalTime(new \DateTime());
        $this->directionsRequest->setArrivalTime(null);

        $this->assertFalse($this->directionsRequest->hasArrivalTime());
        $this->assertNull($this->directionsRequest->getArrivalTime());
    }

    public function testSetProvideRouteAlternatives()
    {
        $this->directionsRequest->setProvideRouteAlternatives(true);

        $this->assertTrue($this->directionsRequest->hasProvideRouteAlternatives());
        $this->assertTrue($this->directionsRequest->getProvideRouteAlternatives());
    }

    public function testResetProvideRouteAlternatives()
    {
        $this->directionsRequest->setProvideRouteAlternatives(true);
        $this->directionsRequest->setProvideRouteAlternatives(null);

        $this->assertFalse($this->directionsRequest->hasProvideRouteAlternatives());
        $this->assertNull($this->directionsRequest->getProvideRouteAlternatives());
    }

    public function testSetRegion()
    {
        $this->directionsRequest->setRegion($region = 'fr');

        $this->assertTrue($this->directionsRequest->hasRegion());
        $this->assertSame($region, $this->directionsRequest->getRegion());
    }

    public function testResetRegion()
    {
        $this->directionsRequest->setRegion('fr');
        $this->directionsRequest->setRegion(null);

        $this->assertFalse($this->directionsRequest->hasRegion());
        $this->assertNull($this->directionsRequest->getRegion());
    }

    public function testSetLanguage()
    {
        $this->directionsRequest->setLanguage($language = 'fr');

        $this->assertTrue($this->directionsRequest->hasLanguage());
        $this->assertSame($language, $this->directionsRequest->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->directionsRequest->setLanguage('fr');
        $this->directionsRequest->setLanguage(null);

        $this->assertFalse($this->directionsRequest->hasLanguage());
        $this->assertNull($this->directionsRequest->getLanguage());
    }

    public function testSetTravelMode()
    {
        $this->directionsRequest->setTravelMode($travelMode = TravelMode::WALKING);

        $this->assertTrue($this->directionsRequest->hasTravelMode());
        $this->assertSame($travelMode, $this->directionsRequest->getTravelMode());
    }

    public function testResetTravelMode()
    {
        $this->directionsRequest->setTravelMode(TravelMode::WALKING);
        $this->directionsRequest->setTravelMode(null);

        $this->assertFalse($this->directionsRequest->hasTravelMode());
        $this->assertNull($this->directionsRequest->getTravelMode());
    }

    public function testSetUnitSystem()
    {
        $this->directionsRequest->setUnitSystem($unitSystem = UnitSystem::IMPERIAL);

        $this->assertTrue($this->directionsRequest->hasUnitSystem());
        $this->assertSame($unitSystem, $this->directionsRequest->getUnitSystem());
    }

    public function testResetUnitSystem()
    {
        $this->directionsRequest->setUnitSystem(UnitSystem::IMPERIAL);
        $this->directionsRequest->setUnitSystem(null);

        $this->assertFalse($this->directionsRequest->hasUnitSystem());
        $this->assertNull($this->directionsRequest->getUnitSystem());
    }

    public function testSetWaypoints()
    {
        $this->directionsRequest->setWaypoints($waypoints = array($this->createDirectionsWaypointMock()));

        $this->assertWaypoints($waypoints);
    }

    public function testAddWaypoints()
    {
        $this->directionsRequest->setWaypoints($waypoints = array($this->createDirectionsWaypointMock()));
        $this->directionsRequest->addWaypoints($newWaypoints = array($this->createDirectionsWaypointMock()));

        $this->assertWaypoints(array_merge($waypoints, $newWaypoints));
    }

    public function testRemoveWaypoints()
    {
        $this->directionsRequest->setWaypoints($waypoints = array($this->createDirectionsWaypointMock()));
        $this->directionsRequest->removeWaypoints($waypoints);

        $this->assertNoWaypoints();
    }

    public function testResetWaypoints()
    {
        $this->directionsRequest->setWaypoints(array($this->createDirectionsWaypointMock()));
        $this->directionsRequest->resetWaypoints();

        $this->assertNoWaypoints();
    }

    public function testAddWaypoint()
    {
        $this->directionsRequest->addWaypoint($waypoint = $this->createDirectionsWaypointMock());

        $this->assertWaypoint($waypoint);
    }

    public function testAddWaypointUnicity()
    {
        $this->directionsRequest->resetWaypoints();
        $this->directionsRequest->addWaypoint($waypoint = $this->createDirectionsWaypointMock());
        $this->directionsRequest->addWaypoint($waypoint);

        $this->assertWaypoints(array($waypoint));
    }

    public function testRemoveWaypoint()
    {
        $this->directionsRequest->addWaypoint($waypoint = $this->createDirectionsWaypointMock());
        $this->directionsRequest->removeWaypoint($waypoint);

        $this->assertNoWaypoint($waypoint);
    }

    public function testSetSensor()
    {
        $this->directionsRequest->setSensor(true);

        $this->assertTrue($this->directionsRequest->hasSensor());
    }

    /**
     * Gets the location provider.
     *
     * @return array The location provider.
     */
    public function locationProvider()
    {
        return array(
            array('foo'),
            array($this->createCoordinateMock()),
        );
    }

    /**
     * Asserts there are waypoints.
     *
     * @param array $waypoints The waypoints.
     */
    private function assertWaypoints($waypoints)
    {
        $this->assertInternalType('array', $waypoints);

        $this->assertTrue($this->directionsRequest->hasWaypoints());
        $this->assertSame($waypoints, $this->directionsRequest->getWaypoints());

        foreach ($waypoints as $waypoint) {
            $this->assertWaypoint($waypoint);
        }
    }

    /**
     * Asserts there is a waypoint.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     */
    private function assertWaypoint($waypoint)
    {
        $this->assertDirectionsWaypointInstance($waypoint);
        $this->assertTrue($this->directionsRequest->hasWaypoint($waypoint));
    }

    /**
     * Asserts there are no waypoints.
     */
    private function assertNoWaypoints()
    {
        $this->assertFalse($this->directionsRequest->hasWaypoints());
        $this->assertEmpty($this->directionsRequest->getWaypoints());
    }

    /**
     * Asserts there is no waypoint.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     */
    private function assertNoWaypoint($waypoint)
    {
        $this->assertDirectionsWaypointInstance($waypoint);
        $this->assertFalse($this->directionsRequest->hasWaypoint($waypoint));
    }
}
