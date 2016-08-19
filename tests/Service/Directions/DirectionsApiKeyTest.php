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

use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\Directions\Directions;
use Ivory\GoogleMap\Service\Directions\Request\DirectionsRequest;
use Ivory\GoogleMap\Service\Directions\Request\DirectionsWaypoint;
use Ivory\GoogleMap\Service\Directions\Response\DirectionsStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsApiKeyTest extends AbstractServiceTest
{
    /**
     * @var Directions
     */
    private $directions;

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

        $this->directions = new Directions($this->getClient(), $this->getMessageFactory());
        $this->directions->setKey($_SERVER['API_KEY']);
    }

    public function testRouteWithPlaceId()
    {
        $response = $this->directions->route($this->createRequest());

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionsWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw')));
        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithStopoverPlaceIdWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionsWaypoint(new PlaceIdLocation('ChIJs5IGBuNv5kcRVOC-kOamBzw'), true));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    /**
     * @return DirectionsRequest
     */
    private function createRequest()
    {
        return new DirectionsRequest(
            new PlaceIdLocation('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c'),
            new PlaceIdLocation('ChIJC_jkvdJv5kcRNX4NW3iuID8')
        );
    }
}
