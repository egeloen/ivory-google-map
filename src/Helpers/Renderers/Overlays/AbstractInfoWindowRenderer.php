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
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Abstract info window renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractInfoWindowRenderer extends AbstractJsonRenderer
{
    /**
     * Renders an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     *
     * @return string The rendered info window.
     */
    public function render(InfoWindow $infoWindow)
    {
        $this->getJsonBuilder()->reset();

        if ($infoWindow->hasPosition()) {
            $this->getJsonBuilder()->setValue('[position]', $infoWindow->getPosition()->getVariable(), false);
        }

        if ($infoWindow->hasPixelOffset()) {
            $this->getJsonBuilder()->setValue(
                '[pixelOffset]',
                $infoWindow->getPixelOffset()->getVariable(),
                false
            );
        }

        $this->getJsonBuilder()
            ->setValue('[content]', $infoWindow->getContent())
            ->setValues($infoWindow->getOptions());

        return $this->doRender();
    }

    /**
     * Does the rendering.
     *
     * @return string The rendered info window.
     */
    abstract protected function doRender();
}
