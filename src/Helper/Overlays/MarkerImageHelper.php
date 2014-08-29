<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Overlays\MarkerImage;

/**
 * Marker image helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelper
{
    /**
     * Renders a marker image.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $markerImage The marker image.
     *
     * @return string The JS output.
     */
    public function render(MarkerImage $markerImage)
    {
        return sprintf(
            '%s = new google.maps.MarkerImage("%s", %s, %s, %s, %s);'.PHP_EOL,
            $markerImage->getJavascriptVariable(),
            $markerImage->getUrl(),
            $markerImage->hasSize() ? $markerImage->getSize()->getJavascriptVariable() : 'null',
            $markerImage->hasOrigin() ? $markerImage->getOrigin()->getJavascriptVariable() : 'null',
            $markerImage->hasAnchor() ? $markerImage->getAnchor()->getJavascriptVariable() : 'null',
            $markerImage->hasScaledSize() ? $markerImage->getScaledSize()->getJavascriptVariable() : 'null'
        );
    }
}
