<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Geometry
{
    private ?Coordinate $location = null;

    private ?string $locationType = null;

    private ?Bound $viewport = null;

    private ?Bound $bound = null;

    public function hasLocation(): bool
    {
        return $this->location !== null;
    }

    public function getLocation(): ?Coordinate
    {
        return $this->location;
    }

    /**
     * @param Coordinate|null $location
     */
    public function setLocation(Coordinate $location = null): void
    {
        $this->location = $location;
    }

    public function hasLocationType(): bool
    {
        return $this->locationType !== null;
    }

    public function getLocationType(): ?string
    {
        return $this->locationType;
    }

    /**
     * @param string|null $locationType
     */
    public function setLocationType($locationType = null): void
    {
        $this->locationType = $locationType;
    }

    public function hasViewport(): bool
    {
        return $this->viewport !== null;
    }

    public function getViewport(): ?Bound
    {
        return $this->viewport;
    }

    /**
     * @param Bound|null $viewport
     */
    public function setViewport(Bound $viewport = null): void
    {
        $this->viewport = $viewport;
    }

    public function hasBound(): bool
    {
        return $this->bound !== null;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }
}
