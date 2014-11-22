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
 * Autocomplete coordinate aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator */
    private $boundAggregator;

    /**
     * Creates an autocomplete coordinate aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator $boundAggregator The bound aggregator.
     */
    public function __construct(AutocompleteBoundAggregator $boundAggregator = null)
    {
        $this->setBoundAggregator($boundAggregator ?: new AutocompleteBoundAggregator());
    }

    /**
     * Gets the bound aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator The bound aggregator.
     */
    public function getBoundAggregator()
    {
        return $this->boundAggregator;
    }

    /**
     * Sets the bound aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator $boundAggregator The bound aggregator.
     */
    public function setBoundAggregator(AutocompleteBoundAggregator $boundAggregator)
    {
        $this->boundAggregator = $boundAggregator;
    }

    /**
     * Aggregates the coordinates.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     * @param array                                $coordinates  The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregate(Autocomplete $autocomplete, array $coordinates = array())
    {
        foreach ($this->boundAggregator->aggregate($autocomplete) as $bound) {
            if ($bound->hasSouthWest()) {
                $coordinates = $this->aggregateValue($bound->getSouthWest(), $coordinates);
            }

            if ($bound->hasNorthEast()) {
                $coordinates = $this->aggregateValue($bound->getNorthEast(), $coordinates);
            }
        }

        return $coordinates;
    }
}
