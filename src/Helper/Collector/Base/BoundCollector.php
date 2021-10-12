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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundCollector extends AbstractCollector
{
    private ?GroundOverlayCollector $groundOverlayCollector = null;

    private ?RectangleCollector $rectangleCollector = null;

    public function __construct(GroundOverlayCollector $groundOverlayCollector, RectangleCollector $rectangleCollector)
    {
        $this->setGroundOverlayCollector($groundOverlayCollector);
        $this->setRectangleCollector($rectangleCollector);
    }

    public function getGroundOverlayCollector(): GroundOverlayCollector
    {
        return $this->groundOverlayCollector;
    }

    public function setGroundOverlayCollector(GroundOverlayCollector $groundOverlayCollector): void
    {
        $this->groundOverlayCollector = $groundOverlayCollector;
    }

    public function getRectangleCollector(): RectangleCollector
    {
        return $this->rectangleCollector;
    }

    public function setRectangleCollector(RectangleCollector $rectangleCollector): void
    {
        $this->rectangleCollector = $rectangleCollector;
    }

    /**
     * @param Bound[] $bounds
     * @return Bound[]
     */
    public function collect(Map $map, array $bounds = []): array
    {
        if ($map->isAutoZoom()) {
            $bounds = $this->collectValue($map->getBound(), $bounds);
        }

        foreach ($this->groundOverlayCollector->collect($map) as $groundOverlay) {
            $bounds = $this->collectValue($groundOverlay->getBound(), $bounds);
        }

        foreach ($this->rectangleCollector->collect($map) as $rectangle) {
            $bounds = $this->collectValue($rectangle->getBound(), $bounds);
        }

        return $bounds;
    }
}
