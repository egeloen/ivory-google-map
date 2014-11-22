<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Controls;

/**
 * Control position renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionRenderer
{
    /**
     * Renders a control position.
     *
     * @param string $controlPosition The control position.
     *
     * @return The rendered control position.
     */
    public function render($controlPosition)
    {
        return 'google.maps.ControlPosition.'.strtoupper($controlPosition);
    }
}
