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
 * Scale control style renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleRenderer
{
    /**
     * Renders a scale control style.
     *
     * @param string $scaleControlStyle The scale control style.
     *
     * @return string The rendered scale control style.
     */
    public function render($scaleControlStyle)
    {
        return 'google.maps.ScaleControlStyle.'.strtoupper($scaleControlStyle);
    }
}
