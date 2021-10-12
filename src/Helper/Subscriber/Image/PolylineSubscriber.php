<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Image;

use Ivory\GoogleMap\Helper\Collector\Image\PolylineCollector;
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineSubscriber implements EventSubscriberInterface
{
    private PolylineCollector $polylineCollector;

    private PolylineRenderer $polylineRenderer;

    public function __construct(PolylineCollector $polylineCollector, PolylineRenderer $polylineRenderer)
    {
        $this->polylineCollector = $polylineCollector;
        $this->polylineRenderer = $polylineRenderer;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        $result = [];

        foreach ($this->polylineCollector->collect($event->getMap()) as $polylines) {
            $result[] = $this->polylineRenderer->render($polylines);
        }

        if (!empty($result)) {
            $event->setParameter('path', $result);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::POLYLINE => 'handleMap'];
    }
}
