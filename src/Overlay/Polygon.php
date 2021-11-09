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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polygon implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var Coordinate[]
     */
    private array $coordinates = [];

    /**
     * @param Coordinate[] $coordinates
     * @param mixed[]      $options
     */
    public function __construct(array $coordinates = [], array $options = [])
    {
        $this->addCoordinates($coordinates);
        $this->addOptions($options);
    }

    public function hasCoordinates(): bool
    {
        return !empty($this->coordinates);
    }

    /**
     * @return Coordinate[]
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function addCoordinates(array $coordinates): void
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    public function hasCoordinate(Coordinate $coordinate): bool
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    public function addCoordinate(Coordinate $coordinate): void
    {
        $this->coordinates[] = $coordinate;
    }

    public function removeCoordinate(Coordinate $coordinate): void
    {
        unset($this->coordinates[array_search($coordinate, $this->coordinates, true)]);
        $this->coordinates = empty($this->coordinates) ? [] : array_values($this->coordinates);
    }
}
