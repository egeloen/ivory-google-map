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
    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @var float|null
     */
    private $elevation;

    /**
     * @var float|null
     */
    private $resolution;

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return $this->location !== null;
    }

    /**
     * @return Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Coordinate|null $location
     */
    public function setLocation(Coordinate $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function hasElevation()
    {
        return $this->elevation !== null;
    }

    /**
     * @return float|null
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * @param float|null $elevation
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
    }

    /**
     * @return bool
     */
    public function hasResolution()
    {
        return $this->resolution !== null;
    }

    /**
     * @return float|null
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @param float|null $resolution
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }
}
