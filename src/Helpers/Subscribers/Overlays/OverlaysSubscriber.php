<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Overlays;

use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Overlays subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlaysSubscriber implements EventSubscriberInterface
{
    /**
     * Renders the map javascript overlays.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_ICON, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_MARKER, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER, $mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS => 'onMap');
    }
}
