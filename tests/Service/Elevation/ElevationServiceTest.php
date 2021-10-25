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

use Http\Client\Common\Exception\ClientErrorException;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Request\PathElevationRequest;
use Ivory\GoogleMap\Service\Elevation\Request\PositionalElevationRequest;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationStatus;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationServiceTest extends AbstractSerializableServiceTest
{
    protected ?ElevationService $service = null;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new ElevationService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testProcessPositional()
    {
        $request = $this->createRequest();

        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessPositionalWithEncodedPolylines()
    {
        $request = new PositionalElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhU'),
        ]);

        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessPath()
    {
        $request = new PathElevationRequest([
            new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
            new CoordinateLocation(new Coordinate(-34.397, 150.644)),
        ], 3);

        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessPathWithEncodedPolylines()
    {
        $request = new PathElevationRequest([
            new EncodedPolylineLocation('gfo}EtohhUxD@bAxJmGF'),
        ], 3);

        $response = $this->service->process($request);

        $this->assertElevationResponse($response, $request);
    }

    public function testErrorRequest()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage('REQUEST_DENIED');
        $this->service->setKey('invalid');

        $this->service->process($this->createRequest());
    }

    /**
     * @return PositionalElevationRequest
     */
    private function createRequest()
    {
        return new PositionalElevationRequest([
            new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
            new CoordinateLocation(new Coordinate(-34.397, 150.644)),
        ]);
    }

    /**
     * @param ElevationResponse         $response
     * @param ElevationRequestInterface $request
     */
    private function assertElevationResponse($response, $request)
    {
        $options = array_merge(['results' => []], self::$journal->getData());
        $options['status'] = ElevationStatus::OK;

        $this->assertInstanceOf(ElevationResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['status'], $response->getStatus());
        $this->assertCount(count($options['results']), $results = $response->getResults());

        foreach ($options['results'] as $key => $result) {
            $this->assertArrayHasKey($key, $results);
            $this->assertElevationResult($results[$key], $result);
        }
    }

    /**
     * @param ElevationResult $result
     * @param mixed[]         $options
     */
    private function assertElevationResult($result, array $options = [])
    {
        $options = array_merge([
            'location'   => [],
            'elevation'  => null,
            'resolution' => null,
        ], $options);

        $this->assertCoordinate($result->getLocation(), $options['location']);
        $this->assertSame(round($options['elevation'], 5), round($result->getElevation(), 5));
        $this->assertSame(round($options['resolution'], 5), round($result->getResolution(), 5));
    }
}
