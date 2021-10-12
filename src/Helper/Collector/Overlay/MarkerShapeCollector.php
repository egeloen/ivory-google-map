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
    private ?MarkerCollector $markerCollector = null;

    public function __construct(MarkerCollector $markerCollector)
    {
        $this->setMarkerCollector($markerCollector);
    }

    public function getMarkerCollector(): MarkerCollector
    {
        return $this->markerCollector;
    }

    public function setMarkerCollector(MarkerCollector $markerCollector): void
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @param MarkerShape[] $markerShapes
     * @return MarkerShape[]
     */
    public function collect(Map $map, array $markerShapes = []): array
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasShape()) {
                $markerShapes = $this->collectValue($marker->getShape(), $markerShapes);
            }
        }

        return $markerShapes;
    }
}
