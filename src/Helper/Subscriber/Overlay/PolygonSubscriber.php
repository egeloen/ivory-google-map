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

use Ivory\GoogleMap\Helper\Collector\Overlay\PolygonCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolygonRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonSubscriber extends AbstractSubscriber
{
    private ?PolygonCollector $polygonCollector = null;

    private ?PolygonRenderer $polygonRenderer = null;

    public function __construct(
        Formatter $formatter,
        PolygonCollector $polygonCollector,
        PolygonRenderer $polygonRenderer
    ) {
        parent::__construct($formatter);

        $this->setPolygonCollector($polygonCollector);
        $this->setPolygonRenderer($polygonRenderer);
    }

    public function getPolygonCollector(): PolygonCollector
    {
        return $this->polygonCollector;
    }

    public function setPolygonCollector(PolygonCollector $polygonCollector): void
    {
        $this->polygonCollector = $polygonCollector;
    }

    public function getPolygonRenderer(): PolygonRenderer
    {
        return $this->polygonRenderer;
    }

    public function setPolygonRenderer(PolygonRenderer $polygonRenderer): void
    {
        $this->polygonRenderer = $polygonRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->polygonCollector->collect($map) as $polygon) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->polygonRenderer->render($polygon, $map),
                'overlays.polygons',
                $polygon
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_POLYGON => 'handleMap'];
    }
}
