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

use Ivory\GoogleMap\Overlays\MarkerShape;

/**
 * Marker shape helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeHelper
{
    /**
     * Renders a marker shape.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $markerShape The marker shape.
     *
     * @return string The JS output.
     */
    public function render(MarkerShape $markerShape)
    {
        return sprintf(
            '%s = new google.maps.MarkerShape(%s);'.PHP_EOL,
            $markerShape->getJavascriptVariable(),
            json_encode(array('type' => $markerShape->getType(), 'coords' => $markerShape->getCoordinates()))
        );
    }
}
