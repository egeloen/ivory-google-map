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
use Ivory\GoogleMap\Overlay\ExtendableInterface;

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
        return $this->collectValues($map->getBound()->getExtendables(), $extendables);
    }
}
