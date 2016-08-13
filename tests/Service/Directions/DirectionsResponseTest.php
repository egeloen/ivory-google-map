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

use Ivory\GoogleMap\Service\Directions\DirectionsGeocoded;
use Ivory\GoogleMap\Service\Directions\DirectionsResponse;
use Ivory\GoogleMap\Service\Directions\DirectionsRoute;
use Ivory\GoogleMap\Service\Directions\DirectionsStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionsResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new DirectionsResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRoutes());
        $this->assertEmpty($this->response->getRoutes());
        $this->assertFalse($this->response->hasGeocodedWaypoints());
        $this->assertEmpty($this->response->getGeocodedWaypoints());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = DirectionsStatus::INVALID_REQUEST);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testSetRoutes()
    {
        $this->response->setRoutes($routes = [$route = $this->createRouteMock()]);
        $this->response->setRoutes($routes);

        $this->assertTrue($this->response->hasRoutes());
        $this->assertTrue($this->response->hasRoute($route));
        $this->assertSame($routes, $this->response->getRoutes());
    }

    public function testAddRoutes()
    {
        $this->response->setRoutes($firstRoutes = [$this->createRouteMock()]);
        $this->response->addRoutes($secondRoutes = [$this->createRouteMock()]);

        $this->assertTrue($this->response->hasRoutes());
        $this->assertSame(array_merge($firstRoutes, $secondRoutes), $this->response->getRoutes());
    }

    public function testAddRoute()
    {
        $this->response->addRoute($route = $this->createRouteMock());

        $this->assertTrue($this->response->hasRoutes());
        $this->assertTrue($this->response->hasRoute($route));
        $this->assertSame([$route], $this->response->getRoutes());
    }

    public function testRemoveRoute()
    {
        $this->response->addRoute($route = $this->createRouteMock());
        $this->response->removeRoute($route);

        $this->assertFalse($this->response->hasRoutes());
        $this->assertFalse($this->response->hasRoute($route));
        $this->assertEmpty($this->response->getRoutes());
    }

    public function testSetGeocodedWaypoints()
    {
        $geocodedWaypoint = $this->createGeocodedWaypointMock();

        $this->response->setGeocodedWaypoints($geocodedWaypoints = [$geocodedWaypoint]);
        $this->response->setGeocodedWaypoints($geocodedWaypoints);

        $this->assertTrue($this->response->hasGeocodedWaypoints());
        $this->assertTrue($this->response->hasGeocodedWaypoint($geocodedWaypoint));
        $this->assertSame($geocodedWaypoints, $this->response->getGeocodedWaypoints());
    }

    public function testAddGeocodedWaypoints()
    {
        $this->response->setGeocodedWaypoints($firstGeocodedWaypoints = [$this->createGeocodedWaypointMock()]);
        $this->response->addGeocodedWaypoints($secondGeocodedWaypoints = [$this->createGeocodedWaypointMock()]);

        $this->assertTrue($this->response->hasGeocodedWaypoints());
        $this->assertSame(
            array_merge($firstGeocodedWaypoints, $secondGeocodedWaypoints),
            $this->response->getGeocodedWaypoints()
        );
    }

    public function testAddGeocodedWaypoint()
    {
        $this->response->addGeocodedWaypoint($geocodedWaypoint = $this->createGeocodedWaypointMock());

        $this->assertTrue($this->response->hasGeocodedWaypoints());
        $this->assertTrue($this->response->hasGeocodedWaypoint($geocodedWaypoint));
        $this->assertSame([$geocodedWaypoint], $this->response->getGeocodedWaypoints());
    }

    public function testRemoveGeocodedWaypoint()
    {
        $this->response->addGeocodedWaypoint($geocodedWaypoint = $this->createGeocodedWaypointMock());
        $this->response->removeGeocodedWaypoint($geocodedWaypoint);

        $this->assertFalse($this->response->hasGeocodedWaypoints());
        $this->assertFalse($this->response->hasGeocodedWaypoint($geocodedWaypoint));
        $this->assertEmpty($this->response->getGeocodedWaypoints());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionsRoute
     */
    private function createRouteMock()
    {
        return $this->createMock(DirectionsRoute::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionsGeocoded
     */
    private function createGeocodedWaypointMock()
    {
        return $this->createMock(DirectionsGeocoded::class);
    }
}
