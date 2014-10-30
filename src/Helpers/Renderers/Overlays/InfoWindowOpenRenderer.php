<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Info window open renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenRenderer
{
    /**
     * Renders an info window open.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow  $infoWindow The info window.
     * @param \Ivory\GoogleMap\Map                  $map        The map.
     * @param \Ivory\GoogleMap\Overlays\Marker|null $marker     The marker.
     *
     * @return string The rendered info window open.
     */
    public function render(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        $arguments = array($map->getVariable());

        if ($marker !== null) {
            $arguments[] = $marker->getVariable();
        }

        return sprintf('%s.open(%s)', $infoWindow->getVariable(), implode(',', $arguments));
    }
}
