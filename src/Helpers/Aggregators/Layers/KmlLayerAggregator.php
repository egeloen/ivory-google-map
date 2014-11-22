<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Layers;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Map;

/**
 * Kml layer aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerAggregator extends AbstractAggregator
{
    /**
     * Aggregates the kml layers.
     *
     * @param \Ivory\GoogleMap\Map $map       The map.
     * @param array                $kmlLayers The kml layers.
     *
     * @return array The aggregated kml layers.
     */
    public function aggregate(Map $map, array $kmlLayers = array())
    {
        return $this->aggregateValues($map->getLayers()->getKmlLayers(), $kmlLayers);
    }
}
