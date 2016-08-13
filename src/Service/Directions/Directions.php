<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Directions;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Directions extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/directions');
    }

    /**
     * @param DirectionsRequest $request
     *
     * @return DirectionsResponse
     */
    public function route(DirectionsRequest $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->buildQuery()));
        $data = $this->parse((string) $response->getBody());

        return $this->buildResponse($data);
    }

    /**
     * @param string $data
     *
     * @return mixed[]
     */
    private function parse($data)
    {
        if ($this->getFormat() === self::FORMAT_JSON) {
            return json_decode($data, true);
        }

        return $this->getXmlParser()->parse($data, [
            'leg'            => 'legs',
            'route'          => 'routes',
            'step'           => 'steps',
            'waypoint_index' => 'waypoint_order',
        ]);
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsResponse
     */
    private function buildResponse(array $data)
    {
        $response = new DirectionsResponse();
        $response->setStatus($data['status']);
        $response->setRoutes(isset($data['routes']) ? $this->buildRoutes($data['routes']) : []);

        $response->setGeocodedWaypoints(
            isset($data['geocoded_waypoints']) ? $this->buildGeocodedWaypoints($data['geocoded_waypoints']) : []
        );

        $response->setAvailableTravelModes(
            isset($data['available_travel_modes']) ? $data['available_travel_modes'] : []
        );

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsRoute[]
     */
    private function buildRoutes(array $data)
    {
        $routes = [];
        foreach ($data as $item) {
            $routes[] = $this->buildRoute($item);
        }

        return $routes;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsRoute
     */
    private function buildRoute(array $data)
    {
        $route = new DirectionsRoute();
        $route->setBound($this->buildBound($data['bounds']));
        $route->setCopyrights(isset($data['copyrights']) ? $data['copyrights'] : null);
        $route->setLegs($this->buildLegs($data['legs']));
        $route->setOverviewPolyline($this->buildEncodedPolyline($data['overview_polyline']));
        $route->setSummary(isset($data['summary']) ? $data['summary'] : null);
        $route->setFare(isset($data['fare']) ? $this->buildFare($data['fare']) : null);
        $route->setWarnings(isset($data['warnings']) ? $data['warnings'] : []);
        $route->setWaypointOrders(isset($data['waypoint_order']) ? $data['waypoint_order'] : []);

        return $route;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsGeocoded[]
     */
    private function buildGeocodedWaypoints(array $data)
    {
        $geocodedWaypoints = [];
        foreach ($data as $item) {
            $geocodedWaypoints[] = $this->buildGeocodedWaypoint($item);
        }

        return $geocodedWaypoints;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsGeocoded
     */
    private function buildGeocodedWaypoint(array $data)
    {
        $geocodedWaypoint = new DirectionsGeocoded();
        $geocodedWaypoint->setStatus($data['geocoder_status']);
        $geocodedWaypoint->setPartialMatch(isset($data['partial_match']) ? $data['partial_match'] : null);
        $geocodedWaypoint->setPlaceId(isset($data['place_id']) ? $data['place_id'] : null);
        $geocodedWaypoint->setTypes($data['types']);

        return $geocodedWaypoint;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsLeg[]
     */
    private function buildLegs(array $data)
    {
        $legs = [];
        foreach ($data as $item) {
            $legs[] = $this->buildLeg($item);
        }

        return $legs;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsLeg
     */
    private function buildLeg(array $data)
    {
        $leg = new DirectionsLeg();
        $leg->setDistance($this->buildDistance($data['distance']));
        $leg->setDuration($this->buildDuration($data['duration']));
        $leg->setDepartureTime(isset($data['departure_time']) ? $this->buildDateTime($data['departure_time']) : null);
        $leg->setArrivalTime(isset($data['arrival_time']) ? $this->buildDateTime($data['arrival_time']) : null);
        $leg->setEndAddress($data['end_address']);
        $leg->setEndLocation($this->buildCoordinate($data['end_location']));
        $leg->setStartAddress($data['start_address']);
        $leg->setStartLocation($this->buildCoordinate($data['start_location']));
        $leg->setSteps($this->buildSteps($data['steps']));
        $leg->setViaWaypoints(isset($data['via_waypoint']) ? $data['via_waypoint'] : []);
        $leg->setDurationInTraffic(
            isset($data['duration_in_traffic']) ? $this->buildDuration($data['duration_in_traffic']) : null
        );

        return $leg;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param mixed[] $data
     *
     * @return DirectionsFare
     */
    private function buildFare(array $data)
    {
        $fare = new DirectionsFare();
        $fare->setCurrency($data['currency']);
        $fare->setValue($data['value']);
        $fare->setText($data['text']);

        return $fare;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsStep[]
     */
    private function buildSteps(array $data)
    {
        $steps = [];
        foreach ($data as $item) {
            $steps[] = $this->buildStep($item);
        }

        return $steps;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsStep
     */
    private function buildStep(array $data)
    {
        $step = new DirectionsStep();
        $step->setDistance($this->buildDistance($data['distance']));
        $step->setDuration($this->buildDuration($data['duration']));
        $step->setEndLocation($this->buildCoordinate($data['end_location']));
        $step->setInstructions($data['html_instructions']);
        $step->setEncodedPolyline($this->buildEncodedPolyline($data['polyline']));
        $step->setStartLocation($this->buildCoordinate($data['start_location']));
        $step->setTravelMode($data['travel_mode']);
        $step->setTransitDetails(
            isset($data['transit_details']) ? $this->buildTransitDetails($data['transit_details']) : null
        );

        return $step;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitDetails
     */
    private function buildTransitDetails(array $data)
    {
        $transitDetails = new DirectionsTransitDetails();
        $transitDetails->setDepartureStop($this->buildTransitStop($data['departure_stop']));
        $transitDetails->setArrivalStop($this->buildTransitStop($data['arrival_stop']));
        $transitDetails->setDepartureTime($this->buildDateTime($data['departure_time']));
        $transitDetails->setArrivalTime($this->buildDateTime($data['arrival_time']));
        $transitDetails->setHeadSign($data['headsign']);
        $transitDetails->setHeadWay(isset($data['headway']) ? $data['headway'] : null);
        $transitDetails->setLine($this->buildTransitLine($data['line']));
        $transitDetails->setNumStops($data['num_stops']);

        return $transitDetails;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitLine
     */
    private function buildTransitLine(array $data)
    {
        $transitLine = new DirectionsTransitLine();
        $transitLine->setName($data['name']);
        $transitLine->setShortName($data['short_name']);
        $transitLine->setColor(isset($data['color']) ? $data['color'] : null);
        $transitLine->setUrl(isset($data['url']) ? $data['url'] : null);
        $transitLine->setIcon(isset($data['icon']) ? $data['icon'] : null);
        $transitLine->setTextColor(isset($data['text_color']) ? $data['text_color'] : null);
        $transitLine->setVehicle($this->buildTransitVehicle($data['vehicle']));
        $transitLine->setAgencies($this->buildTransitAgencies($data['agencies']));

        return $transitLine;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitAgency[]
     */
    private function buildTransitAgencies(array $data)
    {
        $transitAgencies = [];

        foreach ($data as $item) {
            $transitAgencies[] = $this->buildTransitAgency($item);
        }

        return $transitAgencies;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitAgency
     */
    private function buildTransitAgency(array $data)
    {
        $transitAgency = new DirectionsTransitAgency();
        $transitAgency->setName($data['name']);
        $transitAgency->setPhone($data['phone']);
        $transitAgency->setUrl($data['url']);

        return $transitAgency;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitStop
     */
    private function buildTransitStop(array $data)
    {
        $transitStop = new DirectionsTransitStop();
        $transitStop->setName($data['name']);
        $transitStop->setLocation($this->buildCoordinate($data['location']));

        return $transitStop;
    }

    /**
     * @param mixed[] $data
     *
     * @return DirectionsTransitVehicle
     */
    private function buildTransitVehicle(array $data)
    {
        $transitVehicle = new DirectionsTransitVehicle();
        $transitVehicle->setName($data['name']);
        $transitVehicle->setIcon($data['icon']);
        $transitVehicle->setType($data['type']);

        return $transitVehicle;
    }

    /**
     * @param mixed[] $data
     *
     * @return \DateTime
     */
    private function buildDateTime(array $data)
    {
        return new \DateTime('@'.$data['value'], new \DateTimeZone($data['time_zone']));
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
        return new Distance($data['text'], $data['value']);
    }

    /**
     * @param mixed[] $data
     *
     * @return Duration
     */
    private function buildDuration(array $data)
    {
        return new Duration($data['text'], $data['value']);
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
}
