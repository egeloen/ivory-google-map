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
    /**
     * @var PolylineCollector
     */
    private $polylineCollector;

    /**
     * @var PolylineRenderer
     */
    private $polylineRenderer;

    /**
     * @param Formatter         $formatter
     * @param PolylineCollector $polylineCollector
     * @param PolylineRenderer  $polylineRenderer
     */
    public function __construct(
        Formatter $formatter,
        PolylineCollector $polylineCollector,
        PolylineRenderer $polylineRenderer
    ) {
        parent::__construct($formatter);

        $this->setPolylineCollector($polylineCollector);
        $this->setPolylineRenderer($polylineRenderer);
    }

    /**
     * @return PolylineCollector
     */
    public function getPolylineCollector()
    {
        return $this->polylineCollector;
    }

    /**
     * @param PolylineCollector $polylineCollector
     */
    public function setPolylineCollector(PolylineCollector $polylineCollector)
    {
        $this->polylineCollector = $polylineCollector;
    }

    /**
     * @return PolylineRenderer
     */
    public function getPolylineRenderer()
    {
        return $this->polylineRenderer;
    }

    /**
     * @param PolylineRenderer $polylineRenderer
     */
    public function setPolylineRenderer(PolylineRenderer $polylineRenderer)
    {
        $this->polylineRenderer = $polylineRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_POLYLINE => 'handleMap'];
    }
}
