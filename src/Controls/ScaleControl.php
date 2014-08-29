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

use Ivory\GoogleMap\Exception\ControlException;

/**
 * Scale control options describes a google map scale control options
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControl
{
    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $scaleControlStyle;

    /**
     * Creates a scale control.
     *
     * @param string $controlPosition   The control position.
     * @param string $scaleControlStyle The scale control style.
     */
    public function __construct(
        $controlPosition = ControlPosition::BOTTOM_LEFT,
        $scaleControlStyle = ScaleControlStyle::DEFAULT_
    ) {
        $this->setControlPosition($controlPosition);
        $this->setScaleControlStyle($scaleControlStyle);
    }

    /**
     * Gets the control position.
     *
     * @return string The control position.
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }

    /**
     * Sets the control position.
     *
     * @param string $controlPosition The control position.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the control position is not valid.
     */
    public function setControlPosition($controlPosition)
    {
        if (!in_array($controlPosition, ControlPosition::getControlPositions())) {
            throw ControlException::invalidControlPosition();
        }

        $this->controlPosition = $controlPosition;
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
     * @param type $scaleControlStyle The scale control style.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the scale control style is not valid.
     */
    public function setScaleControlStyle($scaleControlStyle)
    {
        if (!in_array($scaleControlStyle, ScaleControlStyle::getScaleControlStyles())) {
            throw ControlException::invalidScaleControlStyle();
        }

        $this->scaleControlStyle = $scaleControlStyle;
    }
}
