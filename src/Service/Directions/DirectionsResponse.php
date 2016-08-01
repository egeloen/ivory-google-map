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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var DirectionsRoute[]
     */
    private $routes = [];

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
    public function hasRoutes()
    {
        return !empty($this->routes);
    }

    /**
     * @return DirectionsRoute[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param DirectionsRoute[] $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = [];
        $this->addRoutes($routes);
    }

    /**
     * @param DirectionsRoute[] $routes
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * @param DirectionsRoute $route
     *
     * @return bool
     */
    public function hasRoute(DirectionsRoute $route)
    {
        return in_array($route, $this->routes, true);
    }

    /**
     * @param DirectionsRoute $route
     */
    public function addRoute(DirectionsRoute $route)
    {
        if (!$this->hasRoute($route)) {
            $this->routes[] = $route;
        }
    }

    /**
     * @param DirectionsRoute $route
     */
    public function removeRoute(DirectionsRoute $route)
    {
        unset($this->routes[array_search($route, $this->routes, true)]);
        $this->routes = array_values($this->routes);
    }
}
