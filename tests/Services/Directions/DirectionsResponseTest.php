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
class DirectionsResponseTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsResponse */
    private $directionsResponse;

    /** @var array */
    private $routes;

    /** @var string */
    private $status;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsResponse = new DirectionsResponse(
            $this->routes = array($this->createDirectionsRouteMock()),
            $this->status = DirectionsStatus::NOT_FOUND
        );
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

    public function testSetRoutes()
    {
        $this->directionsResponse->setRoutes($routes = array($this->createDirectionsRouteMock()));

        $this->assertRoutes($routes);
    }

    public function testAddRoutes()
    {
        $this->directionsResponse->setRoutes($routes = array($this->createDirectionsRouteMock()));
        $this->directionsResponse->addRoutes($newRoutes = array($this->createDirectionsRouteMock()));

        $this->assertRoutes(array_merge($routes, $newRoutes));
    }

    public function testRemoveRoutes()
    {
        $this->directionsResponse->setRoutes($routes = array($this->createDirectionsRouteMock()));
        $this->directionsResponse->removeRoutes($routes);

        $this->assertNoRoutes();
    }

    public function testResetRoutes()
    {
        $this->directionsResponse->setRoutes(array($this->createDirectionsRouteMock()));
        $this->directionsResponse->resetRoutes();

        $this->assertNoRoutes();
    }

    public function testAddRoute()
    {
        $this->directionsResponse->addRoute($route = $this->createDirectionsRouteMock());

        $this->assertRoute($route);
    }

    public function testAddRouteUnicity()
    {
        $this->directionsResponse->resetRoutes();
        $this->directionsResponse->addRoute($route = $this->createDirectionsRouteMock());
        $this->directionsResponse->addRoute($route);

        $this->assertRoutes(array($route));
    }

    public function testRemoveRoute()
    {
        $this->directionsResponse->addRoute($route = $this->createDirectionsRouteMock());
        $this->directionsResponse->removeRoute($route);

        $this->assertNoRoute($route);
    }

    public function testSetStatus()
    {
        $this->directionsResponse->setStatus($status = DirectionsStatus::OK);

        $this->assertSame($status, $this->directionsResponse->getStatus());
    }

    /**
     * Asserts there are routes.
     *
     * @param array $routes The routes.
     */
    private function assertRoutes($routes)
    {
        $this->assertInternalType('array', $routes);

        $this->assertTrue($this->directionsResponse->hasRoutes());
        $this->assertSame($routes, $this->directionsResponse->getRoutes());

        foreach ($routes as $route) {
            $this->assertRoute($route);
        }
    }

    /**
     * Asserts there is a route.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRoute $route The route.
     */
    private function assertRoute($route)
    {
        $this->assertDirectionsRouteInstance($route);
        $this->assertTrue($this->directionsResponse->hasRoute($route));
    }

    /**
     * Asserts there are no routes.
     */
    private function assertNoRoutes()
    {
        $this->assertFalse($this->directionsResponse->hasRoutes());
        $this->assertEmpty($this->directionsResponse->getRoutes());
    }

    /**
     * Asserts there is no route.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRoute $route The route.
     */
    private function assertNoRoute($route)
    {
        $this->assertDirectionsRouteInstance($route);
        $this->assertFalse($this->directionsResponse->hasRoute($route));
    }
}
