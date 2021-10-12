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
use Ivory\GoogleMap\Helper\Renderer\MapCenterRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterSubscriber extends AbstractSubscriber
{
    private ?MapCenterRenderer $mapCenterRenderer = null;

    public function __construct(Formatter $formatter, MapCenterRenderer $mapCenterRenderer)
    {
        parent::__construct($formatter);

        $this->setMapCenterRenderer($mapCenterRenderer);
    }

    public function getMapCenterRenderer(): MapCenterRenderer
    {
        return $this->mapCenterRenderer;
    }

    public function setMapCenterRenderer(MapCenterRenderer $mapCenterRenderer): void
    {
        $this->mapCenterRenderer = $mapCenterRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $map = $event->getMap();

        if (!$map->isAutoZoom()) {
            $event->addCode($this->getFormatter()->renderCode($this->mapCenterRenderer->render($map)));
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
