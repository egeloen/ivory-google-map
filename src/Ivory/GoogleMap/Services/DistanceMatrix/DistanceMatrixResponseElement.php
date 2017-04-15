<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Exception\DistanceMatrixException;
use Ivory\GoogleMap\Services\Directions\Distance;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;
use Ivory\GoogleMap\Services\Directions\Duration;

/**
 * A distance matrix response wraps the distance results & the response status.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixResponseElement
{
    /** @var \Ivory\GoogleMap\Services\Directions\Distance */
    protected $distance;

    /** @var \Ivory\GoogleMap\Services\Directions\Duration */
    protected $duration;

    /** @var string */
    protected $status;

    /**
     * Create a distance matrix response element.
     *
     * @param \Ivory\GoogleMap\Services\Directions\Distance $distance
     * @param \Ivory\GoogleMap\Services\Directions\Duration $duration
     * @param string $status The response status.
     */
    public function __construct(Distance $distance, Duration $duration, $status)
    {
        $this->setDistance($distance);
        $this->setDuration($duration);
        $this->setStatus($status);
    }

    /**
     * Gets the step distance.
     *
     * @return \Ivory\GoogleMap\Services\Directions\Distance The step distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the step distance.
     *
     * @param \Ivory\GoogleMap\Services\Directions\Distance $distance The step distance.
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the step duration.
     *
     * @return \Ivory\GoogleMap\Services\Directions\Duration The step duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the step duration
     *
     * @param \Ivory\GoogleMap\Services\Directions\Duration $duration The step duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Gets the distance matrix response status.
     *
     * @return string The distance matrix response status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the distance matrix response status.
     *
     * @param string $status The distance matrix status.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the status is not valid.
     */
    public function setStatus($status)
    {
        if (!in_array($status, DistanceMatrixElementStatus::getDistanceMatrixElementStatuses())) {
            throw DistanceMatrixException::invalidDistanceMatrixResponseElementStatus();
        }

        $this->status = $status;
    }
}
