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
 * Street view control.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#StreetViewControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControl
{
    /** @var string */
    private $controlPosition;

    /**
     * Creates a street view control.
     *
     * @param string $controlPosition The control position.
     */
    public function __construct($controlPosition = ControlPosition::TOP_LEFT)
    {
        $this->setControlPosition($controlPosition);
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
}
