<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Place\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteEventCollector extends AbstractCollector
{
    /**
     * @param Autocomplete $autocomplete
     * @param Event[]      $events
     *
     * @return Event[]
     */
    public function collect(Autocomplete $autocomplete, array $events = [])
    {
        return $this->collectValues($autocomplete->getEventManager()->getEvents(), $events);
    }
}
