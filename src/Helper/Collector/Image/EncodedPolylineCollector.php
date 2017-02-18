<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Image;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineCollector extends AbstractCollector
{
    /**
     * @param Map               $map
     * @param EncodedPolyline[] $encodedPolylines
     *
     * @return EncodedPolyline[][]
     */
    public function collect(Map $map, array $encodedPolylines = [])
    {
        return $this->collectValues($map->getOverlayManager()->getEncodedPolylines(), $encodedPolylines);
    }
}
