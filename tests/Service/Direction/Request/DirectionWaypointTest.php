<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionWaypoint
     */
    private $waypoint;

    /**
     * @var LocationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $location;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->location = $this->createLocationMock();
        $this->waypoint = new DirectionWaypoint($this->location);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->location, $this->waypoint->getLocation());
        $this->assertFalse($this->waypoint->hasStopover());
        $this->assertNull($this->waypoint->getStopover());
    }

    public function testInitialState()
    {
        $this->waypoint = new DirectionWaypoint($this->location, true);

        $this->assertSame($this->location, $this->waypoint->getLocation());
        $this->assertTrue($this->waypoint->hasStopover());
        $this->assertTrue($this->waypoint->getStopover());
    }

    public function testLocation()
    {
        $this->waypoint->setLocation($location = $this->createLocationMock());

        $this->assertSame($location, $this->waypoint->getLocation());
    }

    public function testStopover()
    {
        $this->waypoint->setStopover(true);

        $this->assertTrue($this->waypoint->hasStopover());
        $this->assertTrue($this->waypoint->getStopover());
    }

    public function testResetStopoverWithNullValue()
    {
        $this->waypoint->setStopover(true);
        $this->waypoint->setStopover(null);

        $this->assertFalse($this->waypoint->hasStopover());
        $this->assertNull($this->waypoint->getStopover());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|LocationInterface
     */
    private function createLocationMock()
    {
        return $this->createMock(LocationInterface::class);
    }
}
