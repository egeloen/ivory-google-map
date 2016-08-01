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

use Ivory\GoogleMap\Overlay\InfoWindow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface InfoWindowRendererInterface
{
    /**
     * @param InfoWindow $infoWindow
     * @param bool       $position
     *
     * @return string
     */
    public function render(InfoWindow $infoWindow, $position = true);
}
