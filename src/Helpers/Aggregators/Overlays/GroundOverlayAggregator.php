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
 * Ground overlay aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayAggregator extends AbstractAggregator
{
    /**
     * Aggregates the ground overlays.
     *
     * @param \Ivory\GoogleMap\Map $map            The map.
     * @param array                $groundOverlays The ground overlays.
     *
     * @return array The aggregated ground overlays.
     */
    public function aggregate(Map $map, array $groundOverlays = array())
    {
        return $this->aggregateValues($map->getOverlays()->getGroundOverlays(), $groundOverlays);
    }
}
