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

use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\GoogleMap\Services\Base\Duration;

/**
 * Distance matrix response element.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixResponseElement
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseElement
{
    /** @var string */
    private $status;

    /** @var \Ivory\GoogleMap\Services\Base\Distance|null */
    private $distance;

    /** @var \Ivory\GoogleMap\Services\Base\Duration|null */
    private $duration;

    /**
     * Create a distance matrix response element.
     *
     * @param string                                  $status   The status.
     * @param \Ivory\GoogleMap\Services\Base\Distance $distance The distance.
     * @param \Ivory\GoogleMap\Services\Base\Duration $duration The duration.
     */
    public function __construct($status, Distance $distance = null, Duration $duration = null)
    {
        $this->setStatus($status);
        $this->setDistance($distance);
        $this->setDuration($duration);
    }

    /**
     * Gets the status.
     *
     * @return string The status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status.
     *
     * @param string $status The status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Checks if there is a distance.
     *
     * @return boolean TRUe if there is a distance else FALSE.
     */
    public function hasDistance()
    {
        return $this->distance !== null;
    }

    /**
     * Gets the distance.
     *
     * @return \Ivory\GoogleMap\Services\Base\Distance|null The distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the distance.
     *
     * @param \Ivory\GoogleMap\Services\Base\Distance|null $distance The distance.
     */
    public function setDistance(Distance $distance = null)
    {
        $this->distance = $distance;
    }

    /**
     * Checks if there is a duration.
     *
     * @return boolean TRUE if there is a duration else FALSE.
     */
    public function hasDuration()
    {
        return $this->duration !== null;
    }

    /**
     * Gets the duration.
     *
     * @return \Ivory\GoogleMap\Services\Base\Duration|null The duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the duration.
     *
     * @param \Ivory\GoogleMap\Services\Base\Duration|null $duration The duration.
     */
    public function setDuration(Duration $duration = null)
    {
        $this->duration = $duration;
    }
}
