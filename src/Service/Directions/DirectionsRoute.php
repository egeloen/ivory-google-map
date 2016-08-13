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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRoute
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRoute
{
    /**
     * @var Bound|null
     */
    private $bound;

    /**
     * @var string|null
     */
    private $copyrights;

    /**
     * @var DirectionsLeg[]
     */
    private $legs = [];

    /**
     * @var EncodedPolyline|null
     */
    private $overviewPolyline;

    /**
     * @var string|null
     */
    private $summary;

    /**
     * @var DirectionsFare|null
     */
    private $fare;

    /**
     * @var string[]
     */
    private $warnings = [];

    /**
     * @var int[]
     */
    private $waypointOrders = [];

    /**
     * @return bool
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }

    /**
     * @return bool
     */
    public function hasCopyrights()
    {
        return $this->copyrights !== null;
    }

    /**
     * @return string|null
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }

    /**
     * @param string|null $copyrights
     */
    public function setCopyrights($copyrights = null)
    {
        $this->copyrights = $copyrights;
    }

    /**
     * @return bool
     */
    public function hasLegs()
    {
        return !empty($this->legs);
    }

    /**
     * @return DirectionsLeg[]
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * @param DirectionsLeg[] $legs
     */
    public function setLegs(array $legs)
    {
        $this->legs = [];
        $this->addLegs($legs);
    }

    /**
     * @param DirectionsLeg[] $legs
     */
    public function addLegs(array $legs)
    {
        foreach ($legs as $leg) {
            $this->addLeg($leg);
        }
    }

    /**
     * @param DirectionsLeg $leg
     *
     * @return bool
     */
    public function hasLeg(DirectionsLeg $leg)
    {
        return in_array($leg, $this->legs, true);
    }

    /**
     * @param DirectionsLeg $leg
     */
    public function addLeg(DirectionsLeg $leg)
    {
        if (!$this->hasLeg($leg)) {
            $this->legs[] = $leg;
        }
    }

    /**
     * @param DirectionsLeg $leg
     */
    public function removeLeg(DirectionsLeg $leg)
    {
        unset($this->legs[array_search($leg, $this->legs, true)]);
        $this->legs = array_values($this->legs);
    }

    /**
     * @return bool
     */
    public function hasOverviewPolyline()
    {
        return $this->overviewPolyline !== null;
    }

    /**
     * @return EncodedPolyline|null
     */
    public function getOverviewPolyline()
    {
        return $this->overviewPolyline;
    }

    /**
     * @param EncodedPolyline|null $overviewPolyline
     */
    public function setOverviewPolyline(EncodedPolyline $overviewPolyline = null)
    {
        $this->overviewPolyline = $overviewPolyline;
    }

    /**
     * @return bool
     */
    public function hasSummary()
    {
        return $this->summary !== null;
    }

    /**
     * @return string|null
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     */
    public function setSummary($summary = null)
    {
        $this->summary = $summary;
    }

    /**
     * @return bool
     */
    public function hasFare()
    {
        return $this->fare !== null;
    }

    /**
     * @return DirectionsFare|null
     */
    public function getFare()
    {
        return $this->fare;
    }

    /**
     * @param DirectionsFare|null $fare
     */
    public function setFare(DirectionsFare $fare = null)
    {
        $this->fare = $fare;
    }

    /**
     * @return bool
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return string[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param string[] $warnings
     */
    public function setWarnings(array $warnings)
    {
        $this->warnings = [];
        $this->addWarnings($warnings);
    }

    /**
     * @param string[] $warnings
     */
    public function addWarnings(array $warnings)
    {
        foreach ($warnings as $warning) {
            $this->addWarning($warning);
        }
    }

    /**
     * @param $warning
     *
     * @return bool
     */
    public function hasWarning($warning)
    {
        return in_array($warning, $this->warnings, true);
    }

    /**
     * @param string $warning
     */
    public function addWarning($warning)
    {
        if (!$this->hasWarning($warning)) {
            $this->warnings[] = $warning;
        }
    }

    /**
     * @param string $warning
     */
    public function removeWarning($warning)
    {
        unset($this->warnings[array_search($warning, $this->warnings, true)]);
    }

    /**
     * @return bool
     */
    public function hasWaypointOrders()
    {
        return !empty($this->waypointOrders);
    }

    /**
     * @return int[]
     */
    public function getWaypointOrders()
    {
        return $this->waypointOrders;
    }

    /**
     * @param int[] $waypointOrders
     */
    public function setWaypointOrders(array $waypointOrders)
    {
        $this->waypointOrders = [];
        $this->addWaypointOrders($waypointOrders);
    }

    /**
     * @param int[] $waypointOrders
     */
    public function addWaypointOrders(array $waypointOrders)
    {
        $this->waypointOrders = [];

        foreach ($waypointOrders as $waypointOrder) {
            $this->addWaypointOrder($waypointOrder);
        }
    }

    /**
     * @param $waypointOrder
     *
     * @return bool
     */
    public function hasWaypointOrder($waypointOrder)
    {
        return in_array($waypointOrder, $this->waypointOrders, true);
    }

    /**
     * @param int $waypointOrder
     */
    public function addWaypointOrder($waypointOrder)
    {
        $this->waypointOrders[] = $waypointOrder;
    }
}
