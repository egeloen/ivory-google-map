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

use Ivory\GoogleMap\Services\Directions\DirectionsWaypoint;

/**
 * Directions waypoint test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypointTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint */
    private $directionsWaypoint;

    /** @var string */
    private $location;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsWaypoint = new DirectionsWaypoint($this->location = 'foo');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->location);
        unset($this->directionsWaypoint);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->directionsWaypoint->hasLocation());
        $this->assertSame($this->location, $this->directionsWaypoint->getLocation());

        $this->assertFalse($this->directionsWaypoint->hasStopover());
        $this->assertNull($this->directionsWaypoint->getStopover());
    }

    public function testInitialState()
    {
        $this->directionsWaypoint = new DirectionsWaypoint($this->location, $stopover = false);

        $this->assertTrue($this->directionsWaypoint->hasStopover());
        $this->assertFalse($this->directionsWaypoint->getStopover());
    }

    /**
     * @dataProvider locationProvider
     */
    public function testSetLocation($location)
    {
        $this->directionsWaypoint->setLocation($location);

        $this->assertTrue($this->directionsWaypoint->hasLocation());
        $this->assertSame($location, $this->directionsWaypoint->getLocation());
    }

    public function testSetStopover()
    {
        $this->directionsWaypoint->setStopover(true);

        $this->assertTrue($this->directionsWaypoint->hasStopover());
        $this->assertTrue($this->directionsWaypoint->getStopover());
    }

    public function testResetStopover()
    {
        $this->directionsWaypoint->setStopover(null);

        $this->assertFalse($this->directionsWaypoint->hasStopover());
        $this->assertNull($this->directionsWaypoint->getStopover());
    }

    /**
     * Gets the location provider.
     *
     * @return array The location provider.
     */
    public function locationProvider()
    {
        return array(
            array('location'),
            array($this->createCoordinateMock()),
        );
    }
}
