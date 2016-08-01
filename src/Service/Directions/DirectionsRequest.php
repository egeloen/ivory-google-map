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

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequest
{
    /**
     * @var Coordinate|string
     */
    private $origin;

    /**
     * @var Coordinate|string
     */
    private $destination;

    /**
     * @var \DateTime|null
     */
    private $departureTime;

    /**
     * @var \DateTime|null
     */
    private $arrivalTime;

    /**
     * @var DirectionsWaypoint[]
     */
    private $waypoints = [];

    /**
     * @var bool|null
     */
    private $optimizeWaypoints;

    /**
     * @var string|null
     */
    private $travelMode;

    /**
     * @var bool|null
     */
    private $avoidHighways;

    /**
     * @var bool|null
     */
    private $avoidTolls;

    /**
     * @var bool|null
     */
    private $provideRouteAlternatives;

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
     * @param Coordinate|string $origin
     * @param Coordinate|string $destination
     */
    public function __construct($origin, $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
    }

    /**
     * @return Coordinate|string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param Coordinate|string $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return Coordinate|string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param Coordinate|string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
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
    public function hasWaypoints()
    {
        return !empty($this->waypoints);
    }

    /**
     * @return DirectionsWaypoint[]
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * @param DirectionsWaypoint[] $waypoints
     */
    public function setWaypoints(array $waypoints)
    {
        $this->waypoints = [];
        $this->addWaypoints($waypoints);
    }

    /**
     * @param DirectionsWaypoint[] $waypoints
     */
    public function addWaypoints(array $waypoints)
    {
        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    /**
     * @param DirectionsWaypoint $waypoint
     *
     * @return bool
     */
    public function hasWaypoint(DirectionsWaypoint $waypoint)
    {
        return in_array($waypoint, $this->waypoints, true);
    }

    /**
     * @param DirectionsWaypoint $waypoint
     */
    public function addWaypoint(DirectionsWaypoint $waypoint)
    {
        if (!$this->hasWaypoint($waypoint)) {
            $this->waypoints[] = $waypoint;
        }
    }

    /**
     * @param DirectionsWaypoint $waypoint
     */
    public function removeWaypoint(DirectionsWaypoint $waypoint)
    {
        unset($this->waypoints[array_search($waypoint, $this->waypoints, true)]);
    }

    /**
     * @return bool
     */
    public function hasOptimizeWaypoints()
    {
        return $this->optimizeWaypoints !== null;
    }

    /**
     * @return bool|null
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }

    /**
     * @param bool|null $optimizeWaypoints
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null)
    {
        $this->optimizeWaypoints = $optimizeWaypoints;
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
    public function hasAvoidTolls()
    {
        return $this->avoidTolls !== null;
    }

    /**
     * @return bool|null
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * @param bool|null $avoidTolls
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        $this->avoidTolls = $avoidTolls;

        if ($this->hasAvoidTolls()) {
            $this->setAvoidHighways(null);
        }
    }

    /**
     * @return bool
     */
    public function hasAvoidHighways()
    {
        return $this->avoidHighways !== null;
    }

    /**
     * @return bool|null
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * @param bool|null $avoidHighways
     */
    public function setAvoidHighways($avoidHighways = null)
    {
        $this->avoidHighways = $avoidHighways;

        if ($this->hasAvoidHighways()) {
            $this->setAvoidTolls(null);
        }
    }

    /**
     * @return bool
     */
    public function hasProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives !== null;
    }

    /**
     * @return bool|null
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * @param bool|null $provideRouteAlternatives
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null)
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;
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
            'origin'      => $this->buildPlace($this->origin),
            'destination' => $this->buildPlace($this->destination),
        ];

        if ($this->hasDepartureTime()) {
            $query['departure_time'] = $this->departureTime->getTimestamp();
        }

        if ($this->hasArrivalTime()) {
            $query['arrival_time'] = $this->arrivalTime->getTimestamp();
        }

        if ($this->hasWaypoints()) {
            $waypoints = [];

            if ($this->optimizeWaypoints) {
                $waypoints[] = 'optimize:true';
            }

            foreach ($this->waypoints as $waypoint) {
                $stopover = $waypoint->getStopover() ? 'via:' : '';
                $waypoints[] = $stopover.$this->buildPlace($waypoint->getLocation());
            }

            $query['waypoints'] = implode('|', $waypoints);
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->avoidTolls) {
            $query['avoid'] = 'tolls';
        } elseif ($this->avoidHighways) {
            $query['avoid'] = 'highways';
        }

        if ($this->hasProvideRouteAlternatives()) {
            $query['alternatives'] = $this->provideRouteAlternatives ? 'true' : 'false';
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasUnitSystem()) {
            $query['units'] = strtolower($this->unitSystem);
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
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
