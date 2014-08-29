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
 * A pan control describes a google map pan control.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PanControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControl
{
    /** @var string */
    protected $controlPosition;

    /**
     * Create a pan control.
     *
     * @param string $controlPosition The pan control position.
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
