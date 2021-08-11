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
    private ?LocationInterface $location = null;

    private ?bool $stopover = null;

    /**
     * @param bool|null         $stopover
     */
    public function __construct(LocationInterface $location, $stopover = null)
    {
        $this->setLocation($location);
        $this->setStopover($stopover);
    }

    public function getLocation(): LocationInterface
    {
        return $this->location;
    }

    public function setLocation(LocationInterface $location): void
    {
        $this->location = $location;
    }

    public function hasStopover(): bool
    {
        return $this->stopover !== null;
    }

    public function getStopover(): ?bool
    {
        return $this->stopover;
    }

    /**
     * @param bool|null $stopover
     */
    public function setStopover($stopover = null): void
    {
        $this->stopover = $stopover;
    }
}
