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

/**
 * Map stylesheet subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapStylesheetSubscriber extends AbstractFormatterSubscriber
{
    /**
     * Renders the map stylesheet.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        if ($map->hasStylesheetOptions()) {
            $mapEvent->addCode($this->getFormatter()->formatStylesheet(
                '#'.$map->getHtmlContainerId(),
                $map->getStylesheetOptions()
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::STYLESHEET => 'onMap');
    }
}
