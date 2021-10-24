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

use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceApiKeyTest extends DistanceMatrixServiceTest
{
    protected function setUp(): void
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
    public function testProcessWithPlaceIds()
    {
        $request = new DistanceMatrixRequest(
            [new PlaceIdLocation('ChIJtdVv8-Fv5kcRV7t53Y2Ao3c')],
            [new PlaceIdLocation('ChIJC_jkvdJv5kcRNX4NW3iuID8')]
        );

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithEncodedPolyline()
    {
        $request = new DistanceMatrixRequest(
            [new EncodedPolylineLocation('wc~oAwquwMdlTxiKtqLyiK:|enc:c~vnAamswMvlTor@tjGi}L')],
            [new EncodedPolylineLocation('udymA{~bxM')]
        );

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }
}
