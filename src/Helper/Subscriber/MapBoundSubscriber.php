<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\MapBoundRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundSubscriber extends AbstractSubscriber
{
    /**
     * @var MapBoundRenderer
     */
    private $mapBoundRenderer;

    /**
     * @param Formatter        $formatter
     * @param MapBoundRenderer $mapBoundRenderer
     */
    public function __construct(Formatter $formatter, MapBoundRenderer $mapBoundRenderer)
    {
        parent::__construct($formatter);

        $this->setMapBoundRenderer($mapBoundRenderer);
    }

    /**
     * @return MapBoundRenderer
     */
    public function getMapBoundRenderer()
    {
        return $this->mapBoundRenderer;
    }

    /**
     * @param MapBoundRenderer $mapBoundRenderer
     */
    public function setMapBoundRenderer(MapBoundRenderer $mapBoundRenderer)
    {
        $this->mapBoundRenderer = $mapBoundRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();

        if ($map->isAutoZoom()) {
            $event->addCode($this->getFormatter()->renderCode($this->mapBoundRenderer->render($map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_FINISH => 'handleMap'];
    }
}
