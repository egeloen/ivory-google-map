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
use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelper
{
    /**
     * Renders a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     * @param \Ivory\GoogleMapl\Map             $map     The map.
     *
     * @return string Ths JS output.
     */
    public function render(Polygon $polygon, Map $map)
    {
        $polygonOptions = $polygon->getOptions();

        $polygonCoordinates = array();
        foreach ($polygon->getCoordinates() as $coordinate) {
            $polygonCoordinates[] = $coordinate->getJavascriptVariable();
        }

        $polygonJSONOptions = sprintf(
            '{"map":%s,"paths":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polygonCoordinates).']'
        );

        if (!empty($polygonOptions)) {
            $polygonJSONOptions .= ','.substr(json_encode($polygonOptions), 1);
        } else {
            $polygonJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.Polygon(%s);'.PHP_EOL,
            $polygon->getJavascriptVariable(),
            $polygonJSONOptions
        );
    }
}
