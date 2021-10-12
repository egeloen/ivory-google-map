<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenRenderer extends AbstractRenderer
{
    /**
     * @param Marker|null $marker
     *
     */
    public function render(InfoWindow $infoWindow, Map $map, Marker $marker = null): string
    {
        $arguments = [$map->getVariable()];

        if ($marker !== null) {
            $arguments[] = $marker->getVariable();
        }

        return $this->getFormatter()->renderObjectCall($infoWindow, 'open', $arguments);
    }
}
