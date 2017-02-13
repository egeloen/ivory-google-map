<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Service\Direction\Request\DirectionRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var DirectionRequestInterface|null
     */
    private $request;

    /**
     * @var DirectionRoute[]
     */
    private $routes = [];

    /**
     * @var DirectionGeocoded[]
     */
    private $geocodedWaypoints = [];

    /**
     * @var string[]
     */
    private $availableTravelModes = [];

    /**
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status = null)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function hasRequest()
    {
        return $this->request !== null;
    }

    /**
     * @return DirectionRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param DirectionRequestInterface|null $request
     */
    public function setRequest(DirectionRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasRoutes()
    {
        return !empty($this->routes);
    }

    /**
     * @return DirectionRoute[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param DirectionRoute[] $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = [];
        $this->addRoutes($routes);
    }

    /**
     * @param DirectionRoute[] $routes
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * @param DirectionRoute $route
     *
     * @return bool
     */
    public function hasRoute(DirectionRoute $route)
    {
        return in_array($route, $this->routes, true);
    }

    /**
     * @param DirectionRoute $route
     */
    public function addRoute(DirectionRoute $route)
    {
        if (!$this->hasRoute($route)) {
            $this->routes[] = $route;
        }
    }

    /**
     * @param DirectionRoute $route
     */
    public function removeRoute(DirectionRoute $route)
    {
        unset($this->routes[array_search($route, $this->routes, true)]);
        $this->routes = array_values($this->routes);
    }

    /**
     * @return bool
     */
    public function hasGeocodedWaypoints()
    {
        return !empty($this->geocodedWaypoints);
    }

    /**
     * @return DirectionGeocoded[]
     */
    public function getGeocodedWaypoints()
    {
        return $this->geocodedWaypoints;
    }

    /**
     * @param DirectionGeocoded[] $geocodedWaypoints
     */
    public function setGeocodedWaypoints(array $geocodedWaypoints)
    {
        $this->geocodedWaypoints = [];
        $this->addGeocodedWaypoints($geocodedWaypoints);
    }

    /**
     * @param DirectionGeocoded[] $geocodedWaypoints
     */
    public function addGeocodedWaypoints(array $geocodedWaypoints)
    {
        foreach ($geocodedWaypoints as $geocodedWaypoint) {
            $this->addGeocodedWaypoint($geocodedWaypoint);
        }
    }

    /**
     * @param DirectionGeocoded $geocodedWaypoint
     *
     * @return bool
     */
    public function hasGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint)
    {
        return in_array($geocodedWaypoint, $this->geocodedWaypoints, true);
    }

    /**
     * @param DirectionGeocoded $geocodedWaypoint
     */
    public function addGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint)
    {
        if (!$this->hasGeocodedWaypoint($geocodedWaypoint)) {
            $this->geocodedWaypoints[] = $geocodedWaypoint;
        }
    }

    /**
     * @param DirectionGeocoded $geocodedWaypoint
     */
    public function removeGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint)
    {
        unset($this->geocodedWaypoints[array_search($geocodedWaypoint, $this->geocodedWaypoints, true)]);
        $this->geocodedWaypoints = array_values($this->geocodedWaypoints);
    }

    /**
     * @return bool
     */
    public function hasAvailableTravelModes()
    {
        return !empty($this->availableTravelModes);
    }

    /**
     * @return string[]
     */
    public function getAvailableTravelModes()
    {
        return $this->availableTravelModes;
    }

    /**
     * @param string[] $availableTravelModes
     */
    public function setAvailableTravelModes(array $availableTravelModes)
    {
        $this->availableTravelModes = [];
        $this->addAvailableTravelModes($availableTravelModes);
    }

    /**
     * @param string[] $availableTravelModes
     */
    public function addAvailableTravelModes(array $availableTravelModes)
    {
        foreach ($availableTravelModes as $availableTravelMode) {
            $this->addAvailableTravelMode($availableTravelMode);
        }
    }

    /**
     * @param string $availableTravelMode
     *
     * @return bool
     */
    public function hasAvailableTravelMode($availableTravelMode)
    {
        return in_array($availableTravelMode, $this->availableTravelModes, true);
    }

    /**
     * @param string $availableTravelMode
     */
    public function addAvailableTravelMode($availableTravelMode)
    {
        if (!$this->hasAvailableTravelMode($availableTravelMode)) {
            $this->availableTravelModes[] = $availableTravelMode;
        }
    }

    /**
     * @param string $availableTravelMode
     */
    public function removeAvailableTravelMode($availableTravelMode)
    {
        unset($this->availableTravelModes[array_search($availableTravelMode, $this->availableTravelModes, true)]);
        $this->availableTravelModes = array_values($this->availableTravelModes);
    }
}
