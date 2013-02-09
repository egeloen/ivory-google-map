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
 * A zoom control describes a google map zoom control.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControl
{
    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $zoomControlStyle;

    /**
     * Create a zoom control
     */
    public function __construct(
        $controlPosition = ControlPosition::TOP_LEFT,
        $zoomControlStyle = ZoomControlStyle::DEFAULT_
    ) {
        $this->setControlPosition($controlPosition);
        $this->setZoomControlStyle($zoomControlStyle);
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
     * Gets the zoom control style.
     *
     * @return string The zoom control style.
     */
    public function getZoomControlStyle()
    {
        return $this->zoomControlStyle;
    }

    /**
     * Sets the zoom control style.
     *
     * @param string $zoomControlStyle The zoom control style.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the zoom control style is not valid.
     */
    public function setZoomControlStyle($zoomControlStyle)
    {
        if (!in_array($zoomControlStyle, ZoomControlStyle::getZoomControlStyles())) {
            throw ControlException::invalidZoomControlStyle();
        }

        $this->zoomControlStyle = $zoomControlStyle;
    }
}
