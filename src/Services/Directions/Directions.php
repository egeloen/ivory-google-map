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
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\AbstractService;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\GoogleMap\Services\BusinessAccount;
use Ivory\GoogleMap\Services\Utils\XmlParser;
use Ivory\HttpAdapter\HttpAdapterInterface;

/**
 * Directions service.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Directions extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        $url = 'http://maps.googleapis.com/maps/api/directions',
        $https = false,
        $format = self::FORMAT_JSON,
        XmlParser $xmlParser = null,
        BusinessAccount $businessAccount = null
    ) {
        parent::__construct($httpAdapter, $url, $https, $format, $xmlParser, $businessAccount);
    }

    /**
     * Routes a request.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRequest $request The request.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsResponse The response.
     */
    public function route(DirectionsRequest $request)
    {
        return $this->buildResponse($this->parse(
            (string) $this->getHttpAdapter()->get($this->generateUrl($request))->getBody()
        ));
    }

    /**
     * Generates the url.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRequest $request The request.
     *
     * @return string The generated url.
     */
    private function generateUrl(DirectionsRequest $request)
    {
        $httpQuery = array();

        $httpQuery['origin'] = $request->getOrigin() instanceof Coordinate
            ? $request->getOrigin()->getLatitude().','.$request->getOrigin()->getLongitude()
            : $request->getOrigin();

        $httpQuery['destination'] = $request->getDestination() instanceof Coordinate
            ? $request->getDestination()->getLatitude().','.$request->getDestination()->getLongitude()
            : $request->getDestination();

        if ($request->hasWaypoints()) {
            $waypoints = array();

            if ($request->hasOptimizeWaypoints() && $request->getOptimizeWaypoints()) {
                $waypoints[] = 'optimize:true';
            }

            foreach ($request->getWaypoints() as $waypoint) {
                $stopover = $waypoint->getStopover() ? 'via:' : '';

                $waypoints[] = $waypoint->getLocation() instanceof Coordinate
                    ? $stopover.$waypoint->getLocation()->getLatitude().','.$waypoint->getLocation()->getLongitude()
                    : $stopover.$waypoint->getLocation();
            }

            $httpQuery['waypoints'] = implode('|', $waypoints);
        }

        if ($request->hasTravelMode()) {
            $httpQuery['mode'] = strtolower($request->getTravelMode());
        }

        if ($request->hasProvideRouteAlternatives()) {
            $httpQuery['alternatives'] = $request->getProvideRouteAlternatives() ? 'true' : 'false';
        }

        $httpQuery['avoid'] = $request->hasAvoidTolls() && $request->getAvoidTolls() ? 'tolls' : 'highways';

        if ($request->hasUnitSystem()) {
            $httpQuery['units'] = strtolower($request->getUnitSystem());
        }

        if ($request->hasRegion()) {
            $httpQuery['region'] = $request->getRegion();
        }

        if ($request->hasLanguage()) {
            $httpQuery['language'] = $request->getLanguage();
        }

        if ($request->hasDepartureTime()) {
            $httpQuery['departure_time'] = $request->getDepartureTime()->getTimestamp();
        }

        if ($request->hasArrivalTime()) {
            $httpQuery['arrival_time'] = $request->getArrivalTime()->getTimestamp();
        }

        $httpQuery['sensor'] = $request->hasSensor() ? 'true' : 'false';

        return $this->signUrl($this->getUrl().'/'.$this->getFormat().'?'.http_build_query($httpQuery));
    }

    /**
     * Parses a body.
     *
     * @param string $body The body.
     *
     * @return array The parsed body.
     */
    private function parse($body)
    {
        return $this->getFormat() === self::FORMAT_JSON ? $this->parseJson($body) : $this->parseXml($body);
    }

    /**
     * Parses a json body.
     *
     * @param string $body The json body.
     *
     * @return array The parsed json body.
     */
    private function parseJson($body)
    {
        return json_decode($body, true);
    }

    /**
     * Parses an xml body.
     *
     * @param string $body The xml body.
     *
     * @return array The parsed xml body.
     */
    private function parseXml($body)
    {
        return $this->getXmlParser()->parse(
            $body,
            array(
                'leg'   => 'legs',
                'route' => 'routes',
                'step'  => 'steps',
            )
        );
    }

    /**
     * Builds a response.
     *
     * @param array $response The response.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsResponse The built response.
     */
    private function buildResponse(array $response)
    {
        return new DirectionsResponse($this->buildRoutes($response['routes']), $response['status']);
    }

    /**
     * Builds the routes.
     *
     * @param array $routes The routes.
     *
     * @return array The built routes.
     */
    private function buildRoutes(array $routes)
    {
        $build = array();
        foreach ($routes as $route) {
            $build[] = $this->buildRoute($route);
        }

        return $build;
    }

    /**
     * Builds a route.
     *
     * @param array $route The route.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsRoute The built route.
     */
    private function buildRoute(array $route)
    {
        return new DirectionsRoute(
            new Bound(
                new Coordinate(
                    $route['bounds']['southwest']['lat'],
                    $route['bounds']['southwest']['lng']
                ),
                new Coordinate(
                    $route['bounds']['northeast']['lat'],
                    $route['bounds']['northeast']['lng']
                )
            ),
            isset($route['copyrights']) ? $route['copyrights'] : '',
            $this->buildLegs($route['legs']),
            new EncodedPolyline($route['overview_polyline']['points']),
            isset($route['summary']) ? $route['summary'] : '',
            isset($route['warnings']) ? $route['warnings'] : array(),
            isset($route['waypoint_order']) ? $route['waypoint_order'] : array()
        );
    }

    /**
     * Builds the legs.
     *
     * @param array $legs The legs.
     *
     * @return array The built legs.
     */
    private function buildLegs(array $legs)
    {
        $build =  array();
        foreach ($legs as $leg) {
            $build[] = $this->buildLeg($leg);
        }

        return $build;
    }

    /**
     * Buildd a leg.
     *
     * @param array $leg The leg.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsLeg The leg.
     */
    private function buildLeg(array $leg)
    {
        return new DirectionsLeg(
            new Distance($leg['distance']['text'], $leg['distance']['value']),
            new Duration($leg['duration']['text'], $leg['duration']['value']),
            $leg['end_address'],
            new Coordinate($leg['end_location']['lat'], $leg['end_location']['lng']),
            $leg['start_address'],
            new Coordinate($leg['start_location']['lat'], $leg['start_location']['lng']),
            $this->buildSteps($leg['steps']),
            isset($leg['via_waypoint']) ? $leg['via_waypoint'] : array()
        );
    }

    /**
     * Builds the steps.
     *
     * @param array $steps The steps.
     *
     * @return array The built steps.
     */
    private function buildSteps(array $steps)
    {
        $build =  array();
        foreach ($steps as $step) {
            $build[] = $this->buildStep($step);
        }

        return $build;
    }

    /**
     * Builds a step.
     *
     * @param array $step The step.
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsStep The built step.
     */
    private function buildStep(array $step)
    {
        return new DirectionsStep(
            new Distance($step['distance']['text'], $step['distance']['value']),
            new Duration($step['duration']['text'], $step['duration']['value']),
            new Coordinate($step['end_location']['lat'], $step['end_location']['lng']),
            $step['html_instructions'],
            new EncodedPolyline($step['polyline']['points']),
            new Coordinate($step['start_location']['lat'], $step['start_location']['lng']),
            $step['travel_mode']
        );
    }
}
