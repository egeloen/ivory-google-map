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
use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;

/**
 * A distance matrix response wraps the distance results & the response status.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixResponseElement
{
    /** @var string */
    protected $status;

    /** @var null|\Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var null|\Ivory\GoogleMap\Services\Base\Duration */
    protected $duration;

    /**
     * Create a distance matrix response element.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance The element distance.
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The element duration.
     * @param string                                  $status   The element status.
     */
    public function __construct($status, Distance $distance = null, Duration $duration = null)
    {
        $this->setStatus($status);

        if ($distance !== null) {
            $this->setDistance($distance);
        }

        if ($duration !== null) {
            $this->setDuration($duration);
        }
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
        if (!in_array($status, DistanceMatrixElementStatus::getDistanceMatrixElementStatus())) {
            throw DistanceMatrixException::invalidDistanceMatrixResponseElementStatus();
        }

        $this->status = $status;
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
}
