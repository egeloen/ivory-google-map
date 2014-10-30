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
 * Coordinate.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLng
 * @author GeLo <geloen.eric@gmail.com>
 */
class Coordinate extends AbstractVariableAsset
{
    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /**
     * Creates a coordinate.
     *
     * @param float $latitude  The latitude.
     * @param float $longitude The longitude.
     */
    public function __construct($latitude, $longitude)
    {
        parent::__construct('coordinate_');

        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * Gets the latitude.
     *
     * @return float The latitude.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param float $latitude The latitude.
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Checks if the latitude is not wrapped.
     *
     * @return boolean TRUE if the latitude is not wrapped else FALSE.
     */
    public function isLatitudeNoWrap()
    {
        return $this->latitude < -90 || $this->latitude > 90;
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
     * @param float $longitude The longitude.
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Checks if the longitude is not wrapped.
     *
     * @return boolean TRUE if the longitude is not wrapped else FALSE.
     */
    public function isLongitudeNoWrap()
    {
        return $this->longitude < -180 || $this->longitude > 180;
    }

    /**
     * Checks if the latitude or the longitude are not wrapped.
     *
     * @return boolean TRUE if the latitude or the longitude are not wrapped else FALSE.
     */
    public function isNoWrap()
    {
        return $this->isLatitudeNoWrap() || $this->isLongitudeNoWrap();
    }
}
