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
 * Extendable aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableAggregator extends AbstractAggregator
{
    /**
     * Aggregates the extends.
     *
     * @param \Ivory\GoogleMap\Map $map     The map.
     * @param array                $extends The extends.
     *
     * @return array The aggregated extends.
     */
    public function aggregate(Map $map, array $extends = array())
    {
        return $this->aggregateValues($map->getOverlays()->getExtends(), $extends);
    }
}
