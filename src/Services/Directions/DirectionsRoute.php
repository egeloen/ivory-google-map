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
use Ivory\GoogleMap\Exception\DirectionsException;
use Ivory\GoogleMap\Overlays\EncodedPolyline;

/**
 * A directions route which describes a google map route.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRoute
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRoute
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var string */
    protected $copyrights;

    /** @var array */
    protected $legs;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    protected $overviewPolyline;

    /** @var string */
    protected $summary;

    /** @var array */
    protected $warnings;

    /** @var array */
    protected $waypointOrder;

    /**
     * Creates a directions route.
     *
     * @param \Ivory\GoogleMap\Base\Bound               $bound            The bound.
     * @param string                                    $copyrights       The copyrights.
     * @param array                                     $legs             The legs.
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $overviewPolyline The encoded polyline.
     * @param string                                    $summary          The summary.
     * @param array                                     $warnings         The warnings.
     * @param array                                     $waypointOrder    The waypoint order.
     */
    public function __construct(
        Bound $bound,
        $copyrights,
        array $legs,
        EncodedPolyline $overviewPolyline,
        $summary,
        array $warnings,
        array $waypointOrder
    ) {
        $this->setBound($bound);
        $this->setCopyrights($copyrights);
        $this->setLegs($legs);
        $this->setOverviewPolyline($overviewPolyline);
        $this->setSummary($summary);
        $this->setWarnings($warnings);
        $this->setWaypointOrder($waypointOrder);
    }

    /**
     * Gets the route bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The route bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the route bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The route bound.
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * Gets the route copyrights.
     *
     * @return string The route copyrights.
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }

    /**
     * Sets the route copyrights.
     *
     * @param string $copyrights The route copyrights.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the copyrights is not valid.
     */
    public function setCopyrights($copyrights)
    {
        if (!is_string($copyrights)) {
            throw DirectionsException::invalidDirectionsRouteCopyrights();
        }

        $this->copyrights = $copyrights;
    }

    /**
     * Gets the route legs
     *
     * @return array The route legs.
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * Sets the route legs
     *
     * @param array $legs The route legs.
     */
    public function setLegs(array $legs)
    {
        $this->legs = array();

        foreach ($legs as $leg) {
            $this->addLeg($leg);
        }
    }

    /**
     * Adds a leg to the route.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsLeg The leg to add.
     */
    public function addLeg(DirectionsLeg $leg)
    {
        $this->legs[] = $leg;
    }

    /**
     * Gets the route overview polyline.
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline The route overview polyline.
     */
    public function getOverviewPolyline()
    {
        return $this->overviewPolyline;
    }

    /**
     * Sets the route overview polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $overviewPolyline The route overview polyline.
     */
    public function setOverviewPolyline(EncodedPolyline $overviewPolyline)
    {
        $this->overviewPolyline = $overviewPolyline;
    }

    /**
     * Gets the route summary.
     *
     * @return string The route summary.
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets the route summary.
     *
     * @param string $summary The route summary.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the summary is not valid.
     */
    public function setSummary($summary)
    {
        if (!is_string($summary)) {
            throw DirectionsException::invalidDirectionsRouteSummary();
        }

        $this->summary = $summary;
    }

    /**
     * Gets the route warnings.
     *
     * @return array The route warnings.
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Sets the route warnings.
     *
     * @param array $warnings The route warnings.
     */
    public function setWarnings(array $warnings)
    {
        $this->warnings = array();

        foreach ($warnings as $warning) {
            $this->addWarning($warning);
        }
    }

    /**
     * Adds a warning to the route.
     *
     * @param string $warning The warning to add.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the warning is not valid.
     */
    public function addWarning($warning)
    {
        if (!is_string($warning)) {
            throw DirectionsException::invalidDirectionsRouteWarning();
        }

        $this->warnings[] = $warning;
    }

    /**
     * Gets the route waypoint order.
     *
     * @return array The route waypoint order.
     */
    public function getWaypointOrder()
    {
        return $this->waypointOrder;
    }

    /**
     * Sets the routes waypoint order.
     *
     * @param array $waypointOrder The route waypoint order.
     */
    public function setWaypointOrder(array $waypointOrder)
    {
        $this->waypointOrder = array();

        foreach ($waypointOrder as $waypointOrder) {
            $this->addWaypointOrder($waypointOrder);
        }
    }

    /**
     * Adds a waypoint order to the route.
     *
     * @param integer $waypointOrder The waypoint to add.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the waypoint order is not valid.
     */
    public function addWaypointOrder($waypointOrder)
    {
        if (!is_int($waypointOrder)) {
            throw DirectionsException::invalidDirectionsRouteWaypointOrder();
        }

        $this->waypointOrder[] = $waypointOrder;
    }
}
