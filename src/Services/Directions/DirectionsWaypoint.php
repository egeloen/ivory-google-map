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
 * Directions waypoint.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypoint
{
    /** @var string|\Ivory\GoogleMap\Base\Coordinate */
    private $location;

    /** @var boolean */
    private $stopover;

    /**
     * Creates a directions waypoint.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The coordinate.
     * @param boolean|null                            $stopover TRUE if it stopover else FALSE.
     */
    public function __construct($location, $stopover = null)
    {
        $this->setLocation($location);
        $this->setStopover($stopover);
    }

    /**
     * Checks if it has a location.
     *
     * @return boolean TRUE if it has a location else FALSE.
     */
    public function hasLocation()
    {
        return !empty($this->location);
    }

    /**
     * Gets the location.
     *
     * @return string|\Ivory\GoogleMap\Base\Coordinate The location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The location.
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Checks if it has a stopover.
     *
     * @return boolean TRUE if it has a stopover else FALSE.
     */
    public function hasStopover()
    {
        return $this->stopover !== null;
    }

    /**
     * Gets the stopover.
     *
     * @return boolean|null The stopover.
     */
    public function getStopover()
    {
        return $this->stopover;
    }

    /**
     * Sets the stopover.
     *
     * @param boolean|null $stopover The stopover.
     */
    public function setStopover($stopover = null)
    {
        $this->stopover = $stopover;
    }
}
