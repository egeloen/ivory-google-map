<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Layer;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerCollector extends AbstractCollector
{
    /**
     * @param Map            $map
     * @param HeatmapLayer[] $heatmapLayers
     *
     * @return HeatmapLayer[]
     */
    public function collect(Map $map, array $heatmapLayers = [])
    {
        return $this->collectValues($map->getLayerManager()->getHeatmapLayers(), $heatmapLayers);
    }
}
