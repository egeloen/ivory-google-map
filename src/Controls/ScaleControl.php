<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

/**
 * Scale control.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControl
{
    /** @var string */
    private $scaleControlStyle;

    /**
     * Creates a scale control.
     *
     * @param string $scaleControlStyle The scale control style.
     */
    public function __construct($scaleControlStyle = ScaleControlStyle::DEFAULT_)
    {
        $this->setScaleControlStyle($scaleControlStyle);
    }

    /**
     * Gets the scale control style.
     *
     * @return string The scale control style.
     */
    public function getScaleControlStyle()
    {
        return $this->scaleControlStyle;
    }

    /**
     * Sets the scale control style.
     *
     * @param string $scaleControlStyle The scale control style.
     */
    public function setScaleControlStyle($scaleControlStyle)
    {
        $this->scaleControlStyle = $scaleControlStyle;
    }
}
