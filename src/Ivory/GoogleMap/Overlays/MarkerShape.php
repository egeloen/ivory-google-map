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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Marker shape which describes a google map marker shape.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShape extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $type;

    /** @var array */
    protected $coordinates;

    /**
     * Creates a marker shape.
     *
     * @param string $type        The marker shape type.
     * @param array  $coordinates The marker shape coordinates.
     */
    public function __construct($type = 'poly', array $coordinates = array(1, 1, 1, -1, -1, -1, -1, 1))
    {
        $this->setPrefixJavascriptVariable('marker_shape_');
        $this->setType($type);
        $this->setCoordinates($coordinates);
    }

    /**
     * Gets the marker shape type.
     *
     * @return string The marker sape type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the marker shape type.
     *
     * The allowing marker shape type are : circle, poly & rect.
     *
     * @param string $type The marker schape type.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the type is not valid.
     */
    public function setType($type)
    {
        switch (strtolower($type)) {
            case 'circle':
            case 'poly':
            case 'rect':
                $this->type = $type;
                break;
            default:
                throw OverlayException::invalidMarkerShapeType();
        }
    }

    /**
     * Resets the marker shape coordinates.
     */
    public function resetCoordinates()
    {
        $this->coordinates = array();
    }

    /**
     * Cheks if the marker shape has coordinates
     *
     * @return boolean TRUE if the marker shape has coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * Gets the marker shape coordinates.
     *
     * @return array The marker shape coordinates.
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Sets the marker shape coordinates.
     *
     * @param array $coordinates The marker shape coordinates.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the coordinates are not valid according to the type.
     */
    public function setCoordinates(array $coordinates)
    {
        switch (strtolower($this->type)) {
            case 'circle':
                if ((count($coordinates) === 3)
                    && is_numeric($coordinates[0])
                    && is_numeric($coordinates[1])
                    && is_numeric($coordinates[2])
                ) {
                    $this->coordinates = $coordinates;
                } else {
                    throw OverlayException::invalidMarkerShapeCircleCoordinates();
                }
                break;
            case 'poly':
                if ((count($coordinates) <= 0) || ((count($coordinates) % 2) !== 0)) {
                    throw OverlayException::invalidMarkerShapePolyCoordinates();
                }

                foreach ($coordinates as $coordinate) {
                    if (!is_numeric($coordinate)) {
                        throw OverlayException::invalidMarkerShapePolyCoordinates();
                    }
                }

                $this->coordinates = $coordinates;
                break;
            case 'rect':
                if ((count($coordinates) === 4)
                    && is_numeric($coordinates[0])
                    && is_numeric($coordinates[1])
                    && is_numeric($coordinates[2])
                    && is_numeric($coordinates[3])
                ) {
                    $this->coordinates = $coordinates;
                } else {
                    throw OverlayException::invalidMarkerShapeRectCoordinates();
                }
                break;
        }
    }

    /**
     * Adds a coordinate to the marker shape if the type is poly.
     *
     * @param integer $x The X coordinate.
     * @param integer $y The Y coordinate.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the type is not poly or if the poly coordinate is not
     *                                                     valid.
     */
    public function addPolyCoordinate($x, $y)
    {
        if ($this->type !== 'poly') {
            throw OverlayException::invalidMarkerShapeAddPolyCoordinateCall();
        }

        if (!is_numeric($x) || !is_numeric($y)) {
            throw OverlayException::invalidMarkerShapePolyCoordinate();
        }

        $this->coordinates[] = $x;
        $this->coordinates[] = $y;
    }
}
