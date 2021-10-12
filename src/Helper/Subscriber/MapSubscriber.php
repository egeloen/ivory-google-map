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
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapSubscriber extends AbstractSubscriber
{
    private ?MapRenderer $mapRenderer = null;

    public function __construct(Formatter $formatter, MapRenderer $mapRenderer)
    {
        parent::__construct($formatter);

        $this->setMapRenderer($mapRenderer);
    }

    public function getMapRenderer(): MapRenderer
    {
        return $this->mapRenderer;
    }

    public function setMapRenderer(MapRenderer $mapRenderer): void
    {
        $this->mapRenderer = $mapRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $map = $event->getMap();

        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $map,
            $this->mapRenderer->render($map),
            'map'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_MAP => 'handleMap'];
    }
}
