<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Time;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionLeg
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionLeg
{
    private ?Distance $distance = null;

    private ?Duration $duration = null;

    private ?Duration $durationInTraffic = null;

    private ?Time $arrivalTime = null;

    private ?Time $departureTime = null;

    private ?string $endAddress = null;

    private ?Coordinate $endLocation = null;

    private ?string $startAddress = null;

    private ?Coordinate $startLocation = null;

    /**
     * @var DirectionStep[]
     */
    private array $steps = [];

    /**
     * @var DirectionWaypoint[]
     */
    private array $viaWaypoints = [];

    public function hasDistance(): bool
    {
        return $this->distance !== null;
    }

    public function getDistance(): ?Distance
    {
        return $this->distance;
    }

    /**
     * @param Distance|null $distance
     */
    public function setDistance(Distance $distance = null): void
    {
        $this->distance = $distance;
    }

    public function hasDuration(): bool
    {
        return $this->duration !== null;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    /**
     * @param Duration|null $duration
     */
    public function setDuration(Duration $duration = null): void
    {
        $this->duration = $duration;
    }

    public function hasDurationInTraffic(): bool
    {
        return $this->durationInTraffic !== null;
    }

    public function getDurationInTraffic(): ?Duration
    {
        return $this->durationInTraffic;
    }

    /**
     * @param Duration|null $durationInTraffic
     */
    public function setDurationInTraffic(Duration $durationInTraffic = null): void
    {
        $this->durationInTraffic = $durationInTraffic;
    }

    public function hasArrivalTime(): bool
    {
        return $this->arrivalTime !== null;
    }

    public function getArrivalTime(): ?Time
    {
        return $this->arrivalTime;
    }

    /**
     * @param Time|null $arrivalTime
     */
    public function setArrivalTime(Time $arrivalTime = null): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function hasDepartureTime(): bool
    {
        return $this->departureTime !== null;
    }

    public function getDepartureTime(): ?Time
    {
        return $this->departureTime;
    }

    /**
     * @param Time|null $departureTime
     */
    public function setDepartureTime(Time $departureTime = null): void
    {
        $this->departureTime = $departureTime;
    }

    public function hasEndAddress(): bool
    {
        return $this->endAddress !== null;
    }

    public function getEndAddress(): ?string
    {
        return $this->endAddress;
    }

    /**
     * @param string|null $endAddress
     */
    public function setEndAddress($endAddress = null): void
    {
        $this->endAddress = $endAddress;
    }

    public function hasEndLocation(): bool
    {
        return $this->endLocation !== null;
    }

    public function getEndLocation(): ?Coordinate
    {
        return $this->endLocation;
    }

    /**
     * @param Coordinate|null $endLocation
     */
    public function setEndLocation(Coordinate $endLocation = null): void
    {
        $this->endLocation = $endLocation;
    }

    public function hasStartAddress(): bool
    {
        return $this->startAddress !== null;
    }

    public function getStartAddress(): ?string
    {
        return $this->startAddress;
    }

    /**
     * @param string|null $startAddress
     */
    public function setStartAddress($startAddress = null): void
    {
        $this->startAddress = $startAddress;
    }

    public function hasStartLocation(): bool
    {
        return $this->startLocation !== null;
    }

    public function getStartLocation(): ?Coordinate
    {
        return $this->startLocation;
    }

    /**
     * @param Coordinate|null $startLocation
     */
    public function setStartLocation(Coordinate $startLocation = null): void
    {
        $this->startLocation = $startLocation;
    }

    public function hasSteps(): bool
    {
        return !empty($this->steps);
    }

    /**
     * @return DirectionStep[]
     */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /**
     * @param DirectionStep[] $steps
     */
    public function setSteps(array $steps): void
    {
        $this->steps = [];
        $this->addSteps($steps);
    }

    /**
     * @param DirectionStep[] $steps
     */
    public function addSteps(array $steps): void
    {
        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    public function hasStep(DirectionStep $step): bool
    {
        return in_array($step, $this->steps, true);
    }

    public function addStep(DirectionStep $step): void
    {
        if (!$this->hasStep($step)) {
            $this->steps[] = $step;
        }
    }

    public function removeStep(DirectionStep $step): void
    {
        unset($this->steps[array_search($step, $this->steps, true)]);
        $this->steps = empty($this->steps) ? [] : array_values($this->steps);
    }

    public function hasViaWaypoints(): bool
    {
        return !empty($this->viaWaypoints);
    }

    /**
     * @return DirectionWaypoint[]
     */
    public function getViaWaypoints(): array
    {
        return $this->viaWaypoints;
    }

    /**
     * @param DirectionWaypoint[] $viaWaypoints
     */
    public function setViaWaypoints(array $viaWaypoints): void
    {
        $this->viaWaypoints = [];
        $this->addViaWaypoints($viaWaypoints);
    }

    /**
     * @param DirectionWaypoint[] $viaWaypoints
     */
    public function addViaWaypoints(array $viaWaypoints): void
    {
        foreach ($viaWaypoints as $viaWaypoint) {
            $this->addViaWaypoint($viaWaypoint);
        }
    }

    public function hasViaWaypoint(DirectionWaypoint $viaWaypoint): bool
    {
        return in_array($viaWaypoint, $this->viaWaypoints, true);
    }

    public function addViaWaypoint(DirectionWaypoint $viaWaypoint): void
    {
        if (!$this->hasViaWaypoint($viaWaypoint)) {
            $this->viaWaypoints[] = $viaWaypoint;
        }
    }

    public function removeViaWaypoint(DirectionWaypoint $viaWaypoint): void
    {
        unset($this->viaWaypoints[array_search($viaWaypoint, $this->viaWaypoints, true)]);
        $this->viaWaypoints = empty($this->viaWaypoints) ? [] : array_values($this->viaWaypoints);
    }
}
