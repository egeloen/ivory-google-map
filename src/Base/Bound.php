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

use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see    http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound implements VariableAwareInterface
{
    use VariableAwareTrait;

    private ?Coordinate $southWest = null;
    private ?Coordinate $northEast = null;

    /**
     * @var ExtendableInterface[]
     */
    private array $extendables = [];

    public function __construct(?Coordinate $southWest = null, ?Coordinate $northEast = null)
    {
        $this->setSouthWest($southWest);
        $this->setNorthEast($northEast);
    }

    public function hasCoordinates(): bool
    {
        return $this->hasSouthWest() && $this->hasNorthEast();
    }

    public function hasSouthWest(): bool
    {
        return $this->southWest !== null;
    }

    public function getSouthWest(): ?Coordinate
    {
        return $this->southWest;
    }

    public function setSouthWest(?Coordinate $southWest = null): void
    {
        $this->southWest = $southWest;
    }

    public function hasNorthEast(): bool
    {
        return $this->northEast !== null;
    }

    public function getNorthEast(): ?Coordinate
    {
        return $this->northEast;
    }

    public function setNorthEast(?Coordinate $northEast = null): void
    {
        $this->northEast = $northEast;
    }

    public function hasExtendables(): bool
    {
        return !empty($this->extendables);
    }

    /**
     * @return ExtendableInterface[]
     */
    public function getExtendables(): array
    {
        return $this->extendables;
    }

    /**
     * @param ExtendableInterface[] $extendables
     */
    public function setExtendables(array $extendables): void
    {
        $this->extendables = [];
        $this->addExtendables($extendables);
    }

    /**
     * @param ExtendableInterface[] $extendables
     */
    public function addExtendables(array $extendables): void
    {
        foreach ($extendables as $extendable) {
            $this->addExtendable($extendable);
        }
    }

    public function hasExtendable(ExtendableInterface $extendable): bool
    {
        return in_array($extendable, $this->extendables, true);
    }

    public function addExtendable(ExtendableInterface $extendable): void
    {
        if (!$this->hasExtendable($extendable)) {
            $this->extendables[] = $extendable;
        }
    }

    public function removeExtendable(ExtendableInterface $extendable): void
    {
        unset($this->extendables[array_search($extendable, $this->extendables, true)]);
        $this->extendables = empty($this->extendables) ? [] : array_values($this->extendables);
    }
}
