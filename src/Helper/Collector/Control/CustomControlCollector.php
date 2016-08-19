<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Control;

use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlCollector extends AbstractCollector
{
    /**
     * @param Map             $map
     * @param CustomControl[] $customControls
     *
     * @return CustomControl[]
     */
    public function collect(Map $map, array $customControls = [])
    {
        return $this->collectValues($map->getControlManager()->getCustomControls(), $customControls);
    }
}
