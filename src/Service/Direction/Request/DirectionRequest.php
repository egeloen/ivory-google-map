<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Request;

use DateTime;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionRequest implements DirectionRequestInterface
{
    private ?LocationInterface $origin = null;

    private ?LocationInterface $destination = null;

    private ?DateTime $departureTime = null;

    private ?DateTime $arrivalTime = null;

    /**
     * @var DirectionWaypoint[]
     */
    private array $waypoints = [];

    private ?bool $optimizeWaypoints = null;

    private ?string $travelMode = null;

    private ?string $avoid = null;

    private ?bool $provideRouteAlternatives = null;

    private ?string $trafficModel = null;

    /**
     * @var string[]
     */
    private array $transitModes = [];

    private ?string $transitRoutingPreference = null;

    private ?string $region = null;

    private ?string $unitSystem = null;

    private ?string $language = null;

    public function __construct(LocationInterface $origin, LocationInterface $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
    }

    public function getOrigin(): LocationInterface
    {
        return $this->origin;
    }

    public function setOrigin(LocationInterface $origin): void
    {
        $this->origin = $origin;
    }

    public function getDestination(): LocationInterface
    {
        return $this->destination;
    }

    public function setDestination(LocationInterface $destination): void
    {
        $this->destination = $destination;
    }

    public function hasDepartureTime(): bool
    {
        return $this->departureTime !== null;
    }

    public function getDepartureTime(): ?DateTime
    {
        return $this->departureTime;
    }

    /**
     * @param DateTime|null $departureTime
     */
    public function setDepartureTime(DateTime $departureTime = null): void
    {
        $this->departureTime = $departureTime;
    }

    public function hasArrivalTime(): bool
    {
        return $this->arrivalTime !== null;
    }

    public function getArrivalTime(): ?DateTime
    {
        return $this->arrivalTime;
    }

    /**
     * @param DateTime|null $arrivalTime
     */
    public function setArrivalTime(DateTime $arrivalTime = null): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function hasWaypoints(): bool
    {
        return !empty($this->waypoints);
    }

    /**
     * @return DirectionWaypoint[]
     */
    public function getWaypoints(): array
    {
        return $this->waypoints;
    }

    /**
     * @param DirectionWaypoint[] $waypoints
     */
    public function setWaypoints(array $waypoints): void
    {
        $this->waypoints = [];
        $this->addWaypoints($waypoints);
    }

    /**
     * @param DirectionWaypoint[] $waypoints
     */
    public function addWaypoints(array $waypoints): void
    {
        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    public function hasWaypoint(DirectionWaypoint $waypoint): bool
    {
        return in_array($waypoint, $this->waypoints, true);
    }

    public function addWaypoint(DirectionWaypoint $waypoint): void
    {
        if (!$this->hasWaypoint($waypoint)) {
            $this->waypoints[] = $waypoint;
        }
    }

    public function removeWaypoint(DirectionWaypoint $waypoint): void
    {
        unset($this->waypoints[array_search($waypoint, $this->waypoints, true)]);
        $this->waypoints = empty($this->waypoints) ? [] : array_values($this->waypoints);
    }

    public function hasOptimizeWaypoints(): bool
    {
        return $this->optimizeWaypoints !== null;
    }

    public function getOptimizeWaypoints(): ?bool
    {
        return $this->optimizeWaypoints;
    }

    /**
     * @param bool|null $optimizeWaypoints
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null): void
    {
        $this->optimizeWaypoints = $optimizeWaypoints;
    }

    public function hasTravelMode(): bool
    {
        return $this->travelMode !== null;
    }

    public function getTravelMode(): ?string
    {
        return $this->travelMode;
    }

    /**
     * @param string|null $travelMode
     */
    public function setTravelMode($travelMode = null): void
    {
        $this->travelMode = $travelMode;
    }

    public function hasAvoid(): bool
    {
        return $this->avoid !== null;
    }

    public function getAvoid(): ?string
    {
        return $this->avoid;
    }

    /**
     * @param string|null $avoid
     */
    public function setAvoid($avoid = null): void
    {
        $this->avoid = $avoid;
    }

    public function hasProvideRouteAlternatives(): bool
    {
        return $this->provideRouteAlternatives !== null;
    }

    public function getProvideRouteAlternatives(): ?bool
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * @param bool|null $provideRouteAlternatives
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null): void
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;
    }

    public function hasTrafficModel(): bool
    {
        return $this->trafficModel !== null;
    }

    public function getTrafficModel(): ?string
    {
        return $this->trafficModel;
    }

    /**
     * @param string|null $trafficModel
     */
    public function setTrafficModel($trafficModel): void
    {
        $this->trafficModel = $trafficModel;
    }

    public function hasTransitModes(): bool
    {
        return !empty($this->transitModes);
    }

    /**
     * @return string[]
     */
    public function getTransitModes(): array
    {
        return $this->transitModes;
    }

    /**
     * @param string[] $transitModes
     */
    public function setTransitModes(array $transitModes): void
    {
        $this->transitModes = [];
        $this->addTransitModes($transitModes);
    }

    /**
     * @param string[] $transitModes
     */
    public function addTransitModes(array $transitModes): void
    {
        foreach ($transitModes as $transitMode) {
            $this->addTransitMode($transitMode);
        }
    }

    /**
     * @param string $transitMode
     */
    public function hasTransitMode($transitMode): bool
    {
        return in_array($transitMode, $this->transitModes, true);
    }

    /**
     * @param string $transitMode
     */
    public function addTransitMode($transitMode): void
    {
        if (!$this->hasTransitMode($transitMode)) {
            $this->transitModes[] = $transitMode;
        }
    }

    /**
     * @param string $transitMode
     */
    public function removeTransitMode($transitMode): void
    {
        unset($this->transitModes[array_search($transitMode, $this->transitModes, true)]);
        $this->transitModes = empty($this->transitModes) ? [] : array_values($this->transitModes);
    }

    public function hasTransitRoutingPreference(): bool
    {
        return $this->transitRoutingPreference !== null;
    }

    public function getTransitRoutingPreference(): ?string
    {
        return $this->transitRoutingPreference;
    }

    /**
     * @param string|null $transitRoutingPreference
     */
    public function setTransitRoutingPreference($transitRoutingPreference): void
    {
        $this->transitRoutingPreference = $transitRoutingPreference;
    }

    public function hasRegion(): bool
    {
        return $this->region !== null;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion($region = null): void
    {
        $this->region = $region;
    }

    public function hasUnitSystem(): bool
    {
        return $this->unitSystem !== null;
    }

    public function getUnitSystem(): ?string
    {
        return $this->unitSystem;
    }

    /**
     * @param string|null $unitSystem
     */
    public function setUnitSystem($unitSystem = null): void
    {
        $this->unitSystem = $unitSystem;
    }

    public function hasLanguage(): bool
    {
        return $this->language !== null;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language = null): void
    {
        $this->language = $language;
    }

    public function buildQuery(): array
    {
        $query = [
            'origin'      => $this->origin->buildQuery(),
            'destination' => $this->destination->buildQuery(),
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
                $waypoints[] = ($waypoint->getStopover() ? 'via:' : '').$waypoint->getLocation()->buildQuery();
            }

            $query['waypoints'] = implode('|', $waypoints);
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->hasAvoid()) {
            $query['avoid'] = $this->avoid;
        }

        if ($this->hasProvideRouteAlternatives()) {
            $query['alternatives'] = $this->provideRouteAlternatives ? 'true' : 'false';
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
}
