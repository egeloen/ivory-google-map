<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStep;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionStepTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionStep
     */
    private $step;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->step = new DirectionStep();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->step->hasDistance());
        $this->assertNull($this->step->getDistance());
        $this->assertFalse($this->step->hasDuration());
        $this->assertNull($this->step->getDuration());
        $this->assertFalse($this->step->hasEndLocation());
        $this->assertNull($this->step->getEndLocation());
        $this->assertFalse($this->step->hasInstructions());
        $this->assertNull($this->step->getInstructions());
        $this->assertFalse($this->step->hasEncodedPolyline());
        $this->assertNull($this->step->getEncodedPolyline());
        $this->assertFalse($this->step->hasStartLocation());
        $this->assertNull($this->step->getStartLocation());
        $this->assertFalse($this->step->hasTravelMode());
        $this->assertNull($this->step->getTravelMode());
        $this->assertFalse($this->step->hasTransitDetails());
        $this->assertNull($this->step->getTransitDetails());
    }

    public function testDistance()
    {
        $this->step->setDistance($distance = $this->createDistanceMock());

        $this->assertTrue($this->step->hasDistance());
        $this->assertSame($distance, $this->step->getDistance());
    }

    public function testResetDistance()
    {
        $this->step->setDistance($this->createDistanceMock());
        $this->step->setDistance(null);

        $this->assertFalse($this->step->hasDistance());
        $this->assertNull($this->step->getDistance());
    }

    public function testDuration()
    {
        $this->step->setDuration($duration = $this->createDurationMock());

        $this->assertTrue($this->step->hasDuration());
        $this->assertSame($duration, $this->step->getDuration());
    }

    public function testResetDuration()
    {
        $this->step->setDuration($this->createDurationMock());
        $this->step->setDuration(null);

        $this->assertFalse($this->step->hasDuration());
        $this->assertNull($this->step->getDuration());
    }

    public function testEndLocation()
    {
        $this->step->setEndLocation($endLocation = $this->createCoordinateMock());

        $this->assertTrue($this->step->hasEndLocation());
        $this->assertSame($endLocation, $this->step->getEndLocation());
    }

    public function testResetEndLocation()
    {
        $this->step->setEndLocation($this->createCoordinateMock());
        $this->step->setEndLocation(null);

        $this->assertFalse($this->step->hasEndLocation());
        $this->assertNull($this->step->getEndLocation());
    }

    public function testInstructions()
    {
        $this->step->setInstructions($instructions = 'instructions');

        $this->assertTrue($this->step->hasInstructions());
        $this->assertSame($instructions, $this->step->getInstructions());
    }

    public function testResetInstructions()
    {
        $this->step->setInstructions('instructions');
        $this->step->setInstructions(null);

        $this->assertFalse($this->step->hasInstructions());
        $this->assertNull($this->step->getInstructions());
    }

    public function testEncodedPolyline()
    {
        $this->step->setEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());

        $this->assertTrue($this->step->hasEncodedPolyline());
        $this->assertSame($encodedPolyline, $this->step->getEncodedPolyline());
    }

    public function testResetEncodedPolyline()
    {
        $this->step->setEncodedPolyline($this->createEncodedPolylineMock());
        $this->step->setEncodedPolyline(null);

        $this->assertFalse($this->step->hasEncodedPolyline());
        $this->assertNull($this->step->getEncodedPolyline());
    }

    public function testStartLocation()
    {
        $this->step->setStartLocation($startLocation = $this->createCoordinateMock());

        $this->assertTrue($this->step->hasStartLocation());
        $this->assertSame($startLocation, $this->step->getStartLocation());
    }

    public function testResetStartLocation()
    {
        $this->step->setStartLocation($this->createCoordinateMock());
        $this->step->setStartLocation(null);

        $this->assertFalse($this->step->hasStartLocation());
        $this->assertNull($this->step->getStartLocation());
    }

    public function testTravelMode()
    {
        $this->step->setTravelMode($travelMode = TravelMode::BICYCLING);

        $this->assertTrue($this->step->hasTravelMode());
        $this->assertSame($travelMode, $this->step->getTravelMode());
    }

    public function testResetTravelMode()
    {
        $this->step->setTravelMode(TravelMode::BICYCLING);
        $this->step->setTravelMode(null);

        $this->assertFalse($this->step->hasTravelMode());
        $this->assertNull($this->step->getTravelMode());
    }

    public function testTransitDetails()
    {
        $this->step->setTransitDetails($transitDetails = $this->createTransitDetailsMock());

        $this->assertTrue($this->step->hasTransitDetails());
        $this->assertSame($transitDetails, $this->step->getTransitDetails());
    }

    public function testResetTransitDetails()
    {
        $this->step->setTransitDetails($this->createTransitDetailsMock());
        $this->step->setTransitDetails(null);

        $this->assertFalse($this->step->hasTransitDetails());
        $this->assertNull($this->step->getTransitDetails());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Distance
     */
    private function createDistanceMock()
    {
        return $this->createMock(Distance::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Duration
     */
    private function createDurationMock()
    {
        return $this->createMock(Duration::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EncodedPolyline
     */
    private function createEncodedPolylineMock()
    {
        return $this->createMock(EncodedPolyline::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionTransitDetails
     */
    private function createTransitDetailsMock()
    {
        return $this->createMock(DirectionTransitDetails::class);
    }
}
