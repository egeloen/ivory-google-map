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
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * Polygon.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polygon extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var array */
    private $coordinates = array();

    /**
     * Creates a polygon.
     *
     * @param array $coordinates The coordinates.
     */
    public function __construct(array $coordinates)
    {
        parent::__construct('polygon_');

        $this->addCoordinates($coordinates);
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
        $this->resetCoordinates();
        $this->addCoordinates($coordinates);
    }

    /**
     * Adds the coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    public function addCoordinates(array $coordinates)
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * Removes the coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    public function removeCoordinates(array $coordinates)
    {
        foreach ($coordinates as $coordinate) {
            $this->removeCoordinate($coordinate);
        }
    }

    /**
     * Checks if there is a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     *
     * @return boolean TRUE if there is the coordinate else FALSE.
     */
    public function hasCoordinate(Coordinate $coordinate)
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    /**
     * Adds a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    public function addCoordinate(Coordinate $coordinate)
    {
        if (!$this->hasCoordinate($coordinate)) {
            $this->coordinates[] = $coordinate;
        }
    }

    /**
     * Removes a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    public function removeCoordinate(Coordinate $coordinate)
    {
        unset($this->coordinates[array_search($coordinate, $this->coordinates, true)]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.getPath().forEach(function(e){%s.extend(e);})', $this->getVariable(), $bound->getVariable());
    }
}
