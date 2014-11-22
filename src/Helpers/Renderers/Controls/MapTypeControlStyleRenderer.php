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
 * Map type control style renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleRenderer
{
    /**
     * Renders a map type control style.
     *
     * @param string $mapTypeControlStyle The map type control style.
     *
     * @return string The rendered map type control style.
     */
    public function render($mapTypeControlStyle)
    {
        return 'google.maps.MapTypeControlStyle.'.strtoupper($mapTypeControlStyle);
    }
}
