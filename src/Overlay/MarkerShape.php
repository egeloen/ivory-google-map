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

    private ?string $type = null;

    /**
     * @var float[]
     */
    private array $coordinates = [];

    /**
     * @param string  $type
     * @param float[] $coordinates
     */
    public function __construct($type, array $coordinates)
    {
        $this->setType($type);
        $this->addCoordinates($coordinates);
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function hasCoordinates(): bool
    {
        return !empty($this->coordinates);
    }

    /**
     * @return float[]
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param float[] $coordinates
     */
    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param float[] $coordinates
     */
    public function addCoordinates(array $coordinates): void
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * @param float $coordinate
     */
    public function hasCoordinate($coordinate): bool
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    /**
     * @param float $coordinate
     */
    public function addCoordinate($coordinate): void
    {
        $this->coordinates[] = $coordinate;
    }
}
