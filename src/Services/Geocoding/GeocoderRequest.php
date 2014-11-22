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

/**
 * Geocoder request.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequest
{
    /** @var string|\Ivory\GoogleMap\Base\Coordinate */
    private $location;

    /** @var \Ivory\GoogleMap\Base\Bound|null */
    private $bound;

    /** @var string|null */
    private $region;

    /** @var string|null */
    private $language;

    /** @var boolean */
    private $sensor = false;

    /**
     * Creates a geocoder request.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The location.
     */
    public function __construct($location)
    {
        $this->setLocation($location);
    }

    /**
     * Gets the location.
     *
     * @return string|\Ivory\GoogleMap\Base\Coordinate The location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The location.
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Checks if it has a bound.
     *
     * @return boolean TRUE if it has a bound else FALSE.
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

    /**
     * Checks if it has a region.
     *
     * @return boolean TRUE if it has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the region.
     *
     * @return string|null The region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the region.
     *
     * @param string|null $region The region.
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * Checks if it has a language.
     *
     * @return boolean TRUE if it has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the language.
     *
     * @return string|null The language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string|null $language The language.
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * Checks if it has a sensor.
     *
     * @return boolean TRUE if it has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor.
     *
     * @param boolean $sensor TRUE if it has a sensor else FALSE.
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;
    }
}
