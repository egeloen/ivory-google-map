<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Overlays;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Map;

/**
 * Polygon aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonAggregator extends AbstractAggregator
{
    /**
     * Aggregates the polygons.
     *
     * @param \Ivory\GoogleMap\Map $map      The map.
     * @param array                $polygons The polygons.
     *
     * @return array The aggregated polygons.
     */
    public function aggregate(Map $map, array $polygons = array())
    {
        return $this->aggregateValues($map->getOverlays()->getPolygons(), $polygons);
    }
}
