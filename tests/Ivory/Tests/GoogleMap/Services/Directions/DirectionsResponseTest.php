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

use Ivory\GoogleMap\Services\Directions\DirectionsResponse;
use Ivory\GoogleMap\Services\Directions\DirectionsStatus;

/**
 * Directions response test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsResponse */
    protected $directionsResponse;

    /** @var array */
    protected $routes;

    /** @var string */
    protected $status;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $route = $this->getMockBuilder('Ivory\GoogleMap\Services\Directions\DirectionsRoute')
            ->disableOriginalConstructor()
            ->getMock();

        $this->routes = array($route);
        $this->status = DirectionsStatus::NOT_FOUND;

        $this->directionsResponse = new DirectionsResponse($this->routes, $this->status);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsResponse);
        unset($this->routes);
        unset($this->status);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->routes, $this->directionsResponse->getRoutes());
        $this->assertSame($this->status, $this->directionsResponse->getStatus());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions response status can only be : INVALID_REQUEST,
     * MAX_WAYPOINTS_EXCEEDED, NOT_FOUND, OK, OVER_QUERY_LIMIT, REQUEST_DENIED, UNKNOWN_ERROR, ZERO_RESULTS.
     */
    public function testStatusWithInvalidValue()
    {
        $this->directionsResponse->setStatus('foo');
    }
}
