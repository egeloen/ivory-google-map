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
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionServiceApiKeyTest extends DirectionServiceTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testRouteWithPlaceId()
    {
        $request = $this->createRequest();

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw')));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithStopoverPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw'), true));

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }
}
