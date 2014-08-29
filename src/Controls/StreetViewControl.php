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
 * A street view control describes a google map street view control.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#StreetViewControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControl
{
    /** @var string */
    protected $controlPosition;

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
}
