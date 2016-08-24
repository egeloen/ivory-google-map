<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix;

use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceApiKeyTest extends AbstractServiceTest
{
    /**
     * @var DistanceMatrixService
     */
    private $distanceMatrix;

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

        $this->distanceMatrix = new DistanceMatrixService($this->getClient(), $this->getMessageFactory());
        $this->distanceMatrix->setKey($_SERVER['API_KEY']);
    }

    public function testProcessWithPlaceIds()
    {
        $request = new DistanceMatrixRequest(
            [new PlaceIdLocation('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c')],
            [new PlaceIdLocation('ChIJC_jkvdJv5kcRNX4NW3iuID8')]
        );

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }
}
