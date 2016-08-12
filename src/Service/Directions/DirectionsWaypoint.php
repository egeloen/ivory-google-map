<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Directions;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypoint
{
    /**
     * @var Coordinate|string|null
     */
    private $location;

    /**
     * @var bool|null
     */
    private $stopover;

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return $this->location !== null;
    }

    /**
     * @return Coordinate|string|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Coordinate|string|null $location
     */
    public function setLocation($location = null)
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
