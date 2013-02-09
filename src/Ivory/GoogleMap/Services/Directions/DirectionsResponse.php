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

use Ivory\GoogleMap\Exception\DirectionsException;

/**
 * A directions response wraps the directions results (routes) & the response status.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponse
{
    /** @var array */
    protected $routes;

    /** @var string */
    protected $status;

    /**
     * Create a directions response.
     *
     * @param array  $routes The response routes.
     * @param string $status The response status.
     */
    public function __construct(array $routes, $status)
    {
        $this->setRoutes($routes);
        $this->setStatus($status);
    }

    /**
     * Gets the directions routes.
     *
     * @return array The directions routes.
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Sets the directions routes.
     *
     * @param array $routes The directions routes.
     */
    public function setRoutes(array $routes)
    {
        $this->routes = array();

        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    /**
     * Add a directions route.
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute $route The route to add.
     */
    public function addRoute(DirectionsRoute $route)
    {
        $this->routes[] = $route;
    }

    /**
     * Gets the directions response status.
     *
     * @return string The directions response status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the directions response status.
     *
     * @param string $status The directions response status.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the status is not valid.
     */
    public function setStatus($status)
    {
        if (!in_array($status, DirectionsStatus::getDirectionsStatus())) {
            throw DirectionsException::invalidDirectionsResponseStatus();
        }

        $this->status = $status;
    }
}
