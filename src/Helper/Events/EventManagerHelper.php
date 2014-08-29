<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Events;

use Ivory\GoogleMap\Events\Event;

/**
 * Event manager helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelper
{
    /**
     * Renders a dom event.
     *
     * @param \Ivory\GoogleMap\Events\Event $domEvent The dom event.
     *
     * @return string The JS output.
     */
    public function renderDomEvent(Event $domEvent)
    {
        return sprintf(
            '%s = google.maps.event.addDomListener(%s, "%s", %s, %s);'.PHP_EOL,
            $domEvent->getJavascriptVariable(),
            $domEvent->getInstance(),
            $domEvent->getEventName(),
            $domEvent->getHandle(),
            json_encode($domEvent->isCapture())
        );
    }

    /**
     * Renders a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $domEventOnce The dom event once.
     *
     * @return string The JS output.
     */
    public function renderDomEventOnce(Event $domEventOnce)
    {
        return sprintf(
            '%s = google.maps.event.addDomListenerOnce(%s, "%s", %s, %s);'.PHP_EOL,
            $domEventOnce->getJavascriptVariable(),
            $domEventOnce->getInstance(),
            $domEventOnce->getEventName(),
            $domEventOnce->getHandle(),
            json_encode($domEventOnce->isCapture())
        );
    }

    /**
     * Renders an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     *
     * @return string The JS output.
     */
    public function renderEvent(Event $event)
    {
        return sprintf(
            '%s = google.maps.event.addListener(%s, "%s", %s);'.PHP_EOL,
            $event->getJavascriptVariable(),
            $event->getInstance(),
            $event->getEventName(),
            $event->getHandle()
        );
    }

    /**
     * Renders an event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     *
     * @return string The JS output.
     */
    public function renderEventOnce(Event $eventOnce)
    {
        return sprintf(
            '%s = google.maps.event.addListenerOnce(%s, "%s", %s);'.PHP_EOL,
            $eventOnce->getJavascriptVariable(),
            $eventOnce->getInstance(),
            $eventOnce->getEventName(),
            $eventOnce->getHandle()
        );
    }
}
