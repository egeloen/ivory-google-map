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
class DirectionsWaypointTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint */
    protected $directionsWaypoint;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsWaypoint = new DirectionsWaypoint();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsWaypoint);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->directionsWaypoint->hasLocation());
        $this->assertFalse($this->directionsWaypoint->hasStopover());
    }

    public function testLocationWithString()
    {
        $this->directionsWaypoint->setLocation('address');
        $this->assertTrue($this->directionsWaypoint->hasLocation());
        $this->assertEquals($this->directionsWaypoint->getLocation(), 'address');
    }

    public function testLocationWithCoordinate()
    {
        $location = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->directionsWaypoint->setLocation($location);

        $this->assertSame($location, $this->directionsWaypoint->getLocation());
    }

    public function testLocationWithLatitudeAndLongitude()
    {
        $this->directionsWaypoint->setLocation(1.1, 2.1, false);

        $this->assertSame(1.1, $this->directionsWaypoint->getLocation()->getLatitude());
        $this->assertSame(2.1, $this->directionsWaypoint->getLocation()->getLongitude());
        $this->assertFalse($this->directionsWaypoint->getLocation()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The location setter arguments are invalid.
     * The available prototypes are :
     * - function setLocation(string $destination)
     * - function setLocation(Ivory\GoogleMap\Base\Coordinate $destination)
     * - function setLocation(double $latitude, double $longitude, boolean $noWrap)
     */
    public function testLocationWithInvalidValue()
    {
        $this->directionsWaypoint->setLocation(true);
    }

    public function testStopoverWithValieValue()
    {
        $this->directionsWaypoint->setStopover(true);

        $this->assertTrue($this->directionsWaypoint->hasStopover());
        $this->assertTrue($this->directionsWaypoint->getStopover());
    }

    public function testStopoverWithNullValue()
    {
        $this->directionsWaypoint->setStopover(true);
        $this->directionsWaypoint->setStopover(null);

        $this->assertFalse($this->directionsWaypoint->hasStopover());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions waypoint stopover flag must be a boolean value.
     */
    public function testStopoverWithInvalidValue()
    {
        $this->directionsWaypoint->setStopover('foo');
    }

    public function testIsValidWithoutLocation()
    {
        $this->assertFalse($this->directionsWaypoint->isValid());
    }

    public function testIsValidWithLocation()
    {
        $this->directionsWaypoint->setLocation('foo');

        $this->assertTrue($this->directionsWaypoint->isValid());
    }
}
