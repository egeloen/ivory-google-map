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

use Ivory\GoogleMap\Services\Directions\DirectionsRoute;

/**
 * Directions route test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRouteTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsRoute */
    protected $directionsRoute;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var string */
    protected $copyrights;

    /** @var array */
    protected $legs;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    protected $encodedPolyline;

    /** @var string */
    protected $summary;

    /** @var array */
    protected $warnings;

    /** @var array */
    protected $waypointOrder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->copyrights = 'foo';

        $leg = $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsLeg')
            ->disableOriginalConstructor()
            ->getMock();

        $this->legs = array($leg);

        $this->encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');
        $this->summary = 'bar';
        $this->warnings = array('foo', 'baz');
        $this->waypointOrder = array(3, 2, 1);

        $this->directionsRoute = new DirectionsRoute(
            $this->bound,
            $this->copyrights,
            $this->legs,
            $this->encodedPolyline,
            $this->summary,
            $this->warnings,
            $this->waypointOrder
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsRoute);
        unset($this->bound);
        unset($this->copyrights);
        unset($this->legs);
        unset($this->encodedPolyline);
        unset($this->summary);
        unset($this->warnings);
        unset($this->waypointOrder);
    }

    public function testInitialState()
    {
        $this->assertSame($this->bound, $this->directionsRoute->getBound());
        $this->assertSame($this->copyrights, $this->directionsRoute->getCopyrights());
        $this->assertSame($this->legs, $this->directionsRoute->getLegs());
        $this->assertSame($this->encodedPolyline, $this->directionsRoute->getOverviewPolyline());
        $this->assertSame($this->summary, $this->directionsRoute->getSummary());
        $this->assertSame($this->warnings, $this->directionsRoute->getWarnings());
        $this->assertSame($this->waypointOrder, $this->directionsRoute->getWaypointOrder());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions route copyrights must be a string value.
     */
    public function testCopyrightsWithInvalidValue()
    {
        $this->directionsRoute->setCopyrights(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions route summary must be a string value.
     */
    public function testSummaryWithInvalidValue()
    {
        $this->directionsRoute->setSummary(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions route warning must be a string value.
     */
    public function testWarningsWithInvalidValue()
    {
        $this->directionsRoute->addWarning(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions route waypoint order must be an integer value.
     */
    public function testWaypointOrderWithInvalidValue()
    {
        $this->directionsRoute->addWaypointOrder(true);
    }
}
