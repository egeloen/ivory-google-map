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

use Http\Client\Common\Exception\ClientErrorException;
use DateTime;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElement;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixElementStatus;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixRow;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixStatus;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceTest extends AbstractSerializableServiceTest
{
    protected ?DistanceMatrixService $service = null;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new DistanceMatrixService($this->client);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testProcess()
    {
        $request = $this->createRequest();

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithCoordinates()
    {
        $request = new DistanceMatrixRequest(
            [new CoordinateLocation(new Coordinate(49.262428, -123.113136))],
            [new CoordinateLocation(new Coordinate(37.775328, -122.418938))]
        );

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithDepartureTime()
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithArrivalTime()
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithTravelMode()
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::BICYCLING);

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithAvoid()
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithRegion()
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithUnitSystem()
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::IMPERIAL);

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    public function testErrorRequest()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage('REQUEST_DENIED');
        $this->service->setKey('invalid');

        $this->service->process($this->createRequest());
    }

    /**
     * @return DistanceMatrixRequest
     */
    private function createRequest()
    {
        return new DistanceMatrixRequest(
            [new AddressLocation('Lille, France')],
            [new AddressLocation('Paris, France')]
        );
    }

    /**
     * @param DistanceMatrixResponse         $response
     * @param DistanceMatrixRequestInterface $request
     */
    protected function assertDistanceMatrixResponse($response, $request)
    {
        $options = array_merge([
            'origin_addresses'      => [],
            'destination_addresses' => [],
            'rows'                  => [],
        ], self::$journal->getData());

        $options['status'] = DistanceMatrixStatus::OK;

        $this->assertInstanceOf(DistanceMatrixResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['origin_addresses'], $response->getOrigins());
        $this->assertSame($options['destination_addresses'], $response->getDestinations());
        $this->assertCount(is_countable($options['rows']) ? count($options['rows']) : 0, $rows = $response->getRows());

        foreach ($options['rows'] as $key => $row) {
            $this->assertArrayHasKey($key, $rows);
            $this->assertDistanceMatrixRow($rows[$key], $row);
        }
    }

    /**
     * @param DistanceMatrixRow $row
     * @param mixed[]           $options
     */
    private function assertDistanceMatrixRow($row, array $options = [])
    {
        $options = array_merge(['elements' => []], $options);

        $this->assertInstanceOf(DistanceMatrixRow::class, $row);
        $this->assertCount(is_countable($options['elements']) ? count($options['elements']) : 0, $elements = $row->getElements());

        foreach ($options['elements'] as $key => $element) {
            $this->assertArrayHasKey($key, $elements);
            $this->assertDistanceMatrixElement($elements[$key], $element);
        }
    }

    /**
     * @param DistanceMatrixElement $element
     * @param mixed[]               $options
     */
    private function assertDistanceMatrixElement($element, array $options = [])
    {
        $options = array_merge([
            'status'              => DistanceMatrixElementStatus::OK,
            'distance'            => [],
            'duration'            => [],
            'duration_in_traffic' => [],
            'fare'                => [],
        ], $options);

        $this->assertInstanceOf(DistanceMatrixElement::class, $element);

        $this->assertSame($options['status'], $element->getStatus());
        $this->assertDistance($element->getDistance(), $options['distance']);
        $this->assertDuration($element->getDuration(), $options['duration']);
        $this->assertDuration($element->getDurationInTraffic(), $options['duration_in_traffic']);
        $this->assertFare($element->getFare(), $options['fare']);
    }

    /**
     * @return DateTime
     */
    private function getDepartureTime()
    {
        return $this->getDateTime('departure', '+1 hour');
    }

    /**
     * @return DateTime
     */
    private function getArrivalTime()
    {
        return $this->getDateTime('arrival', '+4 hours');
    }
}
