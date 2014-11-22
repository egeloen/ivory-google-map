<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Base;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Icon;

/**
 * Point aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /**
     * Creates a point aggregator.
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
     * Aggregates the points of a map.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $points The points.
     *
     * @return array The aggregated points.
     */
    public function aggregate(Map $map, array $points = array())
    {
        return $this->aggregateMarkers($map, $points);
    }

    /**
     * Aggregates the markers points.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $points The points.
     *
     * @return array The aggregated points.
     */
    public function aggregateMarkers(Map $map, array $points = array())
    {
        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            if ($marker->hasIcon()) {
                $points = $this->aggregateIcon($marker->getIcon(), $points);
            }

            if ($marker->hasShadow()) {
                $points = $this->aggregateIcon($marker->getShadow(), $points);
            }
        }

        return $points;
    }

    /**
     * Aggregates the icons points.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon $icon   The icon.
     * @param array                          $points The points.
     *
     * @return array The aggregated points.
     */
    private function aggregateIcon(Icon $icon, array $points = array())
    {
        if ($icon->hasAnchor()) {
            $points = $this->aggregateValue($icon->getAnchor(), $points);
        }

        if ($icon->hasOrigin()) {
            $points = $this->aggregateValue($icon->getOrigin(), $points);
        }

        return $points;
    }
}
