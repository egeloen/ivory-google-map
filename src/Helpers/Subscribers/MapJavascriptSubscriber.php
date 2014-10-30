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

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;

/**
 * Map javascript subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapJavascriptSubscriber extends AbstractFormatterSubscriber
{
    /**
     * Configures the map javascript api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        $apiEvent->getDispatcher()->dispatch(ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE, $apiEvent);
        $apiEvent->getDispatcher()->dispatch(ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW, $apiEvent);
        $apiEvent->getDispatcher()->dispatch(ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER, $apiEvent);

        foreach ($apiEvent->getItems(ApiEvent::MAP) as $map) {
            $apiEvent->addCallback($this->getFormatter()->formatAssetCallback($map));
            $apiEvent->setLanguage($map->getLanguage());
            $apiEvent->addLibraries($map->getLibraries());
        }
    }

    /**
     * Renders the map javascript.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_INIT, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_BASE, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_MAP, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_OVERLAYS, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_LAYERS, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_EVENTS, $mapEvent);
        $mapEvent->getDispatcher()->dispatch(MapEvents::JAVASCRIPT_FINISH, $mapEvent);

        $mapEvent->setCode($this->getFormatter()->formatJavascript($this->getFormatter()->formatFunction(
            $mapEvent->getCode(),
            array(),
            $this->getFormatter()->formatAssetCallback($mapEvent->getMap())
        )));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ApiEvents::JAVASCRIPT_MAP => 'onApi',
            MapEvents::JAVASCRIPT     => 'onMap',
        );
    }
}
