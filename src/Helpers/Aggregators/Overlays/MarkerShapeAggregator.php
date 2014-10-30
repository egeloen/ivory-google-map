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
 * Marker shape aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /**
     * Creates a map marker shape aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|null $markerAggregator The marker aggregator.
     */
    public function __construct(MarkerAggregator $markerAggregator = null)
    {
        $this->setMarkerAggregator($markerAggregator ?: new MarkerAggregator());
    }

    /**
     * Gets the marker aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator The marker aggregator.
     */
    public function getMarkerAggregator()
    {
        return $this->markerAggregator;
    }

    /**
     * Sets the marker aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator $markerAggregator The marker aggregator.
     */
    public function setMarkerAggregator(MarkerAggregator $markerAggregator)
    {
        $this->markerAggregator = $markerAggregator;
    }

    /**
     * Aggregates the marker shapes.
     *
     * @param \Ivory\GoogleMap\Map $map          The map.
     * @param array                $markerShapes The marker shapes.
     *
     * @return array The aggregated marker shapes.
     */
    public function aggregate(Map $map, array $markerShapes = array())
    {
        return $this->aggregateMarkers($map, $markerShapes);
    }

    /**
     * Aggregates the markers marker shapes.
     *
     * @param \Ivory\GoogleMap\Map $map          The map.
     * @param array                $markerShapes The marker shapes.
     *
     * @return array The aggregated markers marker shapes.
     */
    public function aggregateMarkers(Map $map, array $markerShapes = array())
    {
        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            if ($marker->hasShape()) {
                $markerShapes = $this->aggregateValue($marker->getShape(), $markerShapes);
            }
        }

        return $markerShapes;
    }
}
