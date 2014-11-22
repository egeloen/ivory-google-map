<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlays\EncodedPolyline;

/**
 * Directions route.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRoute
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRoute
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    private $bound;

    /** @var string */
    private $copyrights;

    /** @var array */
    private $legs;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    private $overviewPolyline;

    /** @var string */
    private $summary;

    /** @var array */
    private $warnings;

    /** @var array */
    private $waypointOrders;

    /**
     * Creates a directions route.
     *
     * @param \Ivory\GoogleMap\Base\Bound               $bound            The bound.
     * @param string                                    $copyrights       The copyrights.
     * @param array                                     $legs             The legs.
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $overviewPolyline The encoded polyline.
     * @param string                                    $summary          The summary.
     * @param array                                     $warnings         The warnings.
     * @param array                                     $waypointOrders   The waypoint orders.
     */
    public function __construct(
        Bound $bound,
        $copyrights,
        array $legs,
        EncodedPolyline $overviewPolyline,
        $summary,
        array $warnings,
        array $waypointOrders
    ) {
        $this->setBound($bound);
        $this->setCopyrights($copyrights);
        $this->setLegs($legs);
        $this->setOverviewPolyline($overviewPolyline);
        $this->setSummary($summary);
        $this->setWarnings($warnings);
        $this->setWaypointOrders($waypointOrders);
    }

    /**
     * Gets the bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * Gets the copyrights.
     *
     * @return string The copyrights.
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }

    /**
     * Sets the copyrights.
     *
     * @param string $copyrights The copyrights.
     */
    public function setCopyrights($copyrights)
    {
        $this->copyrights = $copyrights;
    }

    /**
     * Resets the legs.
     */
    public function resetLegs()
    {
        $this->legs = array();
    }

    /**
     * Checks if there are legs.
     *
     * @return boolean TRUE if there are legs else FALSE.
     */
    public function hasLegs()
    {
        return !empty($this->legs);
    }

    /**
     * Gets the legs
     *
     * @return array The legs.
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * Sets the legs
     *
     * @param array $legs The legs.
     */
    public function setLegs(array $legs)
    {
        $this->resetLegs();
        $this->addLegs($legs);
    }

    /**
     * Adds the legs.
     *
     * @param array $legs The legs.
     */
    public function addLegs(array $legs)
    {
        foreach ($legs as $leg) {
            $this->addLeg($leg);
        }
    }

    /**
     * Removes the legs.
     *
     * @param array $legs The legs.
     */
    public function removeLegs(array $legs)
    {
        foreach ($legs as $leg) {
            $this->removeLeg($leg);
        }
    }

    /**
     * Checks if there is a leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg $leg The leg.
     *
     * @return boolean TRUE if there is the leg else FALSE.
     */
    public function hasLeg(DirectionsLeg $leg)
    {
        return in_array($leg, $this->legs, true);
    }

    /**
     * Adds a leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg The leg.
     */
    public function addLeg(DirectionsLeg $leg)
    {
        if (!$this->hasLeg($leg)) {
            $this->legs[] = $leg;
        }
    }

    /**
     * Removes a leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg $leg The leg.
     */
    public function removeLeg(DirectionsLeg $leg)
    {
        unset($this->legs[array_search($leg, $this->legs, true)]);
    }

    /**
     * Gets the overview polyline.
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline The overview polyline.
     */
    public function getOverviewPolyline()
    {
        return $this->overviewPolyline;
    }

    /**
     * Sets the overview polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $overviewPolyline The overview polyline.
     */
    public function setOverviewPolyline(EncodedPolyline $overviewPolyline)
    {
        $this->overviewPolyline = $overviewPolyline;
    }

    /**
     * Gets the summary.
     *
     * @return string The summary.
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets the summary.
     *
     * @param string $summary The summary.
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * Resets the warnings.
     */
    public function resetWarnings()
    {
        $this->warnings = array();
    }

    /**
     * Checks if there are warnings.
     *
     * @return boolean TRUE if there are warnings else FALSE.
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * Gets the warnings.
     *
     * @return array The warnings.
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Sets the warnings.
     *
     * @param array $warnings The warnings.
     */
    public function setWarnings(array $warnings)
    {
        $this->resetWarnings();
        $this->addWarnings($warnings);
    }

    /**
     * Adds the warnings.
     *
     * @param array $warnings The warnings.
     */
    public function addWarnings(array $warnings)
    {
        foreach ($warnings as $warning) {
            $this->addWarning($warning);
        }
    }

    /**
     * Removes the warnings.
     *
     * @param array $warnings The warnings.
     */
    public function removeWarnings(array $warnings)
    {
        foreach ($warnings as $warning) {
            $this->removeWarning($warning);
        }
    }

    /**
     * Checks if there is a warning.
     *
     * @param string $warning The warning.
     *
     * @return boolean TRUE if there is a warning else FALSE.
     */
    public function hasWarning($warning)
    {
        return in_array($warning, $this->warnings, true);
    }

    /**
     * Adds a warning.
     *
     * @param string $warning The warning.
     */
    public function addWarning($warning)
    {
        if (!$this->hasWarning($warning)) {
            $this->warnings[] = $warning;
        }
    }

    /**
     * Removes a warning.
     *
     * @param string $warning The warning.
     */
    public function removeWarning($warning)
    {
        unset($this->warnings[array_search($warning, $this->warnings, true)]);
    }

    /**
     * Resets the warypoint orders.
     */
    public function resetWaypointOrders()
    {
        $this->waypointOrders = array();
    }

    /**
     * Checks if there are waypoint orders.
     *
     * @return boolean TRUE if there are waypoint orders else FALSE.
     */
    public function hasWaypointOrders()
    {
        return !empty($this->waypointOrders);
    }

    /**
     * Gets the waypoint orders.
     *
     * @return array The waypoint orders.
     */
    public function getWaypointOrders()
    {
        return $this->waypointOrders;
    }

    /**
     * Sets the waypoint orders.
     *
     * @param array $waypointOrders The waypoint orders.
     */
    public function setWaypointOrders(array $waypointOrders)
    {
        $this->resetWaypointOrders();
        $this->addWaypointOrders($waypointOrders);
    }

    /**
     * Adds the waypoint orders.
     *
     * @param array $waypointOrders The waypoint orders.
     */
    public function addWaypointOrders(array $waypointOrders)
    {
        foreach ($waypointOrders as $waypointOrder) {
            $this->addWaypointOrder($waypointOrder);
        }
    }

    /**
     * Removes the waypoint orders.
     *
     * @param array $waypointOrders The waypoint orders.
     */
    public function removeWaypointOrders(array $waypointOrders)
    {
        foreach ($waypointOrders as $waypointOrder) {
            $this->removeWaypointOrder($waypointOrder);
        }
    }

    /**
     * Checks if there is a waypoint order.
     *
     * @param integer $waypointOrder The waypoint order.
     *
     * @return boolean TRUE if there is the waypoint order else FALSE.
     */
    public function hasWaypointOrder($waypointOrder)
    {
        return in_array($waypointOrder, $this->waypointOrders, true);
    }

    /**
     * Adds a waypoint order.
     *
     * @param integer $waypointOrder The waypoint order.
     */
    public function addWaypointOrder($waypointOrder)
    {
        if (!$this->hasWaypointOrder($waypointOrder)) {
            $this->waypointOrders[] = $waypointOrder;
        }
    }

    /**
     * Removes a waypoint order.
     *
     * @param integer $waypointOrder The waypoint order.
     */
    public function removeWaypointOrder($waypointOrder)
    {
        unset($this->waypointOrders[array_search($waypointOrder, $this->waypointOrders, true)]);
    }
}
