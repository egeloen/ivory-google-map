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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Polyline;

/**
 * Polyline helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelper
{
    /**
     * Renders a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     * @param \Ivory\GoogleMap\Map               $map      The map.
     *
     * @return string The JS output.
     */
    public function render(Polyline $polyline, Map $map)
    {
        $polylineOptions = $polyline->getOptions();

        $polylineCoordinates = array();
        foreach ($polyline->getCoordinates() as $coordinate) {
            $polylineCoordinates[] = $coordinate->getJavascriptVariable();
        }

        $polylineJSONOptions = sprintf(
            '{"map":%s,"path":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polylineCoordinates).']'
        );

        if (!empty($polylineOptions)) {
            $polylineJSONOptions .= ','.substr(json_encode($polylineOptions), 1);
        } else {
            $polylineJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.Polyline(%s);'.PHP_EOL,
            $polyline->getJavascriptVariable(),
            $polylineJSONOptions
        );
    }
}
