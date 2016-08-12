<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Directions\DirectionsWaypoint;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionsWaypoint
     */
    private $waypoint;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->waypoint = new DirectionsWaypoint();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->waypoint->hasLocation());
        $this->assertFalse($this->waypoint->hasStopover());
    }

    /**
     * @param string|Coordinate $location
     *
     * @dataProvider locationProvider
     */
    public function testLocation($location)
    {
        $this->waypoint->setLocation($location);

        $this->assertTrue($this->waypoint->hasLocation());
        $this->assertSame($location, $this->waypoint->getLocation());
    }

    /**
     * @param bool $stopover
     *
     * @dataProvider stopoverProvider
     */
    public function testStopover($stopover)
    {
        $this->waypoint->setStopover($stopover);

        $this->assertTrue($this->waypoint->hasStopover());
        $this->assertSame($stopover, $this->waypoint->getStopover());
    }

    public function testResetStopoverWithNullValue()
    {
        $this->waypoint->setStopover(true);
        $this->waypoint->setStopover(null);

        $this->assertFalse($this->waypoint->hasStopover());
        $this->assertNull($this->waypoint->getStopover());
    }

    /**
     * @return mixed[][]
     */
    public function locationProvider()
    {
        return [
            ['Paris'],
            [$this->createMock(Coordinate::class)],
        ];
    }

    /**
     * @return bool[][]
     */
    public function stopoverProvider()
    {
        return [
            [true],
            [false],
        ];
    }
}
