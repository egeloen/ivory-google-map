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
    /**
     * @var DistanceMatrixService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->service = new DistanceMatrixService($this->client, $this->messageFactory);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcess($format)
    {
        $request = $this->createRequest();

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithCoordinates($format)
    {
        $request = new DistanceMatrixRequest(
            [new CoordinateLocation(new Coordinate(49.262428, -123.113136))],
            [new CoordinateLocation(new Coordinate(37.775328, -122.418938))]
        );

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithDepartureTime($format)
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testRouteWithArrivalTime($format)
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithTravelMode($format)
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::BICYCLING);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithAvoid($format)
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithRegion($format)
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithUnitSystem($format)
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::IMPERIAL);

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithLanguage($format)
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertDistanceMatrixResponse($response, $request);
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
            'status'                => DistanceMatrixStatus::OK,
            'origin_addresses'      => [],
            'destination_addresses' => [],
            'rows'                  => [],
        ], self::$journal->getData());

        $this->assertInstanceOf(DistanceMatrixResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['origin_addresses'], $response->getOrigins());
        $this->assertSame($options['destination_addresses'], $response->getDestinations());
        $this->assertCount(count($options['rows']), $rows = $response->getRows());

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
        $this->assertCount(count($options['elements']), $elements = $row->getElements());

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
     * @return \DateTime
     */
    private function getDepartureTime()
    {
        return $this->getDateTime('departure', '+1 hour');
    }

    /**
     * @return \DateTime
     */
    private function getArrivalTime()
    {
        return $this->getDateTime('arrival', '+4 hours');
    }
}
