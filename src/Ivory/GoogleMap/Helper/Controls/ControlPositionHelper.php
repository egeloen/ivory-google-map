<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Exception\HelperException;

/**
 * Control position helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionHelper
{
    /**
     * Renders a control position.
     *
     * @param string $controlPosition The control position.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the control position is not valid.
     *
     * @return The JS output.
     */
    public function render($controlPosition)
    {
        switch ($controlPosition) {
            case ControlPosition::BOTTOM_CENTER:
            case ControlPosition::BOTTOM_LEFT:
            case ControlPosition::BOTTOM_RIGHT:
            case ControlPosition::LEFT_BOTTOM:
            case ControlPosition::LEFT_CENTER:
            case ControlPosition::LEFT_TOP:
            case ControlPosition::RIGHT_BOTTOM:
            case ControlPosition::RIGHT_CENTER:
            case ControlPosition::RIGHT_TOP:
            case ControlPosition::TOP_CENTER:
            case ControlPosition::TOP_LEFT:
            case ControlPosition::TOP_RIGHT:
                return sprintf('google.maps.ControlPosition.%s', strtoupper($controlPosition));
            default:
                throw HelperException::invalidControlPosition();
        }
    }
}
