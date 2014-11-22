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
 * Marker aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerAggregator extends AbstractAggregator
{
    /**
     * Aggregates the markers.
     *
     * @param \Ivory\GoogleMap\Map $map     The map.
     * @param array                $markers The markers.
     *
     * @return array The aggregated markers.
     */
    public function aggregate(Map $map, array $markers = array())
    {
        return $this->aggregateValues($map->getOverlays()->getMarkers(), $markers);
    }
}
