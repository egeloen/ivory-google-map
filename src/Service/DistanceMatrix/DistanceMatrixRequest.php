<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRequest
{
    /**
     * @var Coordinate[]|string[]
     */
    private $origins = [];

    /**
     * @var Coordinate[]|string[]
     */
    private $destinations = [];

    /**
     * @var \DateTime|null
     */
    private $departureTime;

    /**
     * @var \DateTime|null
     */
    private $arrivalTime;

    /**
     * @var string|null
     */
    private $travelMode;

    /**
     * @var string|null
     */
    private $avoid;

    /**
     * @var string|null
     */
    private $trafficModel;

    /**
     * @var string[]
     */
    private $transitModes = [];

    /**
     * @var string|null
     */
    private $transitRoutingPreference;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @var string|null
     */
    private $unitSystem;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @param Coordinate[]|string[] $origins
     * @param Coordinate[]|string[] $destinations
     */
    public function __construct(array $origins, array $destinations)
    {
        $this->setOrigins($origins);
        $this->setDestinations($destinations);
    }

    /**
     * @return bool
     */
    public function hasOrigins()
    {
        return !empty($this->origins);
    }

    /**
     * @return Coordinate[]|string[]
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * @param Coordinate[]|string[] $origins
     */
    public function setOrigins(array $origins)
    {
        $this->origins = [];
        $this->addOrigins($origins);
    }

    /**
     * @param Coordinate[]|string[] $origins
     */
    public function addOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * @param Coordinate|string $origin
     *
     * @return bool
     */
    public function hasOrigin($origin)
    {
        return in_array($origin, $this->origins, true);
    }

    /**
     * @param Coordinate|string $origin
     */
    public function addOrigin($origin)
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    /**
     * @param Coordinate|string $origin
     */
    public function removeOrigin($origin)
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
        $this->origins = array_values($this->origins);
    }

    /**
     * @return bool
     */
    public function hasDestinations()
    {
        return !empty($this->destinations);
    }

    /**
     * @return Coordinate[]|string[]
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @param Coordinate[]|string[] $destinations
     */
    public function setDestinations(array $destinations)
    {
        $this->destinations = [];
        $this->addDestinations($destinations);
    }

    /**
     * @param Coordinate[]|string[] $destinations
     */
    public function addDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * @param Coordinate|string $destination
     *
     * @return bool
     */
    public function hasDestination($destination)
    {
        return in_array($destination, $this->destinations, true);
    }

    /**
     * @param Coordinate|string $destination
     */
    public function addDestination($destination)
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    /**
     * @param Coordinate|string $destination
     */
    public function removeDestination($destination)
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
        $this->destinations = array_values($this->destinations);
    }

    /**
     * @return bool
     */
    public function hasDepartureTime()
    {
        return $this->departureTime !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param \DateTime|null $departureTime
     */
    public function setDepartureTime(\DateTime $departureTime = null)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return bool
     */
    public function hasArrivalTime()
    {
        return $this->arrivalTime !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param \DateTime|null $arrivalTime
     */
    public function setArrivalTime(\DateTime $arrivalTime = null)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return bool
     */
    public function hasTravelMode()
    {
        return $this->travelMode !== null;
    }

    /**
     * @return string|null
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * @param string|null $travelMode
     */
    public function setTravelMode($travelMode = null)
    {
        $this->travelMode = $travelMode;
    }

    /**
     * @return bool
     */
    public function hasAvoid()
    {
        return $this->avoid !== null;
    }

    /**
     * @return string|null
     */
    public function getAvoid()
    {
        return $this->avoid;
    }

    /**
     * @param string|null $avoid
     */
    public function setAvoid($avoid = null)
    {
        $this->avoid = $avoid;
    }

    /**
     * @return bool
     */
    public function hasTrafficModel()
    {
        return $this->trafficModel !== null;
    }

    /**
     * @return string|null
     */
    public function getTrafficModel()
    {
        return $this->trafficModel;
    }

    /**
     * @param string|null $trafficModel
     */
    public function setTrafficModel($trafficModel)
    {
        $this->trafficModel = $trafficModel;
    }

    /**
     * @return bool
     */
    public function hasTransitModes()
    {
        return !empty($this->transitModes);
    }

    /**
     * @return string[]
     */
    public function getTransitModes()
    {
        return $this->transitModes;
    }

    /**
     * @param string[] $transitModes
     */
    public function setTransitModes(array $transitModes)
    {
        $this->transitModes = [];
        $this->addTransitModes($transitModes);
    }

    /**
     * @param string[] $transitModes
     */
    public function addTransitModes(array $transitModes)
    {
        foreach ($transitModes as $transitMode) {
            $this->addTransitMode($transitMode);
        }
    }

    /**
     * @param string $transitMode
     *
     * @return bool
     */
    public function hasTransitMode($transitMode)
    {
        return in_array($transitMode, $this->transitModes, true);
    }

    /**
     * @param string $transitMode
     */
    public function addTransitMode($transitMode)
    {
        if (!$this->hasTransitMode($transitMode)) {
            $this->transitModes[] = $transitMode;
        }
    }

    /**
     * @param string $transitMode
     */
    public function removeTransitMode($transitMode)
    {
        unset($this->transitModes[array_search($transitMode, $this->transitModes, true)]);
        $this->transitModes = array_values($this->transitModes);
    }

    /**
     * @return bool
     */
    public function hasTransitRoutingPreference()
    {
        return $this->transitRoutingPreference !== null;
    }

    /**
     * @return string|null
     */
    public function getTransitRoutingPreference()
    {
        return $this->transitRoutingPreference;
    }

    /**
     * @param string|null $transitRoutingPreference
     */
    public function setTransitRoutingPreference($transitRoutingPreference)
    {
        $this->transitRoutingPreference = $transitRoutingPreference;
    }

    /**
     * @return bool
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * @return bool
     */
    public function hasUnitSystem()
    {
        return $this->unitSystem !== null;
    }

    /**
     * @return string|null
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * @param string|null $unitSystem
     */
    public function setUnitSystem($unitSystem = null)
    {
        $this->unitSystem = $unitSystem;
    }

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * @return mixed[]
     */
    public function buildQuery()
    {
        $query = [
            'origins'      => implode('|', $this->buildPlaces($this->origins)),
            'destinations' => implode('|', $this->buildPlaces($this->destinations)),
        ];

        if ($this->hasDepartureTime()) {
            $query['departure_time'] = $this->departureTime->getTimestamp();
        }

        if ($this->hasArrivalTime()) {
            $query['arrival_time'] = $this->arrivalTime->getTimestamp();
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->hasAvoid()) {
            $query['avoid'] = $this->avoid;
        }

        if ($this->hasTrafficModel()) {
            $query['traffic_model'] = $this->trafficModel;
        }

        if ($this->hasTransitModes()) {
            $query['transit_mode'] = implode('|', $this->transitModes);
        }

        if ($this->hasTransitRoutingPreference()) {
            $query['transit_routing_preference'] = $this->transitRoutingPreference;
        }

        if ($this->hasUnitSystem()) {
            $query['units'] = strtolower($this->unitSystem);
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    /**
     * @param Coordinate[]|string[] $places
     *
     * @return string[]
     */
    private function buildPlaces(array $places)
    {
        $result = [];

        foreach ($places as $place) {
            $result[] = $this->buildPlace($place);
        }

        return $result;
    }

    /**
     * @param Coordinate|string $place
     *
     * @return string
     */
    private function buildPlace($place)
    {
        if ($place instanceof Coordinate) {
            return $place->getLatitude().','.$place->getLongitude();
        }

        return $place;
    }
}
