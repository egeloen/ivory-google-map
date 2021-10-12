<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Layer;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerRenderer extends AbstractJsonRenderer
{
    public function render(GeoJsonLayer $geoJsonLayer, Map $map): string
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()->setValues($geoJsonLayer->getOptions());

        return $formatter->renderObjectCall($map, $formatter->renderProperty('data', 'loadGeoJson'), [
            $formatter->renderEscape($geoJsonLayer->getUrl()),
            $jsonBuilder->build(),
        ]);
    }
}
