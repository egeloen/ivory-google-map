<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixElement
{
    private ?string $status = null;

    private ?Distance $distance = null;

    private ?Duration $duration = null;

    private ?Duration $durationInTraffic = null;

    private ?Fare $fare = null;

    public function hasStatus(): bool
    {
        return  $this->status !== null;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

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

    public function hasFare(): bool
    {
        return $this->fare !== null;
    }

    public function getFare(): ?Fare
    {
        return $this->fare;
    }

    /**
     * @param Fare|null $fare
     */
    public function setFare(Fare $fare = null): void
    {
        $this->fare = $fare;
    }
}
