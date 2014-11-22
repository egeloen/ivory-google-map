<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Events;

use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Events subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventsSubscriber implements EventSubscriberInterface
{
    /**
     * Renders the map javascript events.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_EVENTS_EVENT, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE, $mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_EVENTS => 'onMap');
    }
}
