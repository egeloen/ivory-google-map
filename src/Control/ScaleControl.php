<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlOptions
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControl
{
    private ?string $position = null;

    private ?string $style = null;

    /**
     * @param string $position
     * @param string $style
     */
    public function __construct($position = ControlPosition::BOTTOM_LEFT, $style = ScaleControlStyle::DEFAULT_)
    {
        $this->setPosition($position);
        $this->setStyle($style);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
    }
}
