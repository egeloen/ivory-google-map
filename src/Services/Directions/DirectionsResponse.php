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

/**
 * Directions response.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponse
{
    /** @var array */
    private $routes;

    /** @var string */
    private $status;

    /**
     * Create a directions response.
     *
     * @param array  $routes The routes.
     * @param string $status The status.
     */
    public function __construct(array $routes, $status)
    {
        $this->setRoutes($routes);
        $this->setStatus($status);
    }

    /**
     * Resets the routes.
     */
    public function resetRoutes()
    {
        $this->routes = array();
    }

    /**
     * Checks if there are routes.
     *
     * @return boolean TRUE if there are routes else FALSE.
     */
    public function hasRoutes()
    {
        return !empty($this->routes);
    }

    /**
     * Gets the routes.
     *
     * @return array The routes.
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Sets the routes.
     *
     * @param array $routes The routes.
     */
    public function setRoutes(array $routes)
    {
        $this->resetRoutes();
        $this->addRoutes($routes);
    }

    /**
     * Adds the routes.
     *
     * @param array $routes The routes.
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * Removes the routes.
     *
     * @param array $routes The routes.
     */
    public function removeRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->removeRoute($route);
        }
    }

    /**
     * Checks if there is a route.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRoute $route The route.
     *
     * @return boolean TRUE if there is a route else FALSE.
     */
    public function hasRoute(DirectionsRoute $route)
    {
        return in_array($route, $this->routes, true);
    }

    /**
     * Adds a route.
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute $route The route.
     */
    public function addRoute(DirectionsRoute $route)
    {
        if (!$this->hasRoute($route)) {
            $this->routes[] = $route;
        }
    }

    /**
     * Removes a route.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsRoute $route The route.
     */
    public function removeRoute(DirectionsRoute $route)
    {
        unset($this->routes[array_search($route, $this->routes, true)]);
    }

    /**
     * Gets the status.
     *
     * @return string The status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status.
     *
     * @param string $status The status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
