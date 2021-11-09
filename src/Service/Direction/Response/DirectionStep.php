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
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionStep
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionStep
{
    private ?Distance $distance = null;

    private ?Duration $duration = null;

    private ?Coordinate $startLocation = null;

    private ?Coordinate $endLocation = null;

    private ?string $instructions = null;

    private ?EncodedPolyline $encodedPolyline = null;

    private ?string $travelMode = null;

    private ?DirectionTransitDetails $transitDetails = null;

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

    public function hasInstructions(): bool
    {
        return $this->instructions !== null;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    /**
     * @param string|null $instructions
     */
    public function setInstructions($instructions = null): void
    {
        $this->instructions = $instructions;
    }

    public function hasEncodedPolyline(): bool
    {
        return $this->encodedPolyline !== null;
    }

    public function getEncodedPolyline(): ?EncodedPolyline
    {
        return $this->encodedPolyline;
    }

    /**
     * @param EncodedPolyline|null $encodedPolyline
     */
    public function setEncodedPolyline(EncodedPolyline $encodedPolyline = null): void
    {
        $this->encodedPolyline = $encodedPolyline;
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

    public function hasTransitDetails(): bool
    {
        return $this->transitDetails !== null;
    }

    public function getTransitDetails(): ?DirectionTransitDetails
    {
        return $this->transitDetails;
    }

    /**
     * @param DirectionTransitDetails|null $transitDetails
     */
    public function setTransitDetails(DirectionTransitDetails $transitDetails = null): void
    {
        $this->transitDetails = $transitDetails;
    }
}
