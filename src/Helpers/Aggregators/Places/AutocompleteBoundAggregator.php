<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Places;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Places\Autocomplete;

/**
 * Autocomplete bound aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundAggregator extends AbstractAggregator
{
    /**
     * Aggregates the bounds.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     * @param array                                $bounds       The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregate(Autocomplete $autocomplete, array $bounds = array())
    {
        if ($autocomplete->hasBound()) {
            return $this->aggregateValue($autocomplete->getBound(), $bounds);
        }

        return $bounds;
    }
}
