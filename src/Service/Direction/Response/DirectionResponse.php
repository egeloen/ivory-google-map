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
    private ?string $status = null;

    private ?DirectionRequestInterface $request = null;

    /**
     * @var DirectionRoute[]
     */
    private array $routes = [];

    /**
     * @var DirectionGeocoded[]
     */
    private array $geocodedWaypoints = [];

    /**
     * @var string[]
     */
    private array $availableTravelModes = [];

    public function hasStatus(): bool
    {
        return $this->status !== null;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status = null): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?DirectionRequestInterface
    {
        return $this->request;
    }

    /**
     * @param DirectionRequestInterface|null $request
     */
    public function setRequest(DirectionRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasRoutes(): bool
    {
        return !empty($this->routes);
    }

    /**
     * @return DirectionRoute[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param DirectionRoute[] $routes
     */
    public function setRoutes(array $routes): void
    {
        $this->routes = [];
        $this->addRoutes($routes);
    }

    /**
     * @param DirectionRoute[] $routes
     */
    public function addRoutes(array $routes): void
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    public function hasRoute(DirectionRoute $route): bool
    {
        return in_array($route, $this->routes, true);
    }

    public function addRoute(DirectionRoute $route): void
    {
        if (!$this->hasRoute($route)) {
            $this->routes[] = $route;
        }
    }

    public function removeRoute(DirectionRoute $route): void
    {
        unset($this->routes[array_search($route, $this->routes, true)]);
        $this->routes = empty($this->routes) ? [] : array_values($this->routes);
    }

    public function hasGeocodedWaypoints(): bool
    {
        return !empty($this->geocodedWaypoints);
    }

    /**
     * @return DirectionGeocoded[]
     */
    public function getGeocodedWaypoints(): array
    {
        return $this->geocodedWaypoints;
    }

    /**
     * @param DirectionGeocoded[] $geocodedWaypoints
     */
    public function setGeocodedWaypoints(array $geocodedWaypoints): void
    {
        $this->geocodedWaypoints = [];
        $this->addGeocodedWaypoints($geocodedWaypoints);
    }

    /**
     * @param DirectionGeocoded[] $geocodedWaypoints
     */
    public function addGeocodedWaypoints(array $geocodedWaypoints): void
    {
        foreach ($geocodedWaypoints as $geocodedWaypoint) {
            $this->addGeocodedWaypoint($geocodedWaypoint);
        }
    }

    public function hasGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint): bool
    {
        return in_array($geocodedWaypoint, $this->geocodedWaypoints, true);
    }

    public function addGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint): void
    {
        if (!$this->hasGeocodedWaypoint($geocodedWaypoint)) {
            $this->geocodedWaypoints[] = $geocodedWaypoint;
        }
    }

    public function removeGeocodedWaypoint(DirectionGeocoded $geocodedWaypoint): void
    {
        unset($this->geocodedWaypoints[array_search($geocodedWaypoint, $this->geocodedWaypoints, true)]);
        $this->geocodedWaypoints = empty($this->geocodedWaypoints) ? [] : array_values($this->geocodedWaypoints);
    }

    public function hasAvailableTravelModes(): bool
    {
        return !empty($this->availableTravelModes);
    }

    /**
     * @return string[]
     */
    public function getAvailableTravelModes(): array
    {
        return $this->availableTravelModes;
    }

    /**
     * @param string[] $availableTravelModes
     */
    public function setAvailableTravelModes(array $availableTravelModes): void
    {
        $this->availableTravelModes = [];
        $this->addAvailableTravelModes($availableTravelModes);
    }

    /**
     * @param string[] $availableTravelModes
     */
    public function addAvailableTravelModes(array $availableTravelModes): void
    {
        foreach ($availableTravelModes as $availableTravelMode) {
            $this->addAvailableTravelMode($availableTravelMode);
        }
    }

    /**
     * @param string $availableTravelMode
     */
    public function hasAvailableTravelMode($availableTravelMode): bool
    {
        return in_array($availableTravelMode, $this->availableTravelModes, true);
    }

    /**
     * @param string $availableTravelMode
     */
    public function addAvailableTravelMode($availableTravelMode): void
    {
        if (!$this->hasAvailableTravelMode($availableTravelMode)) {
            $this->availableTravelModes[] = $availableTravelMode;
        }
    }

    /**
     * @param string $availableTravelMode
     */
    public function removeAvailableTravelMode($availableTravelMode): void
    {
        unset($this->availableTravelModes[array_search($availableTravelMode, $this->availableTravelModes, true)]);
        $this->availableTravelModes = empty($this->availableTravelModes) ? [] : array_values($this->availableTravelModes);
    }
}
