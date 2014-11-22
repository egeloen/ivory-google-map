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
 * Polyline aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineAggregator extends AbstractAggregator
{
    /**
     * Aggregates the polylines.
     *
     * @param \Ivory\GoogleMap\Map $map       The map.
     * @param array                $polylines The polylines.
     *
     * @return array The aggregated polylines.
     */
    public function aggregate(Map $map, array $polylines = array())
    {
        return $this->aggregateValues($map->getOverlays()->getPolylines(), $polylines);
    }
}
