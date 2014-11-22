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
 * Event once aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceAggregator extends AbstractAggregator
{
    /**
     * Aggregates the events once.
     *
     * @param \Ivory\GoogleMap\Map $map        The map.
     * @param array                $eventsOnce The events once.
     *
     * @return array The aggregated events once.
     */
    public function aggregate(Map $map, array $eventsOnce = array())
    {
        return $this->aggregateValues($map->getEvents()->getEventsOnce(), $eventsOnce);
    }
}
