<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\AbstractParsableService;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;
use Ivory\GoogleMap\Service\Base\Time;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;
use Ivory\GoogleMap\Service\Direction\Response\DirectionGeocoded;
use Ivory\GoogleMap\Service\Direction\Response\DirectionLeg;
use Ivory\GoogleMap\Service\Direction\Response\DirectionResponse;
use Ivory\GoogleMap\Service\Direction\Response\DirectionRoute;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStep;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitAgency;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitLine;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitStop;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitVehicle;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionService extends AbstractParsableService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/directions', $parser);
    }

    /**
     * @param DirectionRequestInterface $request
     *
     * @return DirectionResponse
     */
    public function route(DirectionRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $data = $this->parse((string) $httpResponse->getBody(), [
            'pluralization_rules' => [
                'leg'            => 'legs',
                'route'          => 'routes',
                'step'           => 'steps',
                'waypoint_index' => 'waypoint_order',
            ],
        ]);

        $response = $this->buildResponse($data);
        $response->setRequest($request);

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionResponse
     */
    private function buildResponse(array $data)
    {
        $response = new DirectionResponse();
        $response->setStatus($data['status']);

        if (isset($data['routes'])) {
            $response->setRoutes($this->buildRoutes($data['routes']));
        }

        if (isset($data['geocoded_waypoints'])) {
            $response->setGeocodedWaypoints($this->buildGeocodedWaypoints($data['geocoded_waypoints']));
        }

        if (isset($data['available_travel_modes'])) {
            $response->setAvailableTravelModes($data['available_travel_modes']);
        }

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionRoute[]
     */
    private function buildRoutes(array $data)
    {
        $routes = [];

        foreach ($data as $route) {
            $routes[] = $this->buildRoute($route);
        }

        return $routes;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionRoute
     */
    private function buildRoute(array $data)
    {
        $route = new DirectionRoute();
        $route->setBound($this->buildBound($data['bounds']));
        $route->setLegs($this->buildLegs($data['legs']));
        $route->setOverviewPolyline($this->buildEncodedPolyline($data['overview_polyline']));

        if (isset($data['copyrights'])) {
            $route->setCopyrights($data['copyrights']);
        }

        if (isset($data['summary'])) {
            $route->setSummary($data['summary']);
        }

        if (isset($data['fare'])) {
            $route->setFare($this->buildFare($data['fare']));
        }

        if (isset($data['warnings'])) {
            $route->setWarnings($data['warnings']);
        }

        if (isset($data['waypoint_order'])) {
            $route->setWaypointOrders($data['waypoint_order']);
        }

        return $route;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionGeocoded[]
     */
    private function buildGeocodedWaypoints(array $data)
    {
        $waypoints = [];

        foreach ($data as $waypoint) {
            $waypoints[] = $this->buildGeocodedWaypoint($waypoint);
        }

        return $waypoints;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionGeocoded
     */
    private function buildGeocodedWaypoint(array $data)
    {
        $geocodedWaypoint = new DirectionGeocoded();
        $geocodedWaypoint->setStatus($data['geocoder_status']);
        $geocodedWaypoint->setTypes($data['types']);

        if (isset($data['place_id'])) {
            $geocodedWaypoint->setPlaceId($data['place_id']);
        }

        if (isset($data['partial_match'])) {
            $geocodedWaypoint->setPartialMatch($data['partial_match']);
        }

        return $geocodedWaypoint;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionLeg[]
     */
    private function buildLegs(array $data)
    {
        $legs = [];

        foreach ($data as $leg) {
            $legs[] = $this->buildLeg($leg);
        }

        return $legs;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionLeg
     */
    private function buildLeg(array $data)
    {
        $leg = new DirectionLeg();
        $leg->setDistance($this->buildDistance($data['distance']));
        $leg->setDuration($this->buildDuration($data['duration']));
        $leg->setStartLocation($this->buildCoordinate($data['start_location']));
        $leg->setEndLocation($this->buildCoordinate($data['end_location']));
        $leg->setStartAddress($data['start_address']);
        $leg->setEndAddress($data['end_address']);
        $leg->setSteps($this->buildSteps($data['steps']));

        if (isset($data['departure_time'])) {
            $leg->setDepartureTime($this->buildTime($data['departure_time']));
        }

        if (isset($data['arrival_time'])) {
            $leg->setArrivalTime($this->buildTime($data['arrival_time']));
        }

        if (isset($data['via_waypoint'])) {
            $leg->setViaWaypoints($data['via_waypoint']);
        }

        if (isset($data['duration_in_traffic'])) {
            $leg->setDurationInTraffic($this->buildDuration($data['duration_in_traffic']));
        }

        return $leg;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionStep[]
     */
    private function buildSteps(array $data)
    {
        $steps = [];

        foreach ($data as $step) {
            $steps[] = $this->buildStep($step);
        }

        return $steps;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionStep
     */
    private function buildStep(array $data)
    {
        $step = new DirectionStep();
        $step->setDistance($this->buildDistance($data['distance']));
        $step->setDuration($this->buildDuration($data['duration']));
        $step->setEndLocation($this->buildCoordinate($data['end_location']));
        $step->setEncodedPolyline($this->buildEncodedPolyline($data['polyline']));
        $step->setStartLocation($this->buildCoordinate($data['start_location']));
        $step->setInstructions($data['html_instructions']);
        $step->setTravelMode($data['travel_mode']);

        if (isset($data['transit_details'])) {
            $step->setTransitDetails($this->buildTransitDetails($data['transit_details']));
        }

        return $step;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitDetails
     */
    private function buildTransitDetails(array $data)
    {
        $transitDetails = new DirectionTransitDetails();
        $transitDetails->setDepartureStop($this->buildTransitStop($data['departure_stop']));
        $transitDetails->setArrivalStop($this->buildTransitStop($data['arrival_stop']));
        $transitDetails->setDepartureTime($this->buildTime($data['departure_time']));
        $transitDetails->setArrivalTime($this->buildTime($data['arrival_time']));
        $transitDetails->setLine($this->buildTransitLine($data['line']));
        $transitDetails->setHeadSign($data['headsign']);
        $transitDetails->setNumStops($data['num_stops']);

        if (isset($data['headway'])) {
            $transitDetails->setHeadWay($data['headway']);
        }

        return $transitDetails;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitLine
     */
    private function buildTransitLine(array $data)
    {
        $transitLine = new DirectionTransitLine();
        $transitLine->setShortName($data['short_name']);
        $transitLine->setVehicle($this->buildTransitVehicle($data['vehicle']));
        $transitLine->setAgencies($this->buildTransitAgencies($data['agencies']));

        if (isset($data['name'])) {
            $transitLine->setName($data['name']);
        }

        if (isset($data['color'])) {
            $transitLine->setColor($data['color']);
        }

        if (isset($data['url'])) {
            $transitLine->setUrl($data['url']);
        }

        if (isset($data['icon'])) {
            $transitLine->setIcon($data['icon']);
        }

        if (isset($data['text_color'])) {
            $transitLine->setTextColor($data['text_color']);
        }

        return $transitLine;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitAgency[]
     */
    private function buildTransitAgencies(array $data)
    {
        $agencies = [];

        foreach ($data as $agency) {
            $agencies[] = $this->buildTransitAgency($agency);
        }

        return $agencies;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitAgency
     */
    private function buildTransitAgency(array $data)
    {
        $transitAgency = new DirectionTransitAgency();
        $transitAgency->setName($data['name']);
        $transitAgency->setPhone($data['phone']);
        $transitAgency->setUrl($data['url']);

        return $transitAgency;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitStop
     */
    private function buildTransitStop(array $data)
    {
        $transitStop = new DirectionTransitStop();
        $transitStop->setName($data['name']);
        $transitStop->setLocation($this->buildCoordinate($data['location']));

        return $transitStop;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionTransitVehicle
     */
    private function buildTransitVehicle(array $data)
    {
        $transitVehicle = new DirectionTransitVehicle();
        $transitVehicle->setName($data['name']);
        $transitVehicle->setIcon($data['icon']);
        $transitVehicle->setType($data['type']);

        return $transitVehicle;
    }

    /**
     * @param mixed[] $data
     *
     * @return Bound
     */
    private function buildBound(array $data)
    {
        return new Bound(
            $this->buildCoordinate($data['southwest']),
            $this->buildCoordinate($data['northeast'])
        );
    }

    /**
     * @param mixed[] $data
     *
     * @return Coordinate
     */
    private function buildCoordinate(array $data)
    {
        return new Coordinate($data['lat'], $data['lng']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Distance
     */
    private function buildDistance(array $data)
    {
        return new Distance($data['value'], $data['text']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Duration
     */
    private function buildDuration(array $data)
    {
        return new Duration($data['value'], $data['text']);
    }

    /**
     * @param string[] $data
     *
     * @return EncodedPolyline
     */
    private function buildEncodedPolyline(array $data)
    {
        return new EncodedPolyline($data['points']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Fare
     */
    private function buildFare(array $data)
    {
        return new Fare($data['value'], $data['currency'], $data['text']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Time
     */
    private function buildTime(array $data)
    {
        return new Time(
            new \DateTime('@'.$data['value'], new \DateTimeZone($data['time_zone'])),
            $data['time_zone'],
            $data['text']
        );
    }
}
