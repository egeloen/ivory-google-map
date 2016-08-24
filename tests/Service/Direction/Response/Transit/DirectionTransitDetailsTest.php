<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Service\Base\Time;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitDetailsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionTransitDetails
     */
    private $transitDetails;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->transitDetails = new DirectionTransitDetails();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->transitDetails->hasDepartureStop());
        $this->assertNull($this->transitDetails->getDepartureStop());
        $this->assertFalse($this->transitDetails->hasArrivalStop());
        $this->assertNull($this->transitDetails->getArrivalStop());
        $this->assertFalse($this->transitDetails->hasDepartureTime());
        $this->assertNull($this->transitDetails->getDepartureTime());
        $this->assertFalse($this->transitDetails->hasArrivalTime());
        $this->assertNull($this->transitDetails->getArrivalTime());
        $this->assertFalse($this->transitDetails->hasHeadSign());
        $this->assertNull($this->transitDetails->getHeadSign());
        $this->assertFalse($this->transitDetails->hasHeadWay());
        $this->assertNull($this->transitDetails->getHeadWay());
        $this->assertFalse($this->transitDetails->hasLine());
        $this->assertNull($this->transitDetails->getLine());
        $this->assertFalse($this->transitDetails->hasNumStops());
        $this->assertNull($this->transitDetails->getNumStops());
    }

    public function testDepartureStop()
    {
        $this->transitDetails->setDepartureStop($departureStop = $this->createTransitStopMock());

        $this->assertTrue($this->transitDetails->hasDepartureStop());
        $this->assertSame($departureStop, $this->transitDetails->getDepartureStop());
    }

    public function testArrivalStop()
    {
        $this->transitDetails->setArrivalStop($arrivalStop = $this->createTransitStopMock());

        $this->assertTrue($this->transitDetails->hasArrivalStop());
        $this->assertSame($arrivalStop, $this->transitDetails->getArrivalStop());
    }

    public function testDepartureTime()
    {
        $this->transitDetails->setDepartureTime($departureTime = $this->createTimeMock());

        $this->assertTrue($this->transitDetails->hasDepartureTime());
        $this->assertSame($departureTime, $this->transitDetails->getDepartureTime());
    }

    public function testArrivalTime()
    {
        $this->transitDetails->setArrivalTime($arrivalTime = $this->createTimeMock());

        $this->assertTrue($this->transitDetails->hasArrivalTime());
        $this->assertSame($arrivalTime, $this->transitDetails->getArrivalTime());
    }

    public function testHeadSign()
    {
        $this->transitDetails->setHeadSign($headSign = 'headsign');

        $this->assertTrue($this->transitDetails->hasHeadSign());
        $this->assertSame($headSign, $this->transitDetails->getHeadSign());
    }

    public function testHeadWay()
    {
        $this->transitDetails->setHeadWay($headWay = 'headway');

        $this->assertTrue($this->transitDetails->hasHeadWay());
        $this->assertSame($headWay, $this->transitDetails->getHeadWay());
    }

    public function testLine()
    {
        $this->transitDetails->setLine($line = $this->createTransitLineMock());

        $this->assertTrue($this->transitDetails->hasLine());
        $this->assertSame($line, $this->transitDetails->getLine());
    }

    public function testNumStops()
    {
        $this->transitDetails->setNumStops($numStops = 4);

        $this->assertTrue($this->transitDetails->hasNumStops());
        $this->assertSame($numStops, $this->transitDetails->getNumStops());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionTransitStop
     */
    private function createTransitStopMock()
    {
        return $this->createMock(DirectionTransitStop::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionTransitLine
     */
    private function createTransitLineMock()
    {
        return $this->createMock(DirectionTransitLine::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Time
     */
    private function createTimeMock()
    {
        return $this->createMock(Time::class);
    }
}
