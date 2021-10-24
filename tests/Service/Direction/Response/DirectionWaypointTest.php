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
use Ivory\GoogleMap\Service\Direction\Response\DirectionWaypoint;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypointTest extends TestCase
{
    /**
     * @var DirectionWaypoint
     */
    private $waypoint;

    protected function setUp(): void
    {
        $this->waypoint = new DirectionWaypoint();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->waypoint->hasLocation());
        $this->assertNull($this->waypoint->getLocation());

        $this->assertFalse($this->waypoint->hasStepIndex());
        $this->assertNull($this->waypoint->getStepIndex());

        $this->assertFalse($this->waypoint->hasStepInterpolation());
        $this->assertNull($this->waypoint->getStepInterpolation());
    }

    public function testLocation()
    {
        $this->waypoint->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->waypoint->hasLocation());
        $this->assertSame($location, $this->waypoint->getLocation());
    }

    public function testStepIndex()
    {
        $this->waypoint->setStepIndex($stepIndex = 2);

        $this->assertTrue($this->waypoint->hasStepIndex());
        $this->assertSame($stepIndex, $this->waypoint->getStepIndex());
    }

    public function testStepInterpolation()
    {
        $this->waypoint->setStepInterpolation($stepInterpolation = 1.234);

        $this->assertTrue($this->waypoint->hasStepInterpolation());
        $this->assertSame($stepInterpolation, $this->waypoint->getStepInterpolation());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
