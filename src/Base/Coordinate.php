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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Exception\BaseException;

/**
 * Coordinate which describes a google map coordinate.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLng
 * @author GeLo <geloen.eric@gmail.com>
 */
class Coordinate extends AbstractJavascriptVariableAsset
{
    /** @var double */
    protected $latitude;

    /** @var double */
    protected $longitude;

    /** @var boolean */
    protected $noWrap;

    /**
     * Create a coordinate
     *
     * @param double  $latitude  The latitude.
     * @param double  $longitude The longitude.
     * @param boolean $noWrap    The no wrap flag.
     */
    public function __construct($latitude = 0, $longitude = 0, $noWrap = true)
    {
        $this->setPrefixJavascriptVariable('coordinate_');

        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setNoWrap($noWrap);
    }

    /**
     * Gets the latitude.
     *
     * @return double The latitude.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param double $latitude The latitude.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the latitude is not valid.
     */
    public function setLatitude($latitude)
    {
        if (!is_numeric($latitude) && ($latitude !== null)) {
            throw BaseException::invalidCoordinateLatitude();
        }

        $this->latitude = $latitude;
    }

    /**
     * Gets the longitude
     *
     * @return doube The longitude.
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude.
     *
     * @param double $longitude The longitude.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the longitude is not valid.
     */
    public function setLongitude($longitude)
    {
        if (!is_numeric($longitude) && ($longitude !== null)) {
            throw BaseException::invalidCoordinateLongitude();
        }

        $this->longitude = $longitude;
    }

    /**
     * Check if the coordinate is not wrap.
     *
     * @return boolean TRUE if the coordinate is not wrap else FALSE.
     */
    public function isNoWrap()
    {
        return $this->noWrap;
    }

    /**
     * Sets if the coordinate is wrap.
     *
     * @param boolean $noWrap TRUE if the coordinate is not wrap else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the no wrap flag is not valid.
     */
    public function setNoWrap($noWrap)
    {
        if (!is_bool($noWrap) && ($noWrap !== null)) {
            throw BaseException::invalidCoordinateNoWrap();
        }

        $this->noWrap = $noWrap;
    }
}
