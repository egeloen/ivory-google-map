<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Service\Base\Time;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitDetails
{
    private ?DirectionTransitStop $departureStop = null;

    private ?DirectionTransitStop $arrivalStop = null;

    private ?Time $departureTime = null;

    private ?Time $arrivalTime = null;

    private ?string $headSign = null;

    private ?int $headWay = null;

    private ?DirectionTransitLine $line = null;

    private ?int $numStops = null;

    public function hasDepartureStop(): bool
    {
        return $this->departureStop !== null;
    }

    public function getDepartureStop(): ?DirectionTransitStop
    {
        return $this->departureStop;
    }

    public function setDepartureStop(?DirectionTransitStop $departureStop = null): void
    {
        $this->departureStop = $departureStop;
    }

    public function hasArrivalStop(): bool
    {
        return $this->arrivalStop !== null;
    }

    public function getArrivalStop(): ?DirectionTransitStop
    {
        return $this->arrivalStop;
    }

    public function setArrivalStop(?DirectionTransitStop $arrivalStop = null): void
    {
        $this->arrivalStop = $arrivalStop;
    }

    public function hasDepartureTime(): bool
    {
        return $this->departureTime !== null;
    }

    public function getDepartureTime(): ?Time
    {
        return $this->departureTime;
    }

    public function setDepartureTime(?Time $departureTime = null): void
    {
        $this->departureTime = $departureTime;
    }

    public function hasArrivalTime(): bool
    {
        return $this->arrivalTime !== null;
    }

    public function getArrivalTime(): ?Time
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(?Time $arrivalTime = null): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function hasHeadSign(): bool
    {
        return $this->headSign !== null;
    }

    public function getHeadSign(): ?string
    {
        return $this->headSign;
    }

    public function setHeadSign(?string $headSign): void
    {
        $this->headSign = $headSign;
    }

    public function hasHeadWay(): bool
    {
        return $this->headWay !== null;
    }

    public function getHeadWay(): ?int
    {
        return $this->headWay;
    }

    public function setHeadWay(?int $headWay): void
    {
        $this->headWay = $headWay;
    }

    public function hasLine(): bool
    {
        return $this->line !== null;
    }

    public function getLine(): ?DirectionTransitLine
    {
        return $this->line;
    }

    public function setLine(?DirectionTransitLine $line = null): void
    {
        $this->line = $line;
    }

    public function hasNumStops(): bool
    {
        return $this->numStops !== null;
    }

    public function getNumStops(): ?int
    {
        return $this->numStops;
    }

    public function setNumStops(?int $numStops): void
    {
        $this->numStops = $numStops;
    }
}
