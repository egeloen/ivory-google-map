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
 * Map init subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapInitSubscriber implements EventSubscriberInterface
{
    /**
     * Initializes the map javascript.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_INIT_CONTAINER, $mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_INIT => 'onMap');
    }
}
