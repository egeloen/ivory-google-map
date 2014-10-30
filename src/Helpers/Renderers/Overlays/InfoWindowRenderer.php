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

/**
 * Info window renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowRenderer extends AbstractInfoWindowRenderer
{
    /**
     * {@inheritdoc}
     */
    public function doRender()
    {
        return sprintf('new google.maps.InfoWindow(%s)', $this->getJsonBuilder()->build());
    }
}
