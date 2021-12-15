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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Fare;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionRoute
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionRoute
{
    private ?Bound $bound = null;

    private ?string $copyrights = null;

    /**
     * @var DirectionLeg[]
     */
    private array $legs = [];

    private ?EncodedPolyline $overviewPolyline = null;

    private ?string $summary = null;

    private ?Fare $fare = null;

    /**
     * @var string[]
     */
    private array $warnings = [];

    /**
     * @var int[]
     */
    private array $waypointOrders = [];

    public function hasBound(): bool
    {
        return $this->bound !== null;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }

    public function hasCopyrights(): bool
    {
        return $this->copyrights !== null;
    }

    public function getCopyrights(): ?string
    {
        return $this->copyrights;
    }

    /**
     * @param string|null $copyrights
     */
    public function setCopyrights($copyrights = null): void
    {
        $this->copyrights = $copyrights;
    }

    public function hasLegs(): bool
    {
        return !empty($this->legs);
    }

    /**
     * @return DirectionLeg[]
     */
    public function getLegs(): array
    {
        return $this->legs;
    }

    /**
     * @param DirectionLeg[] $legs
     */
    public function setLegs(array $legs): void
    {
        $this->legs = [];
        $this->addLegs($legs);
    }

    /**
     * @param DirectionLeg[] $legs
     */
    public function addLegs(array $legs): void
    {
        foreach ($legs as $leg) {
            $this->addLeg($leg);
        }
    }

    public function hasLeg(DirectionLeg $leg): bool
    {
        return in_array($leg, $this->legs, true);
    }

    public function addLeg(DirectionLeg $leg): void
    {
        if (!$this->hasLeg($leg)) {
            $this->legs[] = $leg;
        }
    }

    public function removeLeg(DirectionLeg $leg): void
    {
        unset($this->legs[array_search($leg, $this->legs, true)]);
        $this->legs = empty($this->legs) ? [] : array_values($this->legs);
    }

    public function hasOverviewPolyline(): bool
    {
        return $this->overviewPolyline !== null;
    }

    public function getOverviewPolyline(): ?EncodedPolyline
    {
        return $this->overviewPolyline;
    }

    /**
     * @param EncodedPolyline|null $overviewPolyline
     */
    public function setOverviewPolyline(EncodedPolyline $overviewPolyline = null): void
    {
        $this->overviewPolyline = $overviewPolyline;
    }

    public function hasSummary(): bool
    {
        return $this->summary !== null;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     */
    public function setSummary($summary = null): void
    {
        $this->summary = $summary;
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

    public function hasWarnings(): bool
    {
        return !empty($this->warnings);
    }

    /**
     * @return string[]
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * @param string[] $warnings
     */
    public function setWarnings(array $warnings): void
    {
        $this->warnings = [];
        $this->addWarnings($warnings);
    }

    /**
     * @param string[] $warnings
     */
    public function addWarnings(array $warnings): void
    {
        foreach ($warnings as $warning) {
            $this->addWarning($warning);
        }
    }

    /**
     * @param $warning
     */
    public function hasWarning($warning): bool
    {
        return in_array($warning, $this->warnings, true);
    }

    /**
     * @param string $warning
     */
    public function addWarning($warning): void
    {
        if (!$this->hasWarning($warning)) {
            $this->warnings[] = $warning;
        }
    }

    /**
     * @param string $warning
     */
    public function removeWarning($warning): void
    {
        unset($this->warnings[array_search($warning, $this->warnings, true)]);
        $this->warnings = empty($this->warnings) ? [] : array_values($this->warnings);
    }

    public function hasWaypointOrders(): bool
    {
        return !empty($this->waypointOrders);
    }

    /**
     * @return int[]
     */
    public function getWaypointOrders(): array
    {
        return $this->waypointOrders;
    }

    /**
     * @param int[] $waypointOrders
     */
    public function setWaypointOrders(array $waypointOrders): void
    {
        $this->waypointOrders = [];
        $this->addWaypointOrders($waypointOrders);
    }

    /**
     * @param int[] $waypointOrders
     */
    public function addWaypointOrders(array $waypointOrders): void
    {
        $this->waypointOrders = [];

        foreach ($waypointOrders as $waypointOrder) {
            $this->addWaypointOrder($waypointOrder);
        }
    }

    public function hasWaypointOrder(int $waypointOrder): bool
    {
        return in_array($waypointOrder, $this->waypointOrders, true);
    }

    public function addWaypointOrder(int $waypointOrder): void
    {
        $this->waypointOrders[] = $waypointOrder;
    }
}
