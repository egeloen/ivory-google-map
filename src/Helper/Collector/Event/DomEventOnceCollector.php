<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceCollector extends AbstractCollector
{
    /**
     * @param Map     $map
     * @param Event[] $domEventsOnce
     *
     * @return Event[]
     */
    public function collect(Map $map, array $domEventsOnce = [])
    {
        return $this->collectValues($map->getEventManager()->getDomEventsOnce(), $domEventsOnce);
    }
}
