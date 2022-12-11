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

use DateTime;
use Http\Client\Common\Exception\ClientErrorException;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint as DirectionRequestWaypoint;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocodedStatus;
use Ivory\GoogleMap\Service\Direction\Response\DirectionLeg;
use Ivory\GoogleMap\Service\Direction\Response\DirectionResponse;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStatus;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStep;
use Ivory\GoogleMap\Service\Direction\Response\DirectionWaypoint as DirectionResponseWaypoint;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionServiceTest extends AbstractSerializableServiceTest
{
    protected ?DirectionService $service = null;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new DirectionService($this->client);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testRoute()
    {
        $request = $this->createRequest();

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithCoordinates()
    {
        $request = new DirectionRequest(
            new CoordinateLocation(new Coordinate(48.873491, 2.295929)),
            new CoordinateLocation(new Coordinate(48.865869, 2.319885))
        );

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     * @group grain
     */
    public function testRouteWithCoordinatesFromDifferentContinents()
    {
        $request = new DirectionRequest(
            new CoordinateLocation(new Coordinate(25.7616798, -80.1917902)),
            new CoordinateLocation(new Coordinate(50.89717, 4.483602))
        );

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request, DirectionStatus::ZERO_RESULTS);
    }

    /**
     *
     */
    public function testRouteWithDepartureTime()
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithArrivalTime()
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithAddressWaypoint()
    {
        $location = new AddressLocation('Statue du Général De Gaulle, Paris');

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionRequestWaypoint($location));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithCoordinateWaypoint()
    {
        $location = new CoordinateLocation(new Coordinate(48.867513, 2.313604));

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionRequestWaypoint($location));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithStopoverWaypoint()
    {
        $location = new AddressLocation('Statue du Général De Gaulle, Paris');

        $request = $this->createRequest();
        $request->addWaypoint(new DirectionRequestWaypoint($location, true));

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithMultipleWaypoints()
    {
        $request = new DirectionRequest(
            new AddressLocation('Adelaide,SA'),
            new AddressLocation('Adelaide,SA')
        );

        $request->addWaypoints([
            new DirectionRequestWaypoint(new AddressLocation('Barossa Valley,SA')),
            new DirectionRequestWaypoint(new AddressLocation('Clare,SA')),
            new DirectionRequestWaypoint(new AddressLocation('Connawarra,SA')),
            new DirectionRequestWaypoint(new AddressLocation('McLaren+Vale,SA')),
        ]);

        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithAvoid()
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithTravelMode()
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::DRIVING);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithAlternatives()
    {
        $request = $this->createRequest();
        $request->setProvideRouteAlternatives(true);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithTransit()
    {
        $request = new DirectionRequest(
            new AddressLocation('Brooklyn'),
            new AddressLocation('Queens')
        );

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime($this->getDepartureTime());
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithUnitSystem()
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::METRIC);

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithRegion()
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testRouteWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->route($request);

        $this->assertDirectionResponse($response, $request);
    }

    /**
     *
     */
    public function testErrorRequest()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage('REQUEST_DENIED');

        $this->service->setKey('invalid');

        $this->service->route($this->createRequest());
    }

    /*****************************************************************************/
    /* Helpers
    /*****************************************************************************/

    protected function createRequest(): DirectionRequest
    {
        return new DirectionRequest(
            new AddressLocation('Place Charles de Gaulle, Paris'),
            new AddressLocation('Place de la Concorde, Paris')
        );
    }

    /*****************************************************************************/
    /* Helpers: Assertions
    /*****************************************************************************/

    protected function assertDirectionResponse(DirectionResponse $response, DirectionRequestInterface $request, string $status = DirectionStatus::OK): void
    {
        $options = array_merge([
            'routes'                 => [],
            'geocoded_waypoints'     => [],
            'available_travel_modes' => [],
        ], self::$journal->getData());

        $options['status'] = $status;

        $this->assertInstanceOf(DirectionResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['status'], $response->getStatus());
        $this->assertSame($options['available_travel_modes'], $response->getAvailableTravelModes());
        $this->assertCount(is_countable($options['routes']) ? count($options['routes']) : 0, $routes = $response->getRoutes());

        foreach ($options['routes'] as $key => $route) {
            $this->assertArrayHasKey($key, $routes);
            $this->assertDirectionRoute($routes[$key], $route);
        }

        $this->assertCount(
            is_countable($options['geocoded_waypoints']) ? count($options['geocoded_waypoints']) : 0,
            $geocodedWaypoints = $response->getGeocodedWaypoints()
        );

        foreach ($options['geocoded_waypoints'] as $key => $geocodedWaypoint) {
            $this->assertArrayHasKey($key, $geocodedWaypoints);
            $this->assertDirectionGeocoded($geocodedWaypoints[$key], $geocodedWaypoint);
        }
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionRoute(DirectionRoute $route, array $options = []): void
    {
        $options = array_merge([
            'bounds'            => [],
            'copyrights'        => null,
            'legs'              => [],
            'overview_polyline' => [],
            'summary'           => null,
            'fare'              => [],
            'warnings'          => [],
            'waypoint_order'    => [],
        ], $options);

        $this->assertInstanceOf(DirectionRoute::class, $route);

        $this->assertEquals($options['summary'], $route->getSummary());
        $this->assertSame($options['copyrights'], $route->getCopyrights());
        $this->assertSame($options['warnings'], $route->getWarnings());
        $this->assertSame($options['waypoint_order'], $route->getWaypointOrders());

        $this->assertBound($route->getBound(), $options['bounds']);
        $this->assertEncodedPolyline($route->getOverviewPolyline(), $options['overview_polyline']);
        $this->assertFare($route->getFare(), $options['fare']);
        $this->assertCount($options['legs'] === null ? 0 : count($options['legs']), $legs = $route->getLegs());

        foreach ($options['legs'] as $key => $leg) {
            $this->assertArrayHasKey($key, $legs);
            $this->assertDirectionLeg($legs[$key], $leg);
        }
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionLeg(DirectionLeg $leg, array $options = []): void
    {
        $options = array_merge([
            'distance'            => [],
            'duration'            => [],
            'duration_in_traffic' => [],
            'arrival_time'        => [],
            'departure_time'      => [],
            'end_address'         => null,
            'end_location'        => [],
            'start_address'       => null,
            'start_location'      => [],
            'steps'               => [],
            'via_waypoint'        => [],
        ], $options);

        $this->assertInstanceOf(DirectionLeg::class, $leg);

        $this->assertSame($leg->getEndAddress(), $options['end_address']);
        $this->assertSame($leg->getStartAddress(), $options['start_address']);
        $this->assertDuration($leg->getDuration(), $options['duration']);
        $this->assertDuration($leg->getDurationInTraffic(), $options['duration_in_traffic']);
        $this->assertDistance($leg->getDistance(), $options['distance']);
        $this->assertTime($leg->getArrivalTime(), $options['arrival_time']);
        $this->assertTime($leg->getDepartureTime(), $options['departure_time']);
        $this->assertCoordinate($leg->getEndLocation(), $options['end_location']);
        $this->assertCoordinate($leg->getStartLocation(), $options['start_location']);

        $this->assertCount($options['via_waypoint'] === null ? 0 : count($options['via_waypoint']), $viaWaypoints = $leg->getViaWaypoints());

        foreach ($options['via_waypoint'] as $key => $viaWaypoint) {
            $this->assertArrayHasKey($key, $viaWaypoints);
            $this->assertDirectionWaypoint($viaWaypoints[$key], $viaWaypoint);
        }

        $this->assertCount($options['steps'] === null ? 0 : count($options['steps']), $steps = $leg->getSteps());

        foreach ($options['steps'] as $key => $step) {
            $this->assertArrayHasKey($key, $steps);
            $this->assertDirectionStep($steps[$key], $step);
        }
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionStep(DirectionStep $step, array $options = []): void
    {
        $options = array_merge([
            'distance'          => [],
            'duration'          => [],
            'start_location'    => [],
            'end_location'      => [],
            'html_instructions' => null,
            'polyline'          => [],
            'travel_mode'       => null,
            'transit_details'   => [],
        ], $options);

        $this->assertInstanceOf(DirectionStep::class, $step);

        $this->assertSame($options['html_instructions'], $step->getInstructions());
        $this->assertSame($options['travel_mode'], $step->getTravelMode());

        $this->assertDistance($step->getDistance(), $options['distance']);
        $this->assertDuration($step->getDuration(), $options['duration']);
        $this->assertCoordinate($step->getStartLocation(), $options['start_location']);
        $this->assertCoordinate($step->getEndLocation(), $options['end_location']);
        $this->assertEncodedPolyline($step->getEncodedPolyline(), $options['polyline']);
        $this->assertDirectionTransitDetails($step->getTransitDetails(), $options['transit_details']);
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionGeocoded(DirectionGeocoded $geocoded, array $options = []): void
    {
        if (empty($options)) {
            $options['status'] = null;
        } else {
            $options['status'] = DirectionGeocodedStatus::OK;
        }

        $options = array_merge([
            'partial_match' => null,
            'place_id'      => null,
            'types'         => [],
        ], $options);

        $this->assertInstanceOf(DirectionGeocoded::class, $geocoded);

        $this->assertSame($options['status'], $geocoded->getStatus());
        if ($geocoded->hasPartialMatch()) {
            $this->assertSame($options['partial_match'], $geocoded->isPartialMatch());
        }
        $this->assertSame($options['place_id'], $geocoded->getPlaceId());
        $this->assertSame($options['types'], $geocoded->getTypes());
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionWaypoint(DirectionResponseWaypoint $waypoint, array $options = []): void
    {
        $options = array_merge([
            'location'           => [],
            'step_index'         => null,
            'step_interpolation' => null,
        ], $options);

        $this->assertInstanceOf(DirectionResponseWaypoint::class, $waypoint);

        $this->assertSame($options['step_index'], $waypoint->getStepIndex());
        $this->assertSame(round($options['step_interpolation'], 5), round($waypoint->getStepInterpolation(), 5));
        $this->assertCoordinate($waypoint->getLocation(), $options['location']);
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionTransitDetails(?DirectionTransitDetails $details, array $options = [])
    {
        if (empty($options)) {
            $this->assertNull($details);

            return;
        }

        $options = array_merge([
            'departure_stop' => [],
            'arrival_stop'   => [],
            'departure_time' => [],
            'arrival_time'   => [],
            'headsign'       => null,
            'headway'        => null,
            'line'           => [],
            'num_stops'      => null,
        ], $options);

        $this->assertInstanceOf(DirectionTransitDetails::class, $details);

        $this->assertSame($options['headsign'], $details->getHeadSign());
        $this->assertSame($options['headway'], $details->getHeadWay());
        $this->assertSame($options['num_stops'], $details->getNumStops());

        $this->assertDirectionTransitStop($details->getDepartureStop(), $options['departure_stop']);
        $this->assertDirectionTransitStop($details->getArrivalStop(), $options['arrival_stop']);
        $this->assertTime($details->getDepartureTime(), $options['departure_time']);
        $this->assertTime($details->getArrivalTime(), $options['arrival_time']);
        $this->assertDirectionTransitLine($details->getLine(), $options['line']);
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionTransitStop(DirectionTransitStop $stop, array $options = []): void
    {
        $options = array_merge([
            'name'     => null,
            'location' => [],
        ], $options);

        $this->assertInstanceOf(DirectionTransitStop::class, $stop);

        $this->assertSame($options['name'], $stop->getName());
        $this->assertCoordinate($stop->getLocation(), $options['location']);
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionTransitLine(DirectionTransitLine $line, array $options = []): void
    {
        $options = array_merge([
            'name'       => null,
            'short_name' => null,
            'color'      => null,
            'url'        => null,
            'icon'       => null,
            'text_color' => null,
            'vehicle'    => [],
            'agencies'   => [],
        ], $options);

        $this->assertInstanceOf(DirectionTransitLine::class, $line);

        $this->assertSame($options['name'], $line->getName());
        $this->assertSame($options['short_name'], $line->getShortName());
        $this->assertSame($options['color'], $line->getColor());
        $this->assertSame($options['url'], $line->getUrl());
        $this->assertSame($options['icon'], $line->getIcon());
        $this->assertSame($options['text_color'], $line->getTextColor());
        $this->assertDirectionTransitVehicle($line->getVehicle(), $options['vehicle']);
        $this->assertCount($options['agencies'] === null ? 0 : count($options['agencies']), $agencies = $line->getAgencies());

        foreach ($options['agencies'] as $key => $agency) {
            $this->assertArrayHasKey($key, $agencies);
            $this->assertDirectionTransitAgency($agencies[$key], $agency);
        }
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionTransitVehicle(DirectionTransitVehicle $vehicle, array $options = []): void
    {
        $options = array_merge([
            'name'       => null,
            'icon'       => null,
            'type'       => null,
            'local_icon' => null,
        ], $options);

        $this->assertInstanceOf(DirectionTransitVehicle::class, $vehicle);

        $this->assertSame($options['name'], $vehicle->getName());
        $this->assertSame($options['icon'], $vehicle->getIcon());
        $this->assertSame($options['type'], $vehicle->getType());
        $this->assertSame($options['local_icon'], $vehicle->getLocalIcon());
    }

    /**
     * @param string[] $options
     */
    private function assertDirectionTransitAgency(DirectionTransitAgency $agency, array $options = []): void
    {
        $options = array_merge([
            'name'  => null,
            'phone' => null,
            'url'   => null,
        ], $options);

        $this->assertInstanceOf(DirectionTransitAgency::class, $agency);

        $this->assertSame($options['name'], $agency->getName());
        $this->assertSame($options['phone'], $agency->getPhone());
        $this->assertSame($options['url'], $agency->getUrl());
    }

    /**
     * @param string[] $options
     */
    private function assertEncodedPolyline(EncodedPolyline $encodedPolyline, array $options = []): void
    {
        $options = array_merge(['points' => null], $options);

        $this->assertInstanceOf(EncodedPolyline::class, $encodedPolyline);
        $this->assertSame($options['points'], $encodedPolyline->getValue());
    }

    private function getDepartureTime(): DateTime
    {
        return $this->getDateTime('departure', '+1 hour');
    }

    private function getArrivalTime(): DateTime
    {
        return $this->getDateTime('arrival', '+4 hours');
    }
}
