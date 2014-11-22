<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * Geocoder geometry.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderGeometry
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometry
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $location;

    /** @var string */
    private $locationType;

    /** @var \Ivory\GoogleMap\Base\Bound */
    private $viewport;

    /** @var \Ivory\GoogleMap\Base\Bound|null */
    private $bound;

    /**
     * Creates a geocoder geometry.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $location     The location.
     * @param string                           $locationType The location type.
     * @param \Ivory\GoogleMap\Base\Bound      $viewport     The viewport.
     * @param \Ivory\GoogleMap\Base\Bound|null $bound        The bound.
     */
    public function __construct(Coordinate $location, $locationType, Bound $viewport, Bound $bound = null)
    {
        $this->setLocation($location);
        $this->setLocationType($locationType);
        $this->setViewport($viewport);
        $this->setBound($bound);
    }

    /**
     * Gets the location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $location The location.
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }

    /**
     * Gets the location type.
     *
     * @return string The location type.
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * Sets the location type.
     *
     * @param string $locationType The location type.
     */
    public function setLocationType($locationType)
    {
        $this->locationType = $locationType;
    }

    /**
     * Gets the viewport.
     *
     * @return \Ivory\GoogleMap\Base\Bound The viewport.
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**
     * Sets the viewport.
     *
     * @param \Ivory\GoogleMap\Base\Bound $viewport The viewport.
     */
    public function setViewport(Bound $viewport)
    {
        $this->viewport = $viewport;
    }

    /**
     * Checks if there is a bound.
     *
     * @return boolean TRUE if there is a bound else FALSE.
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * Gets the bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound|null The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
