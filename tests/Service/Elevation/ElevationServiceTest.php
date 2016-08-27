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
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Ivory\GoogleMap\Service\Elevation\Request\PathElevationRequest;
use Ivory\GoogleMap\Service\Elevation\Request\PositionalElevationRequest;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationServiceTest extends AbstractServiceTest
{
    /**
     * @var ElevationService
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

        $this->service = new ElevationService($this->getClient(), $this->getMessageFactory());
        $this->service->setKey($_SERVER['API_KEY']);
    }

    public function testProcessPositional()
    {
        $request = new PositionalElevationRequest([
            new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
            new CoordinateLocation(new Coordinate(-34.397, 150.644)),
        ]);

        $response = $this->service->process($request);

        $this->assertSame(ElevationStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertTrue($response->hasResults());
    }

    public function testProcessPositionalWithEncodedPolylines()
    {
        $request = new PositionalElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhU'),
        ]);

        $response = $this->service->process($request);

        $this->assertSame(ElevationStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertTrue($response->hasResults());
    }

    public function testProcessPath()
    {
        $request = new PathElevationRequest([
            new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
            new CoordinateLocation(new Coordinate(-34.397, 150.644)),
        ], 3);

        $response = $this->service->process($request);

        $this->assertSame(ElevationStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertTrue($response->hasResults());
    }

    public function testProcessPathWithEncodedPolylines()
    {
        $request = new PathElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhUxD@bAxJmGF'),
        ], 3);

        $response = $this->service->process($request);

        $this->assertSame(ElevationStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertTrue($response->hasResults());
    }
}
