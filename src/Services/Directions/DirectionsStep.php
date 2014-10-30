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
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;

/**
 * Directions step.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsStep
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStep
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    private $duration;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $endLocation;

    /** @var string */
    private $instructions;

    /** @var \Ivory\GoogleMap\Overlays\EncodedPolyline */
    private $encodedPolyline;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $startLocation;

    /** @var string */
    private $travelMode;

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
     * Sets the duration
     *
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
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
     * Gets the instructions.
     *
     * @return string The instructions.
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Sets the instructions.
     *
     * @param string $instructions The instructions.
     */
    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;
    }

    /**
     * Gets the encoded polyline.
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline The encoded polyline.
     */
    public function getEncodedPolyline()
    {
        return $this->encodedPolyline;
    }

    /**
     * Sets the encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    public function setEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        $this->encodedPolyline = $encodedPolyline;
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
     * @param \Ivory\GoogleMap\Base\Coordinate $startLocation The start position.
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }

    /**
     * Gets the travel mode.
     *
     * @return string The travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the travel mode.
     *
     * @param string $travelMode The travel mode.
     */
    public function setTravelMode($travelMode)
    {
        $this->travelMode = $travelMode;
    }
}
