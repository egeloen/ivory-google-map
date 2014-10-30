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
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator;
use Ivory\GoogleMap\Map;

/**
 * Bound aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator */
    private $groundOverlayAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator */
    private $rectangleAggregator;

    /**
     * Creates a map bound aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator|null $groundOverlayAggregator The ground overlay aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator|null     $rectangleAggregator     The rectangle aggregator.
     */
    public function __construct(
        GroundOverlayAggregator $groundOverlayAggregator = null,
        RectangleAggregator $rectangleAggregator = null
    ) {
        $this->setGroundOverlayAggregator($groundOverlayAggregator ?: new GroundOverlayAggregator());
        $this->setRectangleAggregator($rectangleAggregator ?: new RectangleAggregator());
    }

    /**
     * Gets the ground overlay aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator The ground overlay aggregator.
     */
    public function getGroundOverlayAggregator()
    {
        return $this->groundOverlayAggregator;
    }

    /**
     * Sets the ground overlay aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator $groundOverlayAggregator The ground overlay aggregator.
     */
    public function setGroundOverlayAggregator(GroundOverlayAggregator $groundOverlayAggregator)
    {
        $this->groundOverlayAggregator = $groundOverlayAggregator;
    }

    /**
     * Gets the rectangle aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator The rectangle aggregator.
     */
    public function getRectangleAggregator()
    {
        return $this->rectangleAggregator;
    }

    /**
     * Sets the rectangle aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator $rectangleAggregator The rectangle aggregator.
     */
    public function setRectangleAggregator(RectangleAggregator $rectangleAggregator)
    {
        $this->rectangleAggregator = $rectangleAggregator;
    }

    /**
     * Aggregates the bounds.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregate(Map $map, array $bounds = array())
    {
        if ($map->getOverlays()->isAutoZoom()) {
            $bounds = $this->aggregateValue($map->getBound(), $bounds);
        }

        $bounds = $this->aggregateGroundOverlays($map, $bounds);
        $bounds = $this->aggregateRectangles($map, $bounds);

        return $bounds;
    }

    /**
     * Aggregates the ground overlays bounds.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregateGroundOverlays(Map $map, array $bounds = array())
    {
        foreach ($this->groundOverlayAggregator->aggregate($map) as $groundOverlay) {
            $bounds = $this->aggregateValue($groundOverlay->getBound(), $bounds);
        }

        return $bounds;
    }

    /**
     * Aggregates the rectangles bounds.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregateRectangles(Map $map, array $bounds = array())
    {
        foreach ($this->rectangleAggregator->aggregate($map) as $rectangle) {
            $bounds = $this->aggregateValue($rectangle->getBound(), $bounds);
        }

        return $bounds;
    }
}
