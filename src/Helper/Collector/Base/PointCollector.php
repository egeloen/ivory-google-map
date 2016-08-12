<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Base;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointCollector extends AbstractCollector
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * @param MarkerCollector $markerCollector
     */
    public function __construct(MarkerCollector $markerCollector)
    {
        $this->setMarkerCollector($markerCollector);
    }

    /**
     * @return MarkerCollector
     */
    public function getMarkerCollector()
    {
        return $this->markerCollector;
    }

    /**
     * @param MarkerCollector $markerCollector
     */
    public function setMarkerCollector(MarkerCollector $markerCollector)
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @param Map     $map
     * @param Point[] $points
     *
     * @return Point[]
     */
    public function collect(Map $map, array $points = [])
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasIcon()) {
                $icon = $marker->getIcon();

                if ($icon->hasAnchor()) {
                    $points = $this->collectValue($icon->getAnchor(), $points);
                }

                if ($icon->hasOrigin()) {
                    $points = $this->collectValue($icon->getOrigin(), $points);
                }
            }
        }

        return $points;
    }
}
