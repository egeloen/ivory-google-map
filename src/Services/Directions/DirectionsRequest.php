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
 * Directions request.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequest
{
    /** @var boolean */
    private $avoidHighways;

    /** @var boolean */
    private $avoidTolls;

    /** @var string|\Ivory\GoogleMap\Base\Coordinate */
    private $destination;

    /** @var boolean */
    private $optimizeWaypoints;

    /** @var string|\Ivory\GoogleMap\Base\Coordinate */
    private $origin;

    /** @var \DateTime */
    private $departureTime;

    /** @var \DateTime */
    private $arrivalTime;

    /** @var boolean */
    private $provideRouteAlternatives;

    /** @var string */
    private $region;

    /** @var string */
    private $language;

    /** @var string */
    private $travelMode;

    /** @var string */
    private $unitSystem;

    /** @var array */
    private $waypoints = array();

    /** @var boolean */
    private $sensor = false;

    /**
     * Creates a directions request.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin      The origin.
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    public function __construct($origin, $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
    }

    /**
     * Checks if it has an avoid hightways.
     *
     * @return boolean TRUE if it has an avoid hightways else FALSE.
     */
    public function hasAvoidHighways()
    {
        return $this->avoidHighways !== null;
    }

    /**
     * Checks if it avoids hightways.
     *
     * @return boolean TRUE if it avoids hightways else FALSE.
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * Sets if it avoids hightways.
     *
     * @param boolean $avoidHighways TRUE if it avoids hightways else FALSE.
     */
    public function setAvoidHighways($avoidHighways = null)
    {
        $this->avoidHighways = $avoidHighways;
    }

    /**
     * Checks if it has an avoid tolls.
     *
     * @return boolean TRUE if it has an avoid tolls else FALSE.
     */
    public function hasAvoidTolls()
    {
        return $this->avoidTolls !== null;
    }

    /**
     * Checks if it avoid tolls.
     *
     * @return boolean TRUE if it avoids tolls else FALSE.
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * Sets if it avoids tolls.
     *
     * @param boolean $avoidTolls TRUE if it avoids tolls else FALSE.
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        $this->avoidTolls = $avoidTolls;
    }

    /**
     * Checks if it has a destination.
     *
     * @return boolean TRUE if it has a destination else FALSE.
     */
    public function hasDestination()
    {
        return !empty($this->destination);
    }

    /**
     * Gets the destination.
     *
     * @return string|\Ivory\GoogleMap\Base\Coordinate The destination.
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Sets the destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * Checks if it has the optimize waypoints.
     *
     * @return boolean TRUE if it has the optimize waypoints else FALSE.
     */
    public function hasOptimizeWaypoints()
    {
        return $this->optimizeWaypoints !== null;
    }

    /**
     * Checks if it optimizes waypoints.
     *
     * @return boolean TRUE if it optmizes waypoints else FALSE.
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }

    /**
     * Sets if it optimizes waypoints.
     *
     * @param boolean $optimizeWaypoints TRUE if it optimizes waypoints else FALSE.
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null)
    {
        $this->optimizeWaypoints = $optimizeWaypoints;
    }

    /**
     * Checks if it has an origin.
     *
     * @return boolean TRUE if the it has an origin else FALSE.
     */
    public function hasOrigin()
    {
        return !empty($this->origin);
    }

    /**
     * Gets the origin.
     *
     * @return string|\Ivory\GoogleMap\Base\Coordinate The origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * Checks if it has a departure time.
     *
     * @return boolean TRUE if it has a departure time else FALSE.
     */
    public function hasDepartureTime()
    {
        return $this->departureTime !== null;
    }

    /**
     * Gets the departure time.
     *
     * @return \DateTime The departure time.
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Sets the departure time
     *
     * @param \DateTime $departureTime The departure time.
     */
    public function setDepartureTime(\DateTime $departureTime = null)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * Checks if it has an arrival time.
     *
     * @return boolean TRUE if it has an arrival time else FALSE.
     */
    public function hasArrivalTime()
    {
        return $this->arrivalTime !== null;
    }

    /**
     * Gets the arrival time.
     *
     * @return \DateTime The arrival time.
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Sets the arrival time
     *
     * @param \DateTime $arrivalTime The arrival time.
     */
    public function setArrivalTime(\DateTime $arrivalTime = null)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * Checks if it has a provide route alternatives.
     *
     * @return boolean TRUE if the it has a provide route alternative else FALSE.
     */
    public function hasProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives !== null;
    }

    /**
     * Checks if it provides route alternatives.
     *
     * @return boolean TRUE if it provides route alternatives else FALSE.
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * Sets if it provides route alternatives.
     *
     * @param boolean $provideRouteAlternatives TRUE if it provides route alternatives else FALSE.
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null)
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;
    }

    /**
     * Checks if it has a region.
     *
     * @return boolean TRUE if it has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the region.
     *
     * @return string The region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the region.
     *
     * @param string $region The region.
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * Checks if it has a language.
     *
     * @return boolean TRUE if it has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the language.
     *
     * @return string The language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string $language The language.
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * Checks if it has a travel mode.
     *
     * @return boolean TRUE if it has a travel mode else FALSE.
     */
    public function hasTravelMode()
    {
        return $this->travelMode !== null;
    }

    /**
     * Gets the travel mode.
     *
     * @return string The travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the travel mode.
     *
     * @param string $travelMode The travel mode.
     */
    public function setTravelMode($travelMode = null)
    {
        $this->travelMode = $travelMode;
    }

    /**
     * Checks if it has a unit system.
     *
     * @return boolean TRUE if it has a unit system else FALSE.
     */
    public function hasUnitSystem()
    {
        return $this->unitSystem !== null;
    }

    /**
     * Gets the unit system.
     *
     * @return string The unit system.
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * Sets the unit system.
     *
     * @param string $unitSystem The unit system.
     */
    public function setUnitSystem($unitSystem = null)
    {
        $this->unitSystem = $unitSystem;
    }

    /**
     * Resets the waypoints.
     */
    public function resetWaypoints()
    {
        $this->waypoints = array();
    }

    /**
     * Checks if it have waypoints.
     *
     * @return boolean TRUE if it have waypoints else FALSE.
     */
    public function hasWaypoints()
    {
        return !empty($this->waypoints);
    }

    /**
     * Gets the waypoints.
     *
     * @return array The waypoints.
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * Sets the waypoints.
     *
     * @param array $waypoints The waypoints.
     */
    public function setWaypoints(array $waypoints)
    {
        $this->resetWaypoints();
        $this->addWaypoints($waypoints);
    }

    /**
     * Adds the waypoints.
     *
     * @param array $waypoints The waypoints.
     */
    public function addWaypoints(array $waypoints)
    {
        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    /**
     * Removes the waypoints.
     *
     * @param array $waypoints The waypoints.
     */
    public function removeWaypoints(array $waypoints)
    {
        foreach ($waypoints as $waypoint) {
            $this->removeWaypoint($waypoint);
        }
    }

    /**
     * Checks if there is a waypoint.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     *
     * @return boolean TRUE if there is the waypoint else FALSE.
     */
    public function hasWaypoint(DirectionsWaypoint $waypoint)
    {
        return in_array($waypoint, $this->waypoints, true);
    }

    /**
     * Adds a waypoint.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     */
    public function addWaypoint(DirectionsWaypoint $waypoint)
    {
        if (!$this->hasWaypoint($waypoint)) {
            $this->waypoints[] = $waypoint;
        }
    }

    /**
     * Removes a waypoint.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     */
    public function removeWaypoint(DirectionsWaypoint $waypoint)
    {
        unset($this->waypoints[array_search($waypoint, $this->waypoints, true)]);
    }

    /**
     * Checks if it has a sensor.
     *
     * @return boolean TRUE if it has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor.
     *
     * @param boolean $sensor TRUE if it has a sensor else FALSE.
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;
    }
}
