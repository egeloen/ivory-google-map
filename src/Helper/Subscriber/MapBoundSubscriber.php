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
    private ?MapBoundRenderer $mapBoundRenderer = null;

    public function __construct(Formatter $formatter, MapBoundRenderer $mapBoundRenderer)
    {
        parent::__construct($formatter);

        $this->setMapBoundRenderer($mapBoundRenderer);
    }

    public function getMapBoundRenderer(): MapBoundRenderer
    {
        return $this->mapBoundRenderer;
    }

    public function setMapBoundRenderer(MapBoundRenderer $mapBoundRenderer): void
    {
        $this->mapBoundRenderer = $mapBoundRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $map = $event->getMap();

        if ($map->isAutoZoom()) {
            $event->addCode($this->getFormatter()->renderCode($this->mapBoundRenderer->render($map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_FINISH => 'handleMap'];
    }
}
