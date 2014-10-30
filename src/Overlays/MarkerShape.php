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

use Ivory\GoogleMap\Assets\AbstractVariableAsset;

/**
 * Marker shape.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShape extends AbstractVariableAsset
{
    /** @var string */
    private $type;

    /** @var array */
    private $coordinates = array();

    /**
     * Creates a marker shape.
     *
     * @param string $type        The type.
     * @param array  $coordinates The coordinates.
     */
    public function __construct($type, array $coordinates)
    {
        parent::__construct('marker_shape_');

        $this->setType($type);
        $this->setCoordinates($coordinates);
    }

    /**
     * Gets the type.
     *
     * @return string The type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type The type.
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Resets the coordinates.
     */
    public function resetCoordinates()
    {
        $this->coordinates = array();
    }

    /**
     * Checks if there are coordinates.
     *
     * @return boolean TRUE if there are coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * Gets the coordinates.
     *
     * @return array The coordinates.
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Sets the coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    public function setCoordinates(array $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * Sets the circle coordinates.
     *
     * @param float $x      The X.
     * @param float $y      The Y.
     * @param float $radius The radius.
     */
    public function setCircleCoordinates($x, $y, $radius)
    {
        $this->coordinates = array($x, $y, $radius);
    }

    /**
     * Sets the rectangle coordinates.
     *
     * @param float $x1 The X1.
     * @param float $y1 The Y1.
     * @param float $x2 The X2.
     * @param float $y2 The Y2.
     */
    public function setRectangleCoordinates($x1, $y1, $x2, $y2)
    {
        $this->coordinates = array($x1, $y1, $x2, $y2);
    }

    /**
     * Sets the polygon coordinates.
     *
     * @param array $polygonCoordinates The polygon coordinates.
     */
    public function setPolygonCoordinates(array $polygonCoordinates)
    {
        $this->setCoordinates($polygonCoordinates);
    }

    /**
     * Adds a polygon coordinate.
     *
     * @param float $x The X.
     * @param float $y The Y.
     */
    public function addPolygonCoordinate($x, $y)
    {
        $this->coordinates[] = $x;
        $this->coordinates[] = $y;
    }
}
