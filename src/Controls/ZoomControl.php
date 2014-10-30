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
 * Zoom control.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControl
{
    /** @var string */
    private $controlPosition;

    /** @var string */
    private $zoomControlStyle;

    /**
     * Creates a zoom control.
     *
     * @param string $controlPosition  The control position.
     * @param string $zoomControlStyle The zoom control style.
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
     */
    public function setControlPosition($controlPosition)
    {
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
     */
    public function setZoomControlStyle($zoomControlStyle)
    {
        $this->zoomControlStyle = $zoomControlStyle;
    }
}
