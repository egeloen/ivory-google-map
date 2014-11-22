<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Events;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Map;

/**
 * Dom event aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventAggregator extends AbstractAggregator
{
    /**
     * Aggregates the dom events.
     *
     * @param \Ivory\GoogleMap\Map $map       The map.
     * @param array                $domEvents The dom events.
     *
     * @return array The aggregated dom events.
     */
    public function aggregate(Map $map, array $domEvents = array())
    {
        return $this->aggregateValues($map->getEvents()->getDomEvents(), $domEvents);
    }
}
