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
 * Icon aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /**
     * Creates an icon aggregator.
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
     * Aggregates the icons.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $icons The icons.
     *
     * @return array The aggregated icones.
     */
    public function aggregate(Map $map, array $icons = array())
    {
        return $this->aggregateMarkers($map, $icons);
    }

    /**
     * Aggregates the markers icons.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $icons The icones.
     *
     * @return array The aggregated icons.
     */
    public function aggregateMarkers(Map $map, array $icons = array())
    {
        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            if ($marker->hasIcon()) {
                $icons = $this->aggregateValue($marker->getIcon(), $icons);
            }

            if ($marker->hasShadow()) {
                $icons = $this->aggregateValue($marker->getShadow(), $icons);
            }
        }

        return $icons;
    }
}
