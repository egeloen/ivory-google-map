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
 * Encoded polyline aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineAggregator extends AbstractAggregator
{
    /**
     * Aggregates the encoded polylines.
     *
     * @param \Ivory\GoogleMap\Map $map              The map.
     * @param array                $encodedPolylines The encoded polylines.
     *
     * @return array The aggregated encoded polylines.
     */
    public function aggregate(Map $map, array $encodedPolylines = array())
    {
        return $this->aggregateValues($map->getOverlays()->getEncodedPolylines(), $encodedPolylines);
    }
}
