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

use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Direction\Response\DirectionResponse;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectionResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new DirectionResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRequest());
        $this->assertNull($this->response->getRequest());
        $this->assertFalse($this->response->hasRoutes());
        $this->assertEmpty($this->response->getRoutes());
        $this->assertFalse($this->response->hasGeocodedWaypoints());
        $this->assertEmpty($this->response->getGeocodedWaypoints());
        $this->assertFalse($this->response->hasAvailableTravelModes());
        $this->assertEmpty($this->response->getAvailableTravelModes());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = DirectionStatus::INVALID_REQUEST);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testRequest()
    {
        $this->response->setRequest($request = $this->createRequestMock());

        $this->assertTrue($this->response->hasRequest());
        $this->assertSame($request, $this->response->getRequest());
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

    public function testSetAvailableTravelModes()
    {
        $availableTravelModes = [$availableTravelMode = TravelMode::BICYCLING];

        $this->response->setAvailableTravelModes($availableTravelModes);
        $this->response->setAvailableTravelModes($availableTravelModes);

        $this->assertTrue($this->response->hasAvailableTravelModes());
        $this->assertTrue($this->response->hasAvailableTravelMode($availableTravelMode));
        $this->assertSame($availableTravelModes, $this->response->getAvailableTravelModes());
    }

    public function testAddAvailableTravelModes()
    {
        $this->response->setAvailableTravelModes($firstAvailableTravelModes = [TravelMode::BICYCLING]);
        $this->response->addAvailableTravelModes($secondAvailableTravelModes = [TravelMode::DRIVING]);

        $this->assertTrue($this->response->hasAvailableTravelModes());
        $this->assertSame(
            array_merge($firstAvailableTravelModes, $secondAvailableTravelModes),
            $this->response->getAvailableTravelModes()
        );
    }

    public function testAddAvailableTravelMode()
    {
        $this->response->addAvailableTravelMode($availableTravelMode = TravelMode::BICYCLING);

        $this->assertTrue($this->response->hasAvailableTravelModes());
        $this->assertTrue($this->response->hasAvailableTravelMode($availableTravelMode));
        $this->assertSame([$availableTravelMode], $this->response->getAvailableTravelModes());
    }

    public function testRemoveAvailableTravelMode()
    {
        $this->response->addAvailableTravelMode($availableTravelMode = TravelMode::BICYCLING);
        $this->response->removeAvailableTravelMode($availableTravelMode);

        $this->assertFalse($this->response->hasAvailableTravelModes());
        $this->assertFalse($this->response->hasAvailableTravelMode($availableTravelMode));
        $this->assertEmpty($this->response->getAvailableTravelModes());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(DirectionRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionRoute
     */
    private function createRouteMock()
    {
        return $this->createMock(DirectionRoute::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionGeocoded
     */
    private function createGeocodedWaypointMock()
    {
        return $this->createMock(DirectionGeocoded::class);
    }
}
