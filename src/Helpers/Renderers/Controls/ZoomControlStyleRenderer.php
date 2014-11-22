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
 * Zoom control style renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleRenderer
{
    /**
     * Renders a zoom control style.
     *
     * @param string $zoomControlStyle The zoom control style.
     *
     * @return string The rendered zoom control style.
     */
    public function render($zoomControlStyle)
    {
        return 'google.maps.ZoomControlStyle.'.strtoupper($zoomControlStyle);
    }
}
