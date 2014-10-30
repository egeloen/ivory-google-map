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
 * Info window aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /**
     * Creates an info window aggregator.
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
     * Aggregates the info windows.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregate(Map $map, array $infoWindows = array())
    {
        $infoWindows = $this->aggregateInfoWindows($map, $infoWindows);
        $infoWindows = $this->aggregateMarkers($map, $infoWindows);

        return $infoWindows;
    }

    /**
     * Aggregates the overlays info windows.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregateInfoWindows(Map $map, array $infoWindows = array())
    {
        return $this->aggregateValues($map->getOverlays()->getInfoWindows(), $infoWindows);
    }

    /**
     * Aggregates the markers info windows.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregateMarkers(Map $map, array $infoWindows = array())
    {
        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            if ($marker->hasInfoWindow()) {
                $infoWindows = $this->aggregateValue($marker->getInfoWindow(), $infoWindows);
            }
        }

        return $infoWindows;
    }
}
