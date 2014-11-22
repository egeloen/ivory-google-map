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
 * Dom event once aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceAggregator extends AbstractAggregator
{
    /**
     * Aggregates the dom events once.
     *
     * @param \Ivory\GoogleMap\Map $map           The map.
     * @param array                $domEventsOnce The dom events once.
     *
     * @return array The aggregated dom events once.
     */
    public function aggregate(Map $map, array $domEventsOnce = array())
    {
        return $this->aggregateValues($map->getEvents()->getDomEventsOnce(), $domEventsOnce);
    }
}
