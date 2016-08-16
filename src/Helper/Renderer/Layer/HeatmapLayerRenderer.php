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
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerRenderer extends AbstractJsonRenderer
{
    /**
     * @param HeatmapLayer $heatmapLayer
     * @param Map          $map
     *
     * @return string
     */
    public function render(HeatmapLayer $heatmapLayer, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        foreach ($heatmapLayer->getCoordinates() as $index => $coordinate) {
            $jsonBuilder->setValue('[data]['.$index.']', $coordinate->getVariable(), false);
        }

        $jsonBuilder
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($heatmapLayer->getOptions());

        return $formatter->renderObjectAssignment($heatmapLayer, $formatter->renderObject('HeatmapLayer', [
            $jsonBuilder->build(),
        ], $formatter->renderClass('visualization')));
    }

    /**
     * @return string
     */
    public function renderRequirement()
    {
        return $this->getFormatter()->renderClass('visualization');
    }
}
