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
use Ivory\GoogleMap\Overlay\GroundOverlay;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayCollector extends AbstractCollector
{
    /**
     * @param GroundOverlay[] $groundOverlays
     * @return GroundOverlay[]
     */
    public function collect(Map $map, array $groundOverlays = []): array
    {
        return $this->collectValues($map->getOverlayManager()->getGroundOverlays(), $groundOverlays);
    }
}
