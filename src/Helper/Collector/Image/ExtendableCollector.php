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
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableCollector extends AbstractCollector
{
    /**
     * @param Map                   $map
     * @param ExtendableInterface[] $extendables
     *
     * @return ExtendableInterface[]
     */
    public function collect(Map $map, array $extendables = [])
    {
        foreach ($map->getBound()->getExtendables() as $extendable) {
            if ($extendable instanceof Marker || $extendable instanceof Polyline) {
                $extendables = $this->collectValue($extendable, $extendables);
            }
        }

        return $extendables;
    }
}
