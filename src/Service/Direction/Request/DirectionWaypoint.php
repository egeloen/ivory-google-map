<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionWaypoint
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypoint
{
    /**
     * @var LocationInterface
     */
    private $location;

    /**
     * @var bool|null
     */
    private $stopover;

    /**
     * @param LocationInterface $location
     * @param bool|null         $stopover
     */
    public function __construct(LocationInterface $location, $stopover = null)
    {
        $this->setLocation($location);
        $this->setStopover($stopover);
    }

    /**
     * @return LocationInterface
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param LocationInterface $location
     */
    public function setLocation(LocationInterface $location)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function hasStopover()
    {
        return $this->stopover !== null;
    }

    /**
     * @return bool|null
     */
    public function getStopover()
    {
        return $this->stopover;
    }

    /**
     * @param bool|null $stopover
     */
    public function setStopover($stopover = null)
    {
        $this->stopover = $stopover;
    }
}
