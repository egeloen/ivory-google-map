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
use Ivory\GoogleMap\Overlays\ExtendableInterface;

/**
 * Bound wich describes a google map bound.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractJavascriptVariableAsset
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $southWest;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $northEast;

    /** @var array */
    protected $extends;

    /**
     * Creates a bound.
     */
    public function __construct(Coordinate $southWest = null, Coordinate $northEast = null, array $extends = array())
    {
        $this->setPrefixJavascriptVariable('bound_');

        $this->setSouthWest($southWest);
        $this->setNorthEast($northEast);
        $this->setExtends($extends);
    }

    /**
     * Checks if the bound has coordinates.
     *
     * @return boolean TRUE if the bound has coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return ($this->southWest !== null) && ($this->northEast !== null);
    }

    /**
     * Gets the south west coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The south west coordinate.
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west coordinate.
     *
     * Available prototypes:
     *  - function setSouthWest(Ivory\GoogleMap\Base\Coordinate $southWest = null)
     *  - function setSouthWest(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the south west coordinate is not valid (prototypes).
     */
    public function setSouthWest()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->southWest = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->southWest === null) {
                $this->southWest = new Coordinate();
            }

            $this->southWest->setLatitude($args[0]);
            $this->southWest->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->southWest->setNoWrap($args[2]);
            }
        } elseif (!isset($args[0])) {
            $this->southWest = null;
        } else {
            throw BaseException::invalidBoundSouthWest();
        }
    }

    /**
     * Gets the north east coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The northh east coordinate.
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east coordinate.
     *
     * Available prototypes:
     *  - function setNorthEast(Ivory\GoogleMap\Base\Coordinate $northEast = null)
     *  - function setNorthEast(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\BaseException If the north east coordinate is not valid (prototypes).
     */
    public function setNorthEast()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->northEast = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->northEast === null) {
                $this->northEast = new Coordinate();
            }

            $this->northEast->setLatitude($args[0]);
            $this->northEast->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->northEast->setNoWrap($args[2]);
            }
        } elseif (!isset($args[0])) {
            $this->northEast = null;
        } else {
            throw BaseException::invalidBoundNorthEast();
        }
    }

    /**
     * Checks if the bound extends something.
     *
     * @return boolean TRUE if the bound extends somethind else FALSE.
     */
    public function hasExtends()
    {
        return !empty($this->extends);
    }

    /**
     * Gets the google map objects that the bound extends.
     *
     * @return array The objects that the bound extends.
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets the google map objects that the bound extends.
     *
     * @param array $extends The objects that the bound extends.
     */
    public function setExtends($extends)
    {
        $this->extends = array();

        foreach ($extends as $extend) {
            $this->extend($extend);
        }
    }

    /**
     * Adds an object that the bound extends.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The object that the bound extends.
     */
    public function extend(ExtendableInterface $extend)
    {
        $this->extends[] = $extend;
    }

    /**
     * Gets the center of the bound.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The bound center.
     */
    public function getCenter()
    {
        $centerLatitude = ($this->getSouthWest()->getLatitude() + $this->getNorthEast()->getLatitude()) / 2;
        $centerLongitude = ($this->getSouthWest()->getLongitude() + $this->getNorthEast()->getLongitude()) / 2;

        return new Coordinate($centerLatitude, $centerLongitude);
    }
}
