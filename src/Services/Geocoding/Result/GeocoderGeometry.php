<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding\Result;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\GeocodingException;

/**
 * GeocoderGeometry which describes a google map geocoder geometry.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderGeometry
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometry
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $location;

    /** @var string */
    protected $locationType;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $viewport;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * Create a geocoder geometry.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $location     The geometry location.
     * @param string                           $locationType The geometry location type.
     * @param \Ivory\GoogleMap\Base\Bound      $viewport     The geometry viewport.
     * @param \Ivory\GoogleMap\Base\Bound      $bound        The geometry bound.
     */
    public function __construct(Coordinate $location, $locationType, Bound $viewport, Bound $bound = null)
    {
        $this->setLocation($location);
        $this->setLocationType($locationType);
        $this->setViewport($viewport);
        $this->setBound($bound);
    }

    /**
     * Gets the geometry location.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The geometry location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the geometry location.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $location The geometry location.
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }

    /**
     * Gets the geometry location type.
     *
     * @return string The geometry location type.
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * Sets the geometry location type.
     *
     * @param string $locationType The geometry location type.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the location type is not valid.
     */
    public function setLocationType($locationType)
    {
        if (!in_array($locationType, GeocoderLocationType::getGeocoderLocationTypes())) {
            throw GeocodingException::invalidGeocoderLocationType();
        }

        $this->locationType = $locationType;
    }

    /**
     * Gets the geometry viewport
     *
     * @return \Ivory\GoogleMap\Base\Bound The geometry viewport.
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**
     * Sets the geometry viewport.
     *
     * @param \Ivory\GoogleMap\Base\Bound $viewport The geometry viewport.
     */
    public function setViewport(Bound $viewport)
    {
        $this->viewport = $viewport;
    }

    /**
     * Gets the geometry bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The geometry bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the geometry bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The geometry bound.
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
