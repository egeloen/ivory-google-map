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

use Ivory\GoogleMap\Overlays\InfoWindow;

/**
 * Info window close renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseRenderer
{
    /**
     * Renders an info window close.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     *
     * @return string The rendered info window close.
     */
    public function render(InfoWindow $infoWindow)
    {
        return sprintf('%s.close()', $infoWindow->getVariable());
    }
}
