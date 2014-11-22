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

use Ivory\Tests\GoogleMap\Services\AbstractTestCase as TestCase;

/**
 * Directions test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a directions leg instance.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg $leg The direction leg.
     */
    protected function assertDirectionsLegInstance($leg)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\DirectionsLeg', $leg);
    }

    /**
     * Asserts a directions route instance.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRoute $route The directions route.
     */
    protected function assertDirectionsRouteInstance($route)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\DirectionsRoute', $route);
    }

    /**
     * Asserts a directions step instance.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep $step The directions step.
     */
    protected function assertDirectionsStepInstance($step)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\DirectionsStep', $step);
    }

    /**
     * Asserts a directions waypoint instance.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The directions waypoint.
     */
    protected function assertDirectionsWaypointInstance($waypoint)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\DirectionsWaypoint', $waypoint);
    }

    /**
     * Creates a directions leg mock.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsLeg|\PHPUnit_Framework_MockObject_MockObject The directions leg mock.
     */
    protected function createDirectionsLegMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsLeg')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a directions route mock.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsRoute|\PHPUnit_Framework_MockObject_MockObject The directions route mock.
     */
    protected function createDirectionsRouteMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsRoute')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a directions step mock.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsStep|\PHPUnit_Framework_MockObject_MockObject The directions step mock.
     */
    protected function createDirectionsStepMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsStep')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a directions waypoint mock.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint|\PHPUnit_Framework_MockObject_MockObject The directions waypoint mock.
     */
    protected function createDirectionsWaypointMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsWaypoint')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
