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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;

/**
 * Directions leg.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsLeg
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLeg
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    private $duration;

    /** @var string */
    private $endAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $endLocation;

    /** @var string */
    private $startAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $startLocation;

    /** @var array */
    private $steps;

    /** @var array */
    private $viaWaypoints;

    /**
     * Creates a directions leg.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance      The distance.
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration      The duration.
     * @param string                                  $endAddress    The end address.
     * @param \Ivory\GoogleMap\Base\Coordinate        $endLocation   The end location.
     * @param string                                  $startAddress  The start address.
     * @param \Ivory\GoogleMap\Base\Coordinate        $startLocation The start location.
     * @param array                                   $steps         The steps.
     * @param array                                   $viaWaypoint   The via waypoint.
     */
    public function __construct(
        Distance $distance,
        Duration $duration,
        $endAddress,
        Coordinate $endLocation,
        $startAddress,
        Coordinate $startLocation,
        array $steps,
        array $viaWaypoint
    ) {
        $this->setDistance($distance);
        $this->setDuration($duration);
        $this->setEndAddress($endAddress);
        $this->setEndLocation($endLocation);
        $this->setStartAddress($startAddress);
        $this->setStartLocation($startLocation);
        $this->setSteps($steps);
        $this->setViaWaypoints($viaWaypoint);
    }

    /**
     * Gets the distance.
     *
     * @return \Ivory\GoogleMap\Services\Base\Distance The distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the distance.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance The distance.
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the duration.
     *
     * @return \Ivory\GoogleMap\Services\Base\Duration The duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the duration.
     *
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Gets the end address.
     *
     * @return string The end address.
     */
    public function getEndAddress()
    {
        return $this->endAddress;
    }

    /**
     * Sets the end address.
     *
     * @param string The end address.
     */
    public function setEndAddress($endAddress)
    {
        $this->endAddress = $endAddress;
    }

    /**
     * Gets the end location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The end location.
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }

    /**
     * Sets the end location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $endLocation The end location.
     */
    public function setEndLocation(Coordinate $endLocation)
    {
        $this->endLocation = $endLocation;
    }

    /**
     * Gets the start address.
     *
     * @return string The start address.
     */
    public function getStartAddress()
    {
        return $this->startAddress;
    }

    /**
     * Sets the start address.
     *
     * @param string $startAddress The start address.
     */
    public function setStartAddress($startAddress)
    {
        $this->startAddress = $startAddress;
    }

    /**
     * Gets the start location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The start location.
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }

    /**
     * Sets the start location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $startLocation The start location.
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }

    /**
     * Resets the steps.
     */
    public function resetSteps()
    {
        $this->steps = array();
    }

    /**
     * Checks if there are steps.
     *
     * @return boolean TRUE if there are steps else FALSE.
     */
    public function hasSteps()
    {
        return !empty($this->steps);
    }

    /**
     * Gets the steps.
     *
     * @return array The steps.
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Sets the steps.
     *
     * @param array $steps The steps.
     */
    public function setSteps(array $steps)
    {
        $this->resetSteps();
        $this->addSteps($steps);
    }

    /**
     * Adds the steps.
     *
     * @param array $steps The steps.
     */
    public function addSteps(array $steps)
    {
        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    /**
     * Removes the staps.
     *
     * @param array $steps The steps.
     */
    public function removeSteps(array $steps)
    {
        foreach ($steps as $step) {
            $this->removeStep($step);
        }
    }

    /**
     * Checks if there is a step.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep $step The step.
     *
     * @return boolean TRUE if there is the step else FALSE.
     */
    public function hasStep(DirectionsStep $step)
    {
        return in_array($step, $this->steps, true);
    }

    /**
     * Adds a step.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep The step.
     */
    public function addStep(DirectionsStep $step)
    {
        if (!$this->hasStep($step)) {
            $this->steps[] = $step;
        }
    }

    /**
     * Removes a step.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep $step The step.
     */
    public function removeStep(DirectionsStep $step)
    {
        unset($this->steps[array_search($step, $this->steps, true)]);
    }

    /**
     * Resets the via waypoints.
     */
    public function resetViaWaypoints()
    {
        $this->viaWaypoints = array();
    }

    /**
     * Checks if there are via waypoints.
     *
     * @return boolean TRUE if there are via waypoints else FALSE.
     */
    public function hasViaWaypoints()
    {
        return !empty($this->viaWaypoints);
    }

    /**
     * Gets the via waypoints.
     *
     * @return array The via waypoints.
     */
    public function getViaWaypoints()
    {
        return $this->viaWaypoints;
    }

    /**
     * Sets the via waypoints.
     *
     * @param array $viaWaypoints The via waypoints.
     */
    public function setViaWaypoints(array $viaWaypoints)
    {
        $this->viaWaypoints = $viaWaypoints;
    }

    /**
     * Adds the via waypoints.
     *
     * @param array $viaWaypoints The via waypoints.
     */
    public function addViaWaypoints(array $viaWaypoints)
    {
        foreach ($viaWaypoints as $viaWaypoint) {
            $this->addViaWaypoint($viaWaypoint);
        }
    }

    /**
     * Removes the via waypoints.
     *
     * @param array $viaWaypoints The via waypoints.
     */
    public function removeViaWaypoints(array $viaWaypoints)
    {
        foreach ($viaWaypoints as $viaWaypoint) {
            $this->removeViaWaypoint($viaWaypoint);
        }
    }

    /**
     * Checks if there is a via waypoint.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $viaWaypoint The via waypoint.
     *
     * @return boolean TRUE if there is the via waypoint else FALSE.
     */
    public function hasViaWaypoint(Coordinate $viaWaypoint)
    {
        return in_array($viaWaypoint, $this->viaWaypoints, true);
    }

    /**
     * Adds a via waypoint.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $viaWaypoint The via waypoint.
     */
    public function addViaWaypoint(Coordinate $viaWaypoint)
    {
        if (!$this->hasViaWaypoint($viaWaypoint)) {
            $this->viaWaypoints[] = $viaWaypoint;
        }
    }

    /**
     * Removes a via waypoint.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $viaWaypoint The via waypoint.
     */
    public function removeViaWaypoint(Coordinate $viaWaypoint)
    {
        unset($this->viaWaypoints[array_search($viaWaypoint, $this->viaWaypoints, true)]);
    }
}
