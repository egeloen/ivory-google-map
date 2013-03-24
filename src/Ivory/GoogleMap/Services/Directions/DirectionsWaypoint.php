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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\DirectionsException;

/**
 * A directions waypoint which describes the google map directions waypoint.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypoint
{
    /** @var string | \Ivory\GoogleMap\Base\Coordinate */
    protected $location;

    /** @var boolean */
    protected $stopover;

    /**
     * Checks if the directions waypoint has a location.
     *
     * @return boolean TRUE if the directions waypoint has a location else FALSE.
     */
    public function hasLocation()
    {
        return $this->location !== null;
    }

    /**
     * Gets the directions waypoint location.
     *
     * @return string | \Ivory\GoogleMap\Base\Coordinate The directions waypoint location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the directions waypoint location.
     *
     * Available prototypes:
     * - function setLocation(string $destination)
     * - function setLocation(Ivory\GoogleMap\Base\Coordinate $destination)
     * - function setLocation(double $latitude, double $longitude, boolean $noWrap)
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the location is not valid (prototypes).
     */
    public function setLocation()
    {
        $args = func_get_args();

        if (isset($args[0]) && is_string($args[0])) {
            $this->location = $args[0];
        } elseif (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->location = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->location === null) {
                $this->location = new Coordinate();
            }

            $this->location->setLatitude($args[0]);
            $this->location->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->location->setNoWrap($args[2]);
            }
        } else {
            throw DirectionsException::invalidDirectionsWaypointLocation();
        }
    }

    /**
     * Checks if the directions waypoint has a stopover flag.
     *
     * @return boolean TRUE if the directions waypoint has a stopover flag else FALSE.
     */
    public function hasStopover()
    {
        return $this->stopover !== null;
    }

    /**
     * Gets the directions waypoint stopover flag.
     *
     * @return boolean The directions waypoint stopover flag.
     */
    public function getStopover()
    {
        return $this->stopover;
    }

    /**
     * Sets the directions waypoint stopover flag.
     *
     * @param boolean $stopover The directions waypoint stopover flag.
     */
    public function setStopover($stopover = null)
    {
        if (!is_bool($stopover) && ($stopover !== null)) {
            throw DirectionsException::invalidDirectionsWaypointStopover();
        }

        $this->stopover = $stopover;
    }

    /**
     * Checks if the directions waypoint is valid.
     *
     * @return boolean TRUE if the directions waypoint is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasLocation();
    }
}
