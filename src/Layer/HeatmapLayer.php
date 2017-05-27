<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layer;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayer implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var Coordinate[]
     */
    private $coordinates = [];

    /**
     * @param Coordinate[] $coordinates
     * @param mixed[]      $options
     */
    public function __construct(array $coordinates = [], array $options = [])
    {
        $this->setCoordinates($coordinates);
        $this->setOptions($options);
    }

    /**
     * @return bool
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * @return Coordinate[]
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function setCoordinates(array $coordinates)
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function addCoordinates(array $coordinates)
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * @param Coordinate $coordinate
     *
     * @return bool
     */
    public function hasCoordinate(Coordinate $coordinate)
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    /**
     * @param Coordinate $coordinate
     */
    public function addCoordinate(Coordinate $coordinate)
    {
        if (!$this->hasCoordinate($coordinate)) {
            $this->coordinates[] = $coordinate;
        }
    }

    /**
     * @param Coordinate $coordinate
     */
    public function removeCoordinate(Coordinate $coordinate)
    {
        unset($this->coordinates[array_search($coordinate, $this->coordinates, true)]);
        $this->coordinates = empty($this->coordinates) ? [] : array_values($this->coordinates);
    }
}
