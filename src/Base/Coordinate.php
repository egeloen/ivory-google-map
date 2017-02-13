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

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLng
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Coordinate implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var bool
     */
    private $noWrap;

    /**
     * @param float $latitude
     * @param float $longitude
     * @param bool  $noWrap
     */
    public function __construct($latitude = 0.0, $longitude = 0.0, $noWrap = true)
    {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setNoWrap($noWrap);
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return bool
     */
    public function isNoWrap()
    {
        return $this->noWrap;
    }

    /**
     * @param bool $noWrap
     */
    public function setNoWrap($noWrap)
    {
        $this->noWrap = $noWrap;
    }
}
