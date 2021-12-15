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
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker implements ExtendableInterface, OptionsAwareInterface, StaticOptionsAwareInterface
{
    use OptionsAwareTrait;
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    private ?Coordinate $position = null;

    private ?string $animation = null;

    private ?Icon $icon = null;

    private ?Symbol $symbol = null;

    private ?MarkerShape $shape = null;

    private ?InfoWindow $infoWindow = null;

    /**
     * @param string|null      $animation
     * @param Icon|null        $icon
     * @param MarkerShape|null $shape
     * @param Symbol|null      $symbol
     * @param mixed[]          $options
     */
    public function __construct(
        Coordinate $position,
        $animation = null,
        Icon $icon = null,
        Symbol $symbol = null,
        MarkerShape $shape = null,
        array $options = []
    ) {
        $this->setPosition($position);
        $this->setAnimation($animation);
        $this->setShape($shape);
        $this->addOptions($options);

        if ($icon !== null) {
            $this->setIcon($icon);
        } elseif ($symbol !== null) {
            $this->setSymbol($symbol);
        }
    }

    public function getPosition(): Coordinate
    {
        return $this->position;
    }

    public function setPosition(Coordinate $position): void
    {
        $this->position = $position;
    }

    public function hasAnimation(): bool
    {
        return $this->animation !== null;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    /**
     * @param string|null $animation
     */
    public function setAnimation($animation = null): void
    {
        $this->animation = $animation;
    }

    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }

    public function getIcon(): ?Icon
    {
        return $this->icon;
    }

    /**
     * @param Icon|null $icon
     */
    public function setIcon(Icon $icon = null): void
    {
        $this->icon = $icon;

        if ($icon !== null) {
            $this->setSymbol(null);
        }
    }

    public function hasSymbol(): bool
    {
        return $this->symbol !== null;
    }

    public function getSymbol(): ?Symbol
    {
        return $this->symbol;
    }

    /**
     * @param Symbol|null $symbol
     */
    public function setSymbol(Symbol $symbol = null): void
    {
        $this->symbol = $symbol;

        if ($symbol !== null) {
            $this->setIcon(null);
        }
    }

    public function hasShape(): bool
    {
        return $this->shape !== null;
    }

    public function getShape(): ?MarkerShape
    {
        return $this->shape;
    }

    /**
     * @param MarkerShape|null $shape
     */
    public function setShape(MarkerShape $shape = null): void
    {
        $this->shape = $shape;
    }

    public function hasInfoWindow(): bool
    {
        return $this->infoWindow !== null;
    }

    public function getInfoWindow(): ?InfoWindow
    {
        return $this->infoWindow;
    }

    /**
     * @param InfoWindow|null $infoWindow
     */
    public function setInfoWindow(InfoWindow $infoWindow = null): void
    {
        $this->infoWindow = $infoWindow;
    }
}
