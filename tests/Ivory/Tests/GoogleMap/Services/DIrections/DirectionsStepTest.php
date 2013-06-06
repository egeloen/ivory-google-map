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
class DirectionsStepTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsStep */
    protected $directionsStep;

    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    protected $duration;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $endLocation;

    /** @var string */
    protected $instructions;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    protected $encodedPolyline;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $startLocation;

    /** @var string */
    protected $travelMode;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distance = $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Distance')
            ->disableOriginalConstructor()
            ->getMock();

        $this->duration = $this->getMockBuilder('Ivory\GoogleMap\Services\Base\Duration')
            ->disableOriginalConstructor()
            ->getMock();

        $this->endLocation = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->instructions = 'instructions';
        $this->encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');
        $this->startLocation = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->travelMode = TravelMode::DRIVING;

        $this->directionsStep = new DirectionsStep(
            $this->distance,
            $this->duration,
            $this->endLocation,
            $this->instructions,
            $this->encodedPolyline,
            $this->startLocation,
            $this->travelMode
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

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The step instructions must be a string value.
     */
    public function testInstructionsWithInvalidValue()
    {
        $this->directionsStep->setInstructions(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions step travel mode can only be : BICYCLING, DRIVING, WALKING, TRANSIT.
     */
    public function testTravelModeWithInvalidValue()
    {
        $this->directionsStep->setTravelMode('foo');
    }
}
