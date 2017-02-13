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
    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @var string|null
     */
    private $locationType;

    /**
     * @var Bound|null
     */
    private $viewport;

    /**
     * @var Bound|null
     */
    private $bound;

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
    public function hasLocationType()
    {
        return $this->locationType !== null;
    }

    /**
     * @return string|null
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * @param string|null $locationType
     */
    public function setLocationType($locationType = null)
    {
        $this->locationType = $locationType;
    }

    /**
     * @return bool
     */
    public function hasViewport()
    {
        return $this->viewport !== null;
    }

    /**
     * @return Bound|null
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**
     * @param Bound|null $viewport
     */
    public function setViewport(Bound $viewport = null)
    {
        $this->viewport = $viewport;
    }

    /**
     * @return bool
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
