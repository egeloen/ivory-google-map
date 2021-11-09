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

use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolylineRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineSubscriber extends AbstractSubscriber
{
    private ?PolylineCollector $polylineCollector = null;

    private ?PolylineRenderer $polylineRenderer = null;

    public function __construct(
        Formatter $formatter,
        PolylineCollector $polylineCollector,
        PolylineRenderer $polylineRenderer
    ) {
        parent::__construct($formatter);

        $this->setPolylineCollector($polylineCollector);
        $this->setPolylineRenderer($polylineRenderer);
    }

    public function getPolylineCollector(): PolylineCollector
    {
        return $this->polylineCollector;
    }

    public function setPolylineCollector(PolylineCollector $polylineCollector): void
    {
        $this->polylineCollector = $polylineCollector;
    }

    public function getPolylineRenderer(): PolylineRenderer
    {
        return $this->polylineRenderer;
    }

    public function setPolylineRenderer(PolylineRenderer $polylineRenderer): void
    {
        $this->polylineRenderer = $polylineRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->polylineCollector->collect($map) as $polyline) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->polylineRenderer->render($polyline, $map),
                'overlays.polylines',
                $polyline
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_POLYLINE => 'handleMap'];
    }
}
