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
use Ivory\GoogleMap\Exception\GeocodingException;

/**
 * Geocoder request which describes a google map geocoder request.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequest
{
    /** @var string */
    protected $address;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $coordinate;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a geocoder request.
     */
    public function __construct()
    {
        $this->sensor = false;
    }

    /**
     * Checks if the geocoder request has an address.
     *
     * @return boolean TRUE if the geocoder request has an address else FALSE.
     */
    public function hasAddress()
    {
        return $this->address !== null;
    }

    /**
     * Gets the geocoder request address.
     *
     * @return string The geocoder request address.
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the geocoder request address.
     *
     * @param string $address The geocoder request address.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the address is not valid.
     */
    public function setAddress($address)
    {
        if (!is_string($address) && ($address !== null)) {
            throw GeocodingException::invalidGeocoderRequestAddress();
        }

        $this->address = $address;
    }

    /**
     * Checks if the geocoder request has a coordinate.
     *
     * @return boolean TRUE if the geocoder request has a coordinate else FALSE.
     */
    public function hasCoordinate()
    {
        return $this->coordinate !== null;
    }

    /**
     * Gets the geocoder request coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The geocoder request coordinate.
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Sets the geocoder request coordinate
     *
     * Available prototypes:
     *  - function setCoordinate(\Ivory\GoogleMap\Base\Coordinate $coordinate = null)
     *  - function setCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the coordinate is not valid (prototypes).
     */
    public function setCoordinate()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->coordinate = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if (!$this->hasCoordinate()) {
                $this->coordinate = new Coordinate();
            }

            $this->coordinate->setLatitude($args[0]);
            $this->coordinate->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->coordinate->setNoWrap($args[2]);
            }
        } elseif (!isset($args[0])) {
            $this->coordinate = null;
        } else {
            throw GeocodingException::invalidGeocoderRequestCoordinate();
        }

        return $this;
    }

    /**
     * Checks if the geocoder request has a bound.
     *
     * @return boolean TRUE if the geocoder request has a bound else FALSE.
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * Gets the geocoder request bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The geocoder request bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the geocoder request bound.
     *
     * Available prototypes:
     *  - function setBound(Ivory\GoogleMap\Base\Bound $bound = null)
     *  - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     *  - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the bound is not valid.
     */
    public function setBound()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Bound)) {
            $this->bound = $args[0];
        } elseif ((isset($args[0]) && ($args[0] instanceof Coordinate))
            && (isset($args[1]) && ($args[1] instanceof Coordinate))
        ) {
            if (!$this->hasBound()) {
                $this->bound = new Bound();
            }

            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        } elseif ((isset($args[0]) && is_numeric($args[0]))
            && (isset($args[1]) && is_numeric($args[1]))
            && (isset($args[2]) && is_numeric($args[2]))
            && (isset($args[3]) && is_numeric($args[3]))
        ) {
            if (!$this->hasBound()) {
                $this->bound = new Bound();
            }

            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));

            if (isset($args[4]) && is_bool($args[4])) {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            }

            if (isset($args[5]) && is_bool($args[5])) {
                $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        } elseif (!isset($args[0])) {
            $this->bound = null;
        } else {
            throw GeocodingException::invalidGeocoderRequestBound();
        }
    }

    /**
     * Checks if the geocoder request has a region.
     *
     * @return boolean TRUE if the geocoder request has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the geocoder request region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the geocoder request region.
     *
     * @param string $region The geocoder request region.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the regin is not valid.
     */
    public function setRegion($region = null)
    {
        if ((!is_string($region) || (strlen($region) !== 2)) && ($region !== null)) {
            throw GeocodingException::invalidGeocoderRequestRegion();
        }

        $this->region = $region;
    }

    /**
     * Checks if the geocoder request has a language.
     *
     * @return boolean TRUE if the geocoder request has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the geocoder request language.
     *
     * @return string The geocoder request language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the geocoder request language.
     *
     * @param string $language The geocoder request language.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the language is not valid.
     */
    public function setLanguage($language = null)
    {
        if ((!is_string($language) || (strlen($language) !== 2)) && ($language !== null)) {
            throw GeocodingException::invalidGeocoderRequestLanguage();
        }

        $this->language = $language;
    }

    /**
     * Checks if the geocoder request has a sensor.
     *
     * @return boolean TRUE if the geocoder request has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the geocoder request sensor.
     *
     * @param boolean $sensor TRUE if the geocoder request has a sensor else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingRequest If the sensor flag is not valid.
     */
    public function setSensor($sensor)
    {
        if (!is_bool($sensor)) {
            throw GeocodingException::invalidGeocoderRequestSensor();
        }

        $this->sensor = $sensor;
    }

    /**
     * Checks if the geocoder request is valid.
     *
     * @return boolean TRUE if the geocoder request is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasAddress() || $this->hasCoordinate();
    }
}
