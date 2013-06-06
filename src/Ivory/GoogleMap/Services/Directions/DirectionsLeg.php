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
use Ivory\GoogleMap\Exception\DirectionsException;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;

/**
 * A directions leg which describes a google map directions leg.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsLeg
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLeg
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    protected $duration;

    /** @var string */
    protected $endAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $endLocation;

    /** @var string */
    protected $startAddress;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $startLocation;

    /** @var array */
    protected $steps;

    /** @var array */
    protected $viaWaypoints;

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
     * Gets the leg distance.
     *
     * @return \Ivory\GoogleMap\Services\Base\Distance The leg distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the leg distance.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance The leg distance.
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the leg duration.
     *
     * @return \Ivory\GoogleMap\Services\Base\Duration The leg duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the leg duration
     *
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The leg duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Gets the leg end address.
     *
     * @return string The leg end address.
     */
    public function getEndAddress()
    {
        return $this->endAddress;
    }

    /**
     * Sets the leg end address.
     *
     * @param string The leg end address.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the and address is not valid.
     */
    public function setEndAddress($endAddress)
    {
        if (!is_string($endAddress)) {
            throw DirectionsException::invalidDirectionsLegEndAddress();
        }

        $this->endAddress = $endAddress;
    }

    /**
     * Gets the leg end location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The leg end location.
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }

    /**
     * Sets the leg end location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $endLocation The leg end location.
     */
    public function setEndLocation(Coordinate $endLocation)
    {
        $this->endLocation = $endLocation;
    }

    /**
     * Gets the leg start address.
     *
     * @return string The leg start address.
     */
    public function getStartAddress()
    {
        return $this->startAddress;
    }

    /**
     * Sets the leg start address.
     *
     * @param string $startAddress The leg start address.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the start address is not valid.
     */
    public function setStartAddress($startAddress)
    {
        if (!is_string($startAddress)) {
            throw DirectionsException::invalidDirectionsLegStartAddress();
        }

        $this->startAddress = $startAddress;
    }

    /**
     * Gets the leg start location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The leg start location.
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }

    /**
     * Sets the leg start location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $startLocation The leg start location.
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }

    /**
     * Gets the leg steps.
     *
     * @return array The leg steps.
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Sets the leg steps.
     *
     * @param array $steps The leg steps.
     */
    public function setSteps(array $steps)
    {
        $this->steps = array();

        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    /**
     * Add a step to the leg.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsStep The step to add.
     */
    public function addStep(DirectionsStep $step)
    {
        $this->steps[] = $step;
    }

    /**
     * Gets the via waypoint.
     *
     * @return array The via waypoint.
     */
    public function getViaWaypoints()
    {
        return $this->viaWaypoints;
    }

    /**
     * Sets the via waypoint.
     *
     * @param array $viaWaypoints The via waypoint.
     */
    public function setViaWaypoints(array $viaWaypoints)
    {
        $this->viaWaypoints = $viaWaypoints;
    }
}
