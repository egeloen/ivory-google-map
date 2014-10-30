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

use Ivory\GoogleMap\Services\Directions\DirectionsLeg;

/**
 * Directions leg test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLegTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsLeg */
    private $directionsLeg;

    /** @var \Ivory\GoogleMap\Services\Base\Distance|\PHPUnit_Framework_MockObject_MockObject */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration|\PHPUnit_Framework_MockObject_MockObject */
    private $duration;

    /** @var string */
    private $endAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $endLocation;

    /** @var string */
    private $startAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $startLocation;

    /** @var array */
    private $steps;

    /** @var array */
    private $viaWaypoint;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsLeg = new DirectionsLeg(
            $this->distance = $this->createDistanceMock(),
            $this->duration = $this->createDurationMock(),
            $this->endAddress = 'end_address',
            $this->endLocation = $this->createCoordinateMock(),
            $this->startAddress = 'start_address',
            $this->startLocation = $this->createCoordinateMock(),
            $this->steps = array($this->createDirectionsStepMock()),
            $this->viaWaypoint = array('waypoint')
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsLeg);
        unset($this->duration);
        unset($this->distance);
        unset($this->endAddress);
        unset($this->endLocation);
        unset($this->startAddress);
        unset($this->startLocation);
        unset($this->steps);
        unset($this->viaWaypoint);
    }

    public function testInitialState()
    {
        $this->assertSame($this->duration, $this->directionsLeg->getDuration());
        $this->assertSame($this->distance, $this->directionsLeg->getDistance());
        $this->assertSame($this->endAddress, $this->directionsLeg->getEndAddress());
        $this->assertSame($this->endLocation, $this->directionsLeg->getEndLocation());
        $this->assertSame($this->startAddress, $this->directionsLeg->getStartAddress());
        $this->assertSame($this->startLocation, $this->directionsLeg->getStartLocation());
        $this->assertSame($this->steps, $this->directionsLeg->getSteps());
        $this->assertSame($this->viaWaypoint, $this->directionsLeg->getViaWaypoints());
    }

    public function testSetDistance()
    {
        $this->directionsLeg->setDistance($distance = $this->createDistanceMock());

        $this->assertSame($distance, $this->directionsLeg->getDistance());
    }

    public function testSetDuration()
    {
        $this->directionsLeg->setDuration($duration = $this->createDurationMock());

        $this->assertSame($duration, $this->directionsLeg->getDuration());
    }

    public function testSetEndAddress()
    {
        $this->directionsLeg->setEndAddress($endAddress = 'foo');

        $this->assertSame($endAddress, $this->directionsLeg->getEndAddress());
    }

    public function testSetEndLocation()
    {
        $this->directionsLeg->setEndLocation($endLocation = $this->createCoordinateMock());

        $this->assertSame($endLocation, $this->directionsLeg->getEndLocation());
    }

    public function testSetStartAddress()
    {
        $this->directionsLeg->setStartAddress($startAddress = 'foo');

        $this->assertSame($startAddress, $this->directionsLeg->getStartAddress());
    }

    public function testSetStartLocation()
    {
        $this->directionsLeg->setStartLocation($startLocation = $this->createCoordinateMock());

        $this->assertSame($startLocation, $this->directionsLeg->getStartLocation());
    }

    public function testSetSteps()
    {
        $this->directionsLeg->setSteps($steps = array($this->createDirectionsStepMock()));

        $this->assertSteps($steps);
    }

    public function testAddSteps()
    {
        $this->directionsLeg->setSteps($steps = array($this->createDirectionsStepMock()));
        $this->directionsLeg->addSteps($newSteps = array($this->createDirectionsStepMock()));

        $this->assertSteps(array_merge($steps, $newSteps));
    }

    public function testRemoveSteps()
    {
        $this->directionsLeg->setSteps($steps = array($this->createDirectionsStepMock()));
        $this->directionsLeg->removeSteps($steps);

        $this->assertNoSteps();
    }

    public function testResetSteps()
    {
        $this->directionsLeg->setSteps(array($this->createDirectionsStepMock()));
        $this->directionsLeg->resetSteps();

        $this->assertNoSteps();
    }

    public function testAddStep()
    {
        $this->directionsLeg->addStep($step = $this->createDirectionsStepMock());

        $this->assertStep($step);
    }

    public function testAddStepUnicity()
    {
        $this->directionsLeg->resetSteps();
        $this->directionsLeg->addStep($step = $this->createDirectionsStepMock());
        $this->directionsLeg->addStep($step);

        $this->assertSteps(array($step));
    }

    public function testRemoveStep()
    {
        $this->directionsLeg->addStep($step = $this->createDirectionsStepMock());
        $this->directionsLeg->removeStep($step);

        $this->assertNoStep($step);
    }

    public function testSetViaWaypoints()
    {
        $this->directionsLeg->setViaWaypoints($viaWaypoints = array($this->createCoordinateMock()));

        $this->assertViaWaypoints($viaWaypoints);
    }

    public function testAddViaWaypoints()
    {
        $this->directionsLeg->setViaWaypoints($viaWaypoints = array($this->createCoordinateMock()));
        $this->directionsLeg->addViaWaypoints($newViaWaypoints = array($this->createCoordinateMock()));

        $this->assertViaWaypoints(array_merge($viaWaypoints, $newViaWaypoints));
    }

    public function testRemoveViaWaypoints()
    {
        $this->directionsLeg->setViaWaypoints($viaWaypoints = array($this->createCoordinateMock()));
        $this->directionsLeg->removeViaWaypoints($viaWaypoints);

        $this->assertNoViaWaypoints();
    }

    public function testResetViaWaypoints()
    {
        $this->directionsLeg->setViaWaypoints(array($this->createCoordinateMock()));
        $this->directionsLeg->resetViaWaypoints();

        $this->assertNoViaWaypoints();
    }

    public function testAddViaWaypoint()
    {
        $this->directionsLeg->addViaWaypoint($viaWaypoint = $this->createCoordinateMock());

        $this->assertViaWaypoint($viaWaypoint);
    }

    public function testAddViaWaypointUnicity()
    {
        $this->directionsLeg->resetViaWaypoints();
        $this->directionsLeg->addViaWaypoint($viaWaypoint = $this->createCoordinateMock());
        $this->directionsLeg->addViaWaypoint($viaWaypoint);

        $this->assertViaWaypoints(array($viaWaypoint));
    }

    public function testRemoveViaWaypoint()
    {
        $this->directionsLeg->addViaWaypoint($viaWaypoint = $this->createCoordinateMock());
        $this->directionsLeg->removeViaWaypoint($viaWaypoint);

        $this->assertNoViaWaypoint($viaWaypoint);
    }

    /**
     * Asserts there are steps.
     *
     * @param array $steps The steps.
     */
    private function assertSteps($steps)
    {
        $this->assertInternalType('array', $steps);

        $this->assertTrue($this->directionsLeg->hasSteps());
        $this->assertSame($steps, $this->directionsLeg->getSteps());

        foreach ($steps as $step) {
            $this->assertStep($step);
        }
    }

    /**
     * Asserts there is a step.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep $step The step.
     */
    private function assertStep($step)
    {
        $this->assertDirectionsStepInstance($step);
        $this->assertTrue($this->directionsLeg->hasStep($step));
    }

    /**
     * Asserts there are no steps.
     */
    private function assertNoSteps()
    {
        $this->assertFalse($this->directionsLeg->hasSteps());
        $this->assertEmpty($this->directionsLeg->getSteps());
    }

    /**
     * Asserts there is no step.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep $step The step.
     */
    private function assertNoStep($step)
    {
        $this->assertDirectionsStepInstance($step);
        $this->assertFalse($this->directionsLeg->hasStep($step));
    }

    /**
     * Asserts there are via waypoints.
     *
     * @param array $viaWaypoints The via waypoints.
     */
    private function assertViaWaypoints($viaWaypoints)
    {
        $this->assertInternalType('array', $viaWaypoints);

        $this->assertTrue($this->directionsLeg->hasViaWaypoints());
        $this->assertSame($viaWaypoints, $this->directionsLeg->getViaWaypoints());

        foreach ($viaWaypoints as $viaWaypoint) {
            $this->assertViaWaypoint($viaWaypoint);
        }
    }

    /**
     * Asserts there is a via waypoint.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $viaWaypoint The via waypoint.
     */
    private function assertViaWaypoint($viaWaypoint)
    {
        $this->assertCoordinateInstance($viaWaypoint);
        $this->assertTrue($this->directionsLeg->hasViaWaypoint($viaWaypoint));
    }

    /**
     * Asserts there are no via waypoints.
     */
    private function assertNoViaWaypoints()
    {
        $this->assertFalse($this->directionsLeg->hasViaWaypoints());
        $this->assertEmpty($this->directionsLeg->getViaWaypoints());
    }

    /**
     * Asserts there is no via waypoint.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $viaWaypoint The via waypoint.
     */
    private function assertNoViaWaypoint($viaWaypoint)
    {
        $this->assertCoordinateInstance($viaWaypoint);
        $this->assertFalse($this->directionsLeg->hasViaWaypoint($viaWaypoint));
    }
}
