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
 * Event aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventAggregator extends AbstractAggregator
{
    /**
     * Aggregates the events.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $events The events.
     *
     * @return array The aggregated events.
     */
    public function aggregate(Map $map, array $events = array())
    {
        return $this->aggregateValues($map->getEvents()->getEvents(), $events);
    }
}
