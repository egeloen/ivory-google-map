<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Layers;

use Ivory\GoogleMap\Layers\KMLLayer;
use Ivory\GoogleMap\Map;

/**
 * KML Layer helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerHelper
{
    /**
     * Renders a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KMLLayer $kmlLayer The KML layer.
     * @param \Ivory\GoogleMap\Map             $map      The map.
     *
     * @return string The JS output.
     */
    public function render(KMLLayer $kmlLayer, Map $map)
    {
        $kmlLayerOptions = $kmlLayer->getOptions();
        $kmlLayerJSONOptions = sprintf('{"map":%s', $map->getJavascriptVariable());

        if (!empty($kmlLayerOptions)) {
            $kmlLayerJSONOptions .= ','.substr(json_encode($kmlLayerOptions), 1);
        } else {
            $kmlLayerJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.KmlLayer("%s", %s);'.PHP_EOL,
            $kmlLayer->getJavascriptVariable(),
            $kmlLayer->getUrl(),
            $kmlLayerJSONOptions
        );
    }
}
