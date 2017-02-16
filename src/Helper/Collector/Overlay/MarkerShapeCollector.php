<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\MarkerShape;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeCollector extends AbstractCollector
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
     * @param Map           $map
     * @param MarkerShape[] $markerShapes
     *
     * @return MarkerShape[]
     */
    public function collect(Map $map, array $markerShapes = [])
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasShape()) {
                $markerShapes = $this->collectValue($marker->getShape(), $markerShapes);
            }
        }

        return $markerShapes;
    }
}
