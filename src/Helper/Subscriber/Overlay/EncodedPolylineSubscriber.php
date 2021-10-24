<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\EncodedPolylineCollector;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineSubscriber extends AbstractSubscriber
{
    private ?EncodedPolylineCollector $encodedPolylineCollector = null;

    private ?EncodedPolylineRenderer $encodedPolylineRenderer = null;

    public function __construct(
        Formatter $formatter,
        EncodedPolylineCollector $encodedPolylineCollector,
        EncodedPolylineRenderer $encodedPolylineRenderer
    ) {
        parent::__construct($formatter);

        $this->setEncodedPolylineCollector($encodedPolylineCollector);
        $this->setEncodedPolylineRenderer($encodedPolylineRenderer);
    }

    public function getEncodedPolylineCollector(): EncodedPolylineCollector
    {
        return $this->encodedPolylineCollector;
    }

    public function setEncodedPolylineCollector(EncodedPolylineCollector $encodedPolylineCollector): void
    {
        $this->encodedPolylineCollector = $encodedPolylineCollector;
    }

    public function getEncodedPolylineRenderer(): EncodedPolylineRenderer
    {
        return $this->encodedPolylineRenderer;
    }

    public function setEncodedPolylineRenderer(EncodedPolylineRenderer $encodedPolylineRenderer): void
    {
        $this->encodedPolylineRenderer = $encodedPolylineRenderer;
    }

    public function handleApi(ApiEvent $event): void
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $encodedPolylines = $this->encodedPolylineCollector->collect($map);

            if (!empty($encodedPolylines)) {
                $event->addLibrary('geometry');

                break;
            }
        }
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->encodedPolylineCollector->collect($map) as $encodedPolyline) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->encodedPolylineRenderer->render($encodedPolyline, $map),
                'overlays.encoded_polylines',
                $encodedPolyline
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                      => 'handleApi',
            MapEvents::JAVASCRIPT_OVERLAY_ENCODED_POLYLINE => 'handleMap',
        ];
    }
}
