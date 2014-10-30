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
 * Rectangle agregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleAggregator extends AbstractAggregator
{
    /**
     * Aggregates the rectangles.
     *
     * @param \Ivory\GoogleMap\Map $map        The map.
     * @param array                $rectangles The rectangles.
     *
     * @return array The aggregated rectangles.
     */
    public function aggregate(Map $map, array $rectangles = array())
    {
        return $this->aggregateValues($map->getOverlays()->getRectangles(), $rectangles);
    }
}
