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
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator;
use Ivory\GoogleMap\Map;

/**
 * Size aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator */
    private $iconAggregator;

    /**
     * Creates a size aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|null $infoWindowAggregator The info window aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator|null       $iconAggregator       The icon aggregator.
     */
    public function __construct(
        InfoWindowAggregator $infoWindowAggregator = null,
        IconAggregator $iconAggregator = null
    ) {
        $this->setInfoWindowAggregator($infoWindowAggregator ?: new InfoWindowAggregator());
        $this->setIconAggregator($iconAggregator ?: new IconAggregator());
    }

    /**
     * Gets the info window aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator The info window aggregator.
     */
    public function getInfoWindowAggregator()
    {
        return $this->infoWindowAggregator;
    }

    /**
     * Sets the info window aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator $infoWindowAggregator The info window aggregator.
     */
    public function setInfoWindowAggregator(InfoWindowAggregator $infoWindowAggregator)
    {
        $this->infoWindowAggregator = $infoWindowAggregator;
    }

    /**
     * Gets the icon aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator The icon aggregator.
     */
    public function getIconAggregator()
    {
        return $this->iconAggregator;
    }

    /**
     * Sets the icon aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator $iconAggregator The icon aggregator.
     */
    public function setIconAggregator(IconAggregator $iconAggregator)
    {
        $this->iconAggregator = $iconAggregator;
    }

    /**
     * Aggregates the sizes of a map.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregate(Map $map, array $sizes = array())
    {
        $sizes = $this->aggregateInfoWindows($map, $sizes);
        $sizes = $this->aggregateIcons($map, $sizes);

        return $sizes;
    }

    /**
     * Aggregates the info windows sizes.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregateInfoWindows(Map $map, array $sizes = array())
    {
        foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
            if ($infoWindow->hasPixelOffset()) {
                $sizes = $this->aggregateValue($infoWindow->getPixelOffset(), $sizes);
            }
        }

        return $sizes;
    }

    /**
     * Aggregates the icons sizes.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregateIcons(Map $map, array $sizes = array())
    {
        foreach ($this->iconAggregator->aggregate($map) as $icon) {
            if ($icon->hasSize()) {
                $sizes = $this->aggregateValue($icon->getSize(), $sizes);
            }

            if ($icon->hasScaledSize()) {
                $sizes = $this->aggregateValue($icon->getScaledSize(), $sizes);
            }
        }

        return $sizes;
    }
}
