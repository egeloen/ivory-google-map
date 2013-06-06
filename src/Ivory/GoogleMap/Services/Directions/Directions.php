<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\DirectionsException;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\AbstractService;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;

/**
 * Directions service.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Directions extends AbstractService
{
    /**
     * Creates a directions service.
     */
    public function __construct()
    {
        parent::__construct('http://maps.googleapis.com/maps/api/directions');
    }

    /**
     * Routes the given request.
     *
     * Available prototypes:
     * - function route(string $origin, string $destination)
     * - function route(Ivory\GoogleMap\Services\Directions\DirectionsRequest $request)
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the request is not valid (prototypes).
     */
    public function route()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof DirectionsRequest)) {
            $directionsRequest = $args[0];
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_string($args[1]))) {
            $directionsRequest = new DirectionsRequest();

            $directionsRequest->setOrigin($args[0]);
            $directionsRequest->setDestination($args[1]);
        } else {
            throw DirectionsException::invalidDirectionsRequestParameters();
        }

        if (!$directionsRequest->isValid()) {
            throw DirectionsException::invalidDirectionsRequest();
        }

        $url = $this->generateUrl($directionsRequest);
        $response = $this->browser->get($url);
        $directionsResponse = $this->buildDirectionsResponse($this->parse($response->getContent()));

        return $directionsResponse;
    }

    /**
     * Generates directions URL API according to the request.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRequest $directionsRequest The direction request.
     *
     * @return string The generated URL.
     */
    protected function generateUrl(DirectionsRequest $directionsRequest)
    {
        $httpQuery = array();

        if (is_string($directionsRequest->getOrigin())) {
            $httpQuery['origin'] = $directionsRequest->getOrigin();
        } else {
            $httpQuery['origin'] = sprintf(
                '%s,%s',
                $directionsRequest->getOrigin()->getLatitude(),
                $directionsRequest->getOrigin()->getLongitude()
            );
        }

        if (is_string($directionsRequest->getDestination())) {
            $httpQuery['destination'] = $directionsRequest->getDestination();
        } else {
            $httpQuery['destination'] = sprintf(
                '%s,%s',
                $directionsRequest->getDestination()->getLatitude(),
                $directionsRequest->getDestination()->getLongitude()
            );
        }

        if ($directionsRequest->hasWaypoints()) {
            $waypoints = array();

            if ($directionsRequest->hasOptimizeWaypoints() && $directionsRequest->getOptimizeWaypoints()) {
                $waypoints[] = 'optimize:true';
            }

            foreach ($directionsRequest->getWaypoints() as $waypoint) {
                if (is_string($waypoint->getLocation())) {
                    $waypoints[] = $waypoint->getLocation();
                } else {
                    $waypoints[] = sprintf(
                        '%s,%s',
                        $waypoint->getLocation()->getLatitude(),
                        $waypoint->getLocation()->getLongitude()
                    );
                }
            }

            $httpQuery['waypoints'] = implode('|', $waypoints);
        }

        if ($directionsRequest->hasTravelMode()) {
            $httpQuery['mode'] = strtolower($directionsRequest->getTravelMode());
        }

        if ($directionsRequest->hasProvideRouteAlternatives()) {
            $httpQuery['alternatives'] = $directionsRequest->getProvideRouteAlternatives() ? 'true' : 'false';
        }

        if ($directionsRequest->hasAvoidTolls() && $directionsRequest->getAvoidTolls()) {
            $httpQuery['avoid'] = 'tolls';
        } elseif ($directionsRequest->hasAvoidHighways() && $directionsRequest->getAvoidHighways()) {
            $httpQuery['avoid'] = 'highways';
        }

        if ($directionsRequest->hasUnitSystem()) {
            $httpQuery['units'] = strtolower($directionsRequest->getUnitSystem());
        }

        if ($directionsRequest->hasRegion()) {
            $httpQuery['region'] = $directionsRequest->getRegion();
        }

        if ($directionsRequest->hasLanguage()) {
            $httpQuery['language'] = $directionsRequest->getLanguage();
        }

        if ($directionsRequest->hasDepartureTime()) {
            $httpQuery['departure_time'] = $directionsRequest->getDepartureTime()->getTimestamp();
        }

        if ($directionsRequest->hasArrivalTime()) {
            $httpQuery['arrival_time'] = $directionsRequest->getArrivalTime()->getTimestamp();
        }

        $httpQuery['sensor'] = $directionsRequest->hasSensor() ? 'true' : 'false';

        return sprintf('%s/%s?%s', $this->getUrl(), $this->getFormat(), http_build_query($httpQuery));
    }

    /**
     * Parses & normalizes the directions API result response.
     *
     * @param string $response The directions API response.
     *
     * @return \stdClass The parsed & normalized directions response.
     */
    protected function parse($response)
    {
        if ($this->format === 'json') {
            return $this->parseJSON($response);
        }

        return $this->parseXML($response);
    }

    /**
     * Parses & normalizes a JSON directions API result response.
     *
     * @param string $response The directions API JSON response.
     *
     * @return \stdClass The parsed & normalized directions response.
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }

    /**
     * Parses & normalizes an XML directions API result response.
     *
     * @param string $response The directions API XML response.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException Currently, the XML format is not supported...
     *
     * @return \stdClass The parsed & normalized directions response.
     */
    protected function parseXML($response)
    {
        throw DirectionsException::methodNotSupported(__METHOD__);
    }

    /**
     * Builds the directions response according to the normalized directions API results.
     *
     * @param \stdClass $directionsResponse The normalied directions response.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsResponse The builded directions response.
     */
    protected function buildDirectionsResponse(\stdClass $directionsResponse)
    {
        $routes = $this->buildDirectionsRoutes($directionsResponse->routes);
        $status = $directionsResponse->status;

        return new DirectionsResponse($routes, $status);
    }

    /**
     * Builds the directions routes according to the normalized directions API routes.
     *
     * @param \stdClass $directionsRoutes The normalized directions routes.
     *
     * @return array The builded directions routes.
     */
    protected function buildDirectionsRoutes(array $directionsRoutes)
    {
        $results =  array();
        foreach ($directionsRoutes as $directionsRoute) {
            $results[] = $this->buildDirectionsRoute($directionsRoute);
        }

        return $results;
    }

    /**
     * Builds the directions route according to the normalized directions API route.
     *
     * @param \stdClass $directionsRoute The normalized directions route.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsRoute The builded directions route.
     */
    protected function buildDirectionsRoute(\stdClass $directionsRoute)
    {
        $bound = new Bound(
            new Coordinate($directionsRoute->bounds->southwest->lat, $directionsRoute->bounds->southwest->lng),
            new Coordinate($directionsRoute->bounds->northeast->lat, $directionsRoute->bounds->northeast->lng)
        );

        // @see https://github.com/egeloen/IvoryGoogleMapBundle/issues/72
        // @codeCoverageIgnoreStart
        if (!isset($directionsRoute->copyrights)) {
            $directionsRoute->copyrights = '';
        }
        // @codeCoverageIgnoreEnd

        if (!isset($directionsRoute->summary)) {
            $directionsRoute->summary = '';
        }

        $summary = $directionsRoute->summary;
        $copyrights = $directionsRoute->copyrights;

        $directionsLegs = $this->buildDirectionsLegs($directionsRoute->legs);
        $overviewPolyline = new EncodedPolyline($directionsRoute->overview_polyline->points);
        $warnings = $directionsRoute->warnings;
        $waypointOrder = $directionsRoute->waypoint_order;

        return new DirectionsRoute(
            $bound,
            $copyrights,
            $directionsLegs,
            $overviewPolyline,
            $summary,
            $warnings,
            $waypointOrder
        );
    }

    /**
     * Builds the directions legs according to the normalized directions API legs.
     *
     * @param array $directionsLegs The normalized directions legs.
     *
     * @return array The builded directions legs.
     */
    protected function buildDirectionsLegs(array $directionsLegs)
    {
        $results =  array();
        foreach ($directionsLegs as $directionsLeg) {
            $results[] = $this->buildDirectionsLeg($directionsLeg);
        }

        return $results;
    }

    /**
     * Buildd the directions leg according to the normalized directions API leg.
     *
     * @param \stdClass $directionsLeg The normalized directions leg.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsLeg The builded directions leg.
     */
    protected function buildDirectionsLeg(\stdClass $directionsLeg)
    {
        $distance = new Distance($directionsLeg->distance->text, $directionsLeg->distance->value);
        $duration = new Duration($directionsLeg->duration->text, $directionsLeg->duration->value);
        $endAddress = $directionsLeg->end_address;
        $endLocation = new Coordinate($directionsLeg->end_location->lat, $directionsLeg->end_location->lng);
        $startAddress = $directionsLeg->start_address;
        $startLocation = new Coordinate($directionsLeg->start_location->lat, $directionsLeg->start_location->lng);
        $steps = $this->buildDirectionsSteps($directionsLeg->steps);
        $viaWaypoint = $directionsLeg->via_waypoint;

        return new DirectionsLeg(
            $distance,
            $duration,
            $endAddress,
            $endLocation,
            $startAddress,
            $startLocation,
            $steps,
            $viaWaypoint
        );
    }

    /**
     * Builds the directions steps according to the normalized directions API steps.
     *
     * @param array $directionsSteps The normalized directions steps.
     *
     * @return array The builded directions steps.
     */
    protected function buildDirectionsSteps(array $directionsSteps)
    {
        $results =  array();
        foreach ($directionsSteps as $directionsStep) {
            $results[] = $this->buildDirectionsStep($directionsStep);
        }

        return $results;
    }

    /**
     * Builds the directions step according to the normalized directions API step.
     *
     * @param \stdClass $directionsStep The normalized directions step.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsStep The builded directions step.
     */
    protected function buildDirectionsStep(\stdClass $directionsStep)
    {
        $distance = new Distance($directionsStep->distance->text, $directionsStep->distance->value);
        $duration = new Duration($directionsStep->duration->text, $directionsStep->duration->value);
        $endLocation = new Coordinate($directionsStep->end_location->lat, $directionsStep->end_location->lng);
        $instructions = $directionsStep->html_instructions;
        $encodedPolyline = new EncodedPolyline($directionsStep->polyline->points);
        $startLocation = new Coordinate($directionsStep->start_location->lat, $directionsStep->start_location->lng);
        $travelMode = $directionsStep->travel_mode;

        return new DirectionsStep(
            $distance,
            $duration,
            $endLocation,
            $instructions,
            $encodedPolyline,
            $startLocation,
            $travelMode
        );
    }
}
