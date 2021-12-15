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

use Ivory\GoogleMap\Helper\Collector\Image\EncodedPolylineCollector;
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineSubscriber implements EventSubscriberInterface
{
    private EncodedPolylineCollector $encodedPolylineCollector;

    private EncodedPolylineRenderer $encodedPolylineRenderer;

    public function __construct(
        EncodedPolylineCollector $encodedPolylineCollector,
        EncodedPolylineRenderer $encodedPolylineRenderer
    ) {
        $this->encodedPolylineCollector = $encodedPolylineCollector;
        $this->encodedPolylineRenderer = $encodedPolylineRenderer;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        foreach ($this->encodedPolylineCollector->collect($event->getMap()) as $encodedPolylines) {
            $event->setParameter('path', $this->encodedPolylineRenderer->render($encodedPolylines));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::ENCODED_POLYLINE => 'handleMap'];
    }
}
