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

use Ivory\GoogleMap\Services\Directions\DirectionsStep;
use Ivory\GoogleMap\Services\Base\TravelMode;

/**
 * Directions step test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStepTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsStep */
    private $directionsStep;

    /** @var \Ivory\GoogleMap\Services\Base\Distance|\PHPUnit_Framework_MockObject_MockObject */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration|\PHPUnit_Framework_MockObject_MockObject */
    private $duration;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $endLocation;

    /** @var string */
    private $instructions;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline|\PHPUnit_Framework_MockObject_MockObject */
    private $encodedPolyline;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $startLocation;

    /** @var string */
    private $travelMode;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsStep = new DirectionsStep(
            $this->distance = $this->createDistanceMock(),
            $this->duration = $this->createDurationMock(),
            $this->endLocation = $this->createCoordinateMock(),
            $this->instructions = 'instructions',
            $this->encodedPolyline = $this->createEncodedPolylineMock(),
            $this->startLocation = $this->createCoordinateMock(),
            $this->travelMode = TravelMode::DRIVING
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsStep);
        unset($this->distance);
        unset($this->duration);
        unset($this->endLocation);
        unset($this->instructions);
        unset($this->encodedPolyline);
        unset($this->startLocation);
        unset($this->travelMode);
    }

    public function testInitialState()
    {
        $this->assertSame($this->distance, $this->directionsStep->getDistance());
        $this->assertSame($this->duration, $this->directionsStep->getDuration());
        $this->assertSame($this->endLocation, $this->directionsStep->getEndLocation());
        $this->assertSame($this->instructions, $this->directionsStep->getInstructions());
        $this->assertSame($this->encodedPolyline, $this->directionsStep->getEncodedPolyline());
        $this->assertSame($this->startLocation, $this->directionsStep->getStartLocation());
        $this->assertSame($this->travelMode, $this->directionsStep->getTravelMode());
    }

    public function testSetDistance()
    {
        $this->directionsStep->setDistance($distance = $this->createDistanceMock());

        $this->assertSame($distance, $this->directionsStep->getDistance());
    }

    public function testSetDuration()
    {
        $this->directionsStep->setDuration($duration = $this->createDurationMock());

        $this->assertSame($duration, $this->directionsStep->getDuration());
    }

    public function testSetEndLocation()
    {
        $this->directionsStep->setEndLocation($endLocation = $this->createCoordinateMock());

        $this->assertSame($endLocation, $this->directionsStep->getEndLocation());
    }

    public function setSetInstructions()
    {
        $this->directionsStep->setInstructions($instructions = 'foo');

        $this->assertSame($instructions, $this->directionsStep->getInstructions());
    }

    public function testSetEncodedPolyline()
    {
        $this->directionsStep->setEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());

        $this->assertSame($encodedPolyline, $this->directionsStep->getEncodedPolyline());
    }

    public function testSetStartLocation()
    {
        $this->directionsStep->setStartLocation($startLocation = $this->createCoordinateMock());

        $this->assertSame($startLocation, $this->directionsStep->getStartLocation());
    }

    public function testSetTravelMode()
    {
        $this->directionsStep->setTravelMode($travelMode = TravelMode::BICYCLING);

        $this->assertSame($travelMode, $this->directionsStep->getTravelMode());
    }
}
