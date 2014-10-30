<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Events;

use Ivory\GoogleMap\Events\Event;

/**
 * Event renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventRenderer
{
    /**
     * Renders an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     *
     * @return string The rendered event.
     */
    public function render(Event $event)
    {
        return sprintf(
            'google.maps.event.addListener(%s,"%s",%s)',
            $event->getInstance(),
            $event->getEventName(),
            $event->getHandle()
        );
    }
}
