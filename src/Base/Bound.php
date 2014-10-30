<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Base;

use Ivory\GoogleMap\Assets\AbstractVariableAsset;

/**
 * Bound.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractVariableAsset
{
    /** @var \Ivory\GoogleMap\Base\Coordinate|null */
    private $southWest;

    /** @var \Ivory\GoogleMap\Base\Coordinate|null */
    private $northEast;

    /**
     * Creates a bound.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west coordinate.
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east coordinate.
     */
    public function __construct(Coordinate $southWest = null, Coordinate $northEast = null)
    {
        parent::__construct('bound_');

        $this->setSouthWest($southWest);
        $this->setNorthEast($northEast);
    }

    /**
     * Checks if there are coordinates (south west and north east).
     *
     * @return boolean TRUE if there are coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return $this->hasSouthWest() && $this->hasNorthEast();
    }

    /**
     * Checks if there is a south west.
     *
     * @return boolean TRUE if there is a south west else FALSE.
     */
    public function hasSouthWest()
    {
        return $this->southWest !== null;
    }

    /**
     * Gets the south west.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|null The south west.
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west.
     */
    public function setSouthWest(Coordinate $southWest = null)
    {
        $this->southWest = $southWest;
    }

    /**
     * Checks if there is a north east.
     *
     * @return boolean TRUE if there is a north east.
     */
    public function hasNorthEast()
    {
        return $this->northEast !== null;
    }

    /**
     * Gets the north east.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|null The northh east.
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east.
     */
    public function setNorthEast(Coordinate $northEast = null)
    {
        $this->northEast = $northEast;
    }
}
