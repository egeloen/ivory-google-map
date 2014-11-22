<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Map finish subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapFinishSubscriber implements EventSubscriberInterface
{
    /**
     * Renders the map javascript finish.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH_EXTENDABLE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH_MAP_CENTER, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH_MAP_BOUND, $mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH => 'onMap');
    }
}
