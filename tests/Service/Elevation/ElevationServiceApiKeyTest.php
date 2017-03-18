<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;
use Ivory\GoogleMap\Service\Elevation\Request\PathElevationRequest;
use Ivory\GoogleMap\Service\Elevation\Request\PositionalElevationRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationServiceApiKeyTest extends ElevationServiceTest
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
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessPositionalWithEncodedPolylines($format)
    {
        $request = new PositionalElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhU'),
        ]);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessPath($format)
    {
        $request = new PathElevationRequest([
            new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
            new CoordinateLocation(new Coordinate(-34.397, 150.644)),
        ], 3);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessPathWithEncodedPolylines($format)
    {
        $request = new PathElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhUxD@bAxJmGF'),
        ], 3);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     *
     * @expectedException \Http\Client\Common\Exception\ClientErrorException
     * @expectedExceptionMessage REQUEST_DENIED
     */
    public function testErrorRequest($format)
    {
        $this->service->setFormat($format);
        $this->service->setKey('invalid');

        $this->service->process($this->createRequest());
    }
}
