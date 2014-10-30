<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Layers;

use Ivory\GoogleMap\Layers\KmlLayer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Kml layer renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     * @param \Ivory\GoogleMap\Map             $map      The map.
     *
     * @return string The rendered kml layer.
     */
    public function render(KmlLayer $kmlLayer, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($kmlLayer->getOptions());

        return sprintf('new google.maps.KmlLayer("%s",%s)', $kmlLayer->getUrl(), $this->getJsonBuilder()->build());
    }
}
