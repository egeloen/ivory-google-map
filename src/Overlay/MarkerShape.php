<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShape implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float[]
     */
    private $coordinates = [];

    /**
     * @param string  $type
     * @param float[] $coordinates
     */
    public function __construct($type, array $coordinates)
    {
        $this->setType($type);
        $this->addCoordinates($coordinates);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * @return float[]
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param float[] $coordinates
     */
    public function setCoordinates(array $coordinates)
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param float[] $coordinates
     */
    public function addCoordinates(array $coordinates)
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * @param float $coordinate
     *
     * @return bool
     */
    public function hasCoordinate($coordinate)
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    /**
     * @param float $coordinate
     */
    public function addCoordinate($coordinate)
    {
        $this->coordinates[] = $coordinate;
    }
}
