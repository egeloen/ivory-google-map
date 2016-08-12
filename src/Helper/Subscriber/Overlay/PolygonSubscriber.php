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
    /**
     * @var PolygonCollector
     */
    private $polygonCollector;

    /**
     * @var PolygonRenderer
     */
    private $polygonRenderer;

    /**
     * @param Formatter        $formatter
     * @param PolygonCollector $polygonCollector
     * @param PolygonRenderer  $polygonRenderer
     */
    public function __construct(
        Formatter $formatter,
        PolygonCollector $polygonCollector,
        PolygonRenderer $polygonRenderer
    ) {
        parent::__construct($formatter);

        $this->setPolygonCollector($polygonCollector);
        $this->setPolygonRenderer($polygonRenderer);
    }

    /**
     * @return PolygonCollector
     */
    public function getPolygonCollector()
    {
        return $this->polygonCollector;
    }

    /**
     * @param PolygonCollector $polygonCollector
     */
    public function setPolygonCollector(PolygonCollector $polygonCollector)
    {
        $this->polygonCollector = $polygonCollector;
    }

    /**
     * @return PolygonRenderer
     */
    public function getPolygonRenderer()
    {
        return $this->polygonRenderer;
    }

    /**
     * @param PolygonRenderer $polygonRenderer
     */
    public function setPolygonRenderer(PolygonRenderer $polygonRenderer)
    {
        $this->polygonRenderer = $polygonRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_POLYGON => 'handleMap'];
    }
}
