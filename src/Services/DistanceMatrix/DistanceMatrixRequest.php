<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

/**
 * Distance matrix request.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRequest
{
    /** @var boolean|null */
    private $avoidHighways;

    /** @var boolean|null */
    private $avoidTolls;

    /** @var array */
    private $destinations;

    /** @var array */
    private $origins;

    /** @var string|null */
    private $region;

    /** @var string|null */
    private $language;

    /** @var string|null */
    private $travelMode;

    /** @var string|null */
    private $unitSystem;

    /** @var boolean */
    private $sensor = false;

    /**
     * Creates a distance matrix request.
     *
     * @param array $origins      The origins.
     * @param array $destinations The destinations.
     */
    public function __construct(array $origins, array $destinations)
    {
        $this->setOrigins($origins);
        $this->setDestinations($destinations);
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
     * @return boolean|null TRUE if it avoids hightways else FALSE.
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * Sets if it avoids hightways.
     *
     * @param boolean|null $avoidHighways TRUE if it avoids hightways else FALSE.
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
     * Checks if it avoids tolls.
     *
     * @return boolean|null TRUE if it avoids tolls else FALSE.
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * Sets if it avoids tolls.
     *
     * @param boolean|null $avoidTolls TRUE if it avoids tolls else FALSE.
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        $this->avoidTolls = $avoidTolls;
    }

    /**
     * Resets the destinations.
     */
    public function resetDestinations()
    {
        $this->destinations = array();
    }

    /**
     * Checks if it has destinations.
     *
     * @return boolean TRUE if it has a destination else FALSE.
     */
    public function hasDestinations()
    {
        return !empty($this->destinations);
    }

    /**
     * Gets the destinations
     *
     * @return array The destinations.
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Sets the destinations.
     *
     * @param array $destinations The destinations.
     */
    public function setDestinations(array $destinations)
    {
        $this->resetDestinations();
        $this->addDestinations($destinations);
    }

    /**
     * Adds the destinations.
     *
     * @param array $destinations The destinations.
     */
    public function addDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * Removes the destination.
     *
     * @param array $destinations The destinations.
     */
    public function removeDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->removeDestination($destination);
        }
    }

    /**
     * Check if there is a destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     *
     * @return boolean TRUE if there is the destination else FALSE.
     */
    public function hasDestination($destination)
    {
        return in_array($destination, $this->destinations, true);
    }

    /**
     * Adds a destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    public function addDestination($destination)
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    /**
     * Removes a destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $detination The destination.
     */
    public function removeDestination($detination)
    {
        unset($this->destinations[array_search($detination, $this->destinations, true)]);
    }

    /**
     * Resets the origins.
     */
    public function resetOrigins()
    {
        $this->origins = array();
    }

    /**
     * Checks if there are origins.
     *
     * @return boolean TRUE if there are origins else FALSE.
     */
    public function hasOrigins()
    {
        return !empty($this->origins);
    }

    /**
     * Gets the origins.
     *
     * @return array The origins.
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * Sets the origins.
     *
     * @param array $origins The origins.
     */
    public function setOrigins(array $origins)
    {
        $this->resetOrigins();
        $this->addOrigins($origins);
    }

    /**
     * Adds the origins.
     *
     * @param array $origins The origins.
     */
    public function addOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * Removes the origins.
     *
     * @param array $origins The origins.
     */
    public function removeOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->removeOrigin($origin);
        }
    }

    /**
     * Checks if there is an origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     *
     * @return boolean TRUE if there is the origin else FALSE.
     */
    public function hasOrigin($origin)
    {
        return in_array($origin, $this->origins, true);
    }

    /**
     * Adds an origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     */
    public function addOrigin($origin)
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    /**
     * Removes an origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     */
    public function removeOrigin($origin)
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
    }

    /**
     * Checks if there is a region.
     *
     * @return boolean TRUE if there is a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the region.
     *
     * @return string|null The region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the region.
     *
     * @param string|null $region The region.
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * Checks if there is a language.
     *
     * @return boolean TRUE if there is a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the language.
     *
     * @return string|null The language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string|null $language The language.
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * Checks if there is a travel mode.
     *
     * @return boolean TRUE if there is a travel mode else FALSE.
     */
    public function hasTravelMode()
    {
        return $this->travelMode !== null;
    }

    /**
     * Gets the travel mode.
     *
     * @return string|null The travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the travel mode.
     *
     * @param string|null $travelMode The travel mode.
     */
    public function setTravelMode($travelMode = null)
    {
        $this->travelMode = $travelMode;
    }

    /**
     * Checks if there is a unit system.
     *
     * @return boolean TRUE if there is a unit system else FALSE.
     */
    public function hasUnitSystem()
    {
        return $this->unitSystem !== null;
    }

    /**
     * Gets the unit system.
     *
     * @return string|null The unit system.
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * Sets the unit system.
     *
     * @param string|null $unitSystem The unit system.
     */
    public function setUnitSystem($unitSystem = null)
    {
        $this->unitSystem = $unitSystem;
    }

    /**
     * Checks if there is a sensor.
     *
     * @return boolean TRUE if there is a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor.
     *
     * @param boolean $sensor TRUE if there is a sensor else FALSE.
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;
    }
}
