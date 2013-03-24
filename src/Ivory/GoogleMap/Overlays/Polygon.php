<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Polygon which describes a google map polygon.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polygon extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var array */
    protected $coordinates;

    /**
     * Creates a polygon.
     *
     * @param array $coordinates The polygon coordinates.
     */
    public function __construct(array $coordinates = array())
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('polygon_');
        $this->setCoordinates($coordinates);
    }

    /**
     * Checks if polygon has coordinates.
     *
     * @return boolean TRUE if the polygon has coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * Gets the polygon coordinates.
     *
     * @return array The polygon coordinates.
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Sets the polygon coordinates.
     *
     * @param array $coordinates The polygon coordinates.
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = array();

        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * Adds a coordinate to the polygon.
     *
     * Available prototypes:
     *  - function addCoordinate(Ivory\GoogleMap\Base\Coordinate $coordinate)
     *  - function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the coordinate is not valid.
     */
    public function addCoordinate()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->coordinates[] = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $coordinate = new Coordinate($args[0], $args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $coordinate->setNoWrap($args[2]);
            }

            $this->coordinates[] = $coordinate;
        } else {
            throw OverlayException::invalidPolygonCoordinate();
        }
    }
}
