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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var Coordinate|null
     */
    private $southWest;

    /**
     * @var Coordinate|null
     */
    private $northEast;

    /**
     * @var ExtendableInterface[]
     */
    private $extendables = [];

    /**
     * @param Coordinate|null $southWest
     * @param Coordinate|null $northEast
     */
    public function __construct(Coordinate $southWest = null, Coordinate $northEast = null)
    {
        $this->setSouthWest($southWest);
        $this->setNorthEast($northEast);
    }

    /**
     * @return bool
     */
    public function hasCoordinates()
    {
        return $this->hasSouthWest() && $this->hasNorthEast();
    }

    /**
     * @return bool
     */
    public function hasSouthWest()
    {
        return $this->southWest !== null;
    }

    /**
     * @return Coordinate|null
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * @param Coordinate|null $southWest
     */
    public function setSouthWest(Coordinate $southWest = null)
    {
        $this->southWest = $southWest;
    }

    /**
     * @return bool
     */
    public function hasNorthEast()
    {
        return $this->northEast !== null;
    }

    /**
     * @return Coordinate|null
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * @param Coordinate|null $northEast
     */
    public function setNorthEast(Coordinate $northEast = null)
    {
        $this->northEast = $northEast;
    }

    /**
     * @return bool
     */
    public function hasExtendables()
    {
        return !empty($this->extendables);
    }

    /**
     * @return ExtendableInterface[]
     */
    public function getExtendables()
    {
        return $this->extendables;
    }

    /**
     * @param ExtendableInterface[] $extendables
     */
    public function setExtendables($extendables)
    {
        $this->extendables = [];
        $this->addExtendables($extendables);
    }

    /**
     * @param ExtendableInterface[] $extendables
     */
    public function addExtendables($extendables)
    {
        foreach ($extendables as $extendable) {
            $this->addExtendable($extendable);
        }
    }

    /**
     * @param ExtendableInterface $extendable
     *
     * @return bool
     */
    public function hasExtendable(ExtendableInterface $extendable)
    {
        return in_array($extendable, $this->extendables, true);
    }

    /**
     * @param ExtendableInterface $extendable
     */
    public function addExtendable(ExtendableInterface $extendable)
    {
        if (!$this->hasExtendable($extendable)) {
            $this->extendables[] = $extendable;
        }
    }

    /**
     * @param ExtendableInterface $extendable
     */
    public function removeExtendable(ExtendableInterface $extendable)
    {
        unset($this->extendables[array_search($extendable, $this->extendables, true)]);
        $this->extendables = empty($this->extendables) ? [] : array_values($this->extendables);
    }
}
