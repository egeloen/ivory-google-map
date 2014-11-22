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
 * Map html subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHtmlSubscriber extends AbstractFormatterSubscriber
{
    /**
     * Renders the map html.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        $mapEvent->addCode($this->getFormatter()->formatTag(
            'div',
            null,
            array(
                'id'    => $map->getHtmlContainerId(),
                'style' => sprintf(
                    'width:%s;height:%s;',
                    $map->hasStylesheetOption('width') ? $map->getStylesheetOption('width') : '300px',
                    $map->hasStylesheetOption('height') ? $map->getStylesheetOption('height') : '300px'
                ),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::HTML => 'onMap');
    }
}
