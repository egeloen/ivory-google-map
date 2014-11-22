<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers;

/**
 * Map type id renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdRenderer
{
    /**
     * Renders a map map type id.
     *
     * @param string $mapTypeId The map type id.
     *
     * @return string The rendered map type id.
     */
    public function render($mapTypeId)
    {
        return 'google.maps.MapTypeId.'.strtoupper($mapTypeId);
    }
}
