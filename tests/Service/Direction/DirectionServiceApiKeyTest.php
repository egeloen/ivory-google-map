<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction;

use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionServiceApiKeyTest extends AbstractServiceTest
{
    /**
     * @var DirectionService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        //sleep(2);

        parent::setUp();

        $this->service = new DirectionService($this->getClient(), $this->getMessageFactory());
        $this->service->setKey($_SERVER['API_KEY']);
    }

    public function testRouteWithPlaceId()
    {
        $response = $this->service->route($request = $this->createRequest());

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw')));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithStopoverPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw'), true));

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    /**
     * @return DirectionRequest
     */
    private function createRequest()
    {
        return new DirectionRequest(
            new PlaceIdLocation('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c'),
            new PlaceIdLocation('ChIJC_jkvdJv5kcRNX4NW3iuID8')
        );
    }
}
