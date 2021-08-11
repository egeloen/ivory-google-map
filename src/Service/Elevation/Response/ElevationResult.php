<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationResult
{
    private ?Coordinate $location = null;

    private ?float $elevation = null;

    private ?float $resolution = null;

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

    public function hasElevation(): bool
    {
        return $this->elevation !== null;
    }

    public function getElevation(): ?float
    {
        return $this->elevation;
    }

    /**
     * @param float|null $elevation
     */
    public function setElevation($elevation): void
    {
        $this->elevation = $elevation;
    }

    public function hasResolution(): bool
    {
        return $this->resolution !== null;
    }

    public function getResolution(): ?float
    {
        return $this->resolution;
    }

    /**
     * @param float|null $resolution
     */
    public function setResolution($resolution): void
    {
        $this->resolution = $resolution;
    }
}
