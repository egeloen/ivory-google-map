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
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\GoogleMap\Services\Base\TravelMode;

/**
 * A directions step which describes a google map directions step.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsStep
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStep
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    protected $duration;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $endLocation;

    /** @var string */
    protected $instructions;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    protected $encodedPolyline;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $startLocation;

    /** @var string */
    protected $travelMode;

    /**
     * Creates a directions step.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance   $distance        The distance.
     * @param \Ivory\GoogleMap\Services\Base\Duration   $duration        The duration.
     * @param \Ivory\GoogleMap\Base\Coordinate          $endLocation     The end location.
     * @param string                                    $instructions    The instructions.
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     * @param \Ivory\GoogleMap\Base\Coordinate          $startLocation   The start location.
     * @param string                                    $travelMode      The travel mode.
     */
    public function __construct(
        Distance $distance,
        Duration $duration,
        Coordinate $endLocation,
        $instructions,
        EncodedPolyline $encodedPolyline,
        Coordinate $startLocation,
        $travelMode
    ) {
        $this->setDistance($distance);
        $this->setDuration($duration);
        $this->setEndLocation($endLocation);
        $this->setInstructions($instructions);
        $this->setEncodedPolyline($encodedPolyline);
        $this->setStartLocation($startLocation);
        $this->setTravelMode($travelMode);
    }

    /**
     * Gets the step distance.
     *
     * @return \Ivory\GoogleMap\Services\Base\Distance The step distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the step distance.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance The step distance.
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the step duration.
     *
     * @return \Ivory\GoogleMap\Services\Base\Duration The step duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the step duration
     *
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The step duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Gets the step end location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The step end location.
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }

    /**
     * Sets the step end location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $endLocation The step end location.
     */
    public function setEndLocation(Coordinate $endLocation)
    {
        $this->endLocation = $endLocation;
    }

    /**
     * Gets the step instructions.
     *
     * @return string The step instructions.
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Sets the step instructions.
     *
     * @param string $instructions The step instructions.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the instructions is not valid.
     */
    public function setInstructions($instructions)
    {
        if (!is_string($instructions)) {
            throw DirectionsException::invalidDirectionsStepInstructions();
        }

        $this->instructions = $instructions;
    }

    /**
     * Gets the encoded polyline which describes the step.
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline The encoded polyline.
     */
    public function getEncodedPolyline()
    {
        return $this->encodedPolyline;
    }

    /**
     * Sets the encoded polyline which describes the step.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    public function setEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        $this->encodedPolyline = $encodedPolyline;
    }

    /**
     * Gets the step start location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The step start location.
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }

    /**
     * Sets the step start location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $startLocation The step start position.
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }

    /**
     * Gets the step travel mode.
     *
     * @return string The step travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the step travel mode.
     *
     * @param string $travelMode The step travel mode.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the travel mode is not valid.
     */
    public function setTravelMode($travelMode)
    {
        if (!in_array($travelMode, TravelMode::getTravelModes())) {
            throw DirectionsException::invalidDirectionsStepTravelMode();
        }

        $this->travelMode = $travelMode;
    }
}
