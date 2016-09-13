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

use Ivory\GoogleMap\Helper\Collector\Overlay\DefaultInfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\DefaultInfoWindowRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowSubscriber extends AbstractInfoWindowSubscriber
{
    /**
     * @var DefaultInfoWindowRenderer
     */
    private $infoWindowRenderer;

    /**
     * @param Formatter                  $formatter
     * @param DefaultInfoWindowCollector $infoWindowCollector
     * @param DefaultInfoWindowRenderer  $infoWindowRenderer
     */
    public function __construct(
        Formatter $formatter,
        DefaultInfoWindowCollector $infoWindowCollector,
        DefaultInfoWindowRenderer $infoWindowRenderer
    ) {
        parent::__construct($formatter, $infoWindowCollector);

        $this->setInfoWindowRenderer($infoWindowRenderer);
    }

    /**
     * @return DefaultInfoWindowRenderer
     */
    public function getInfoWindowRenderer()
    {
        return $this->infoWindowRenderer;
    }

    /**
     * @param DefaultInfoWindowRenderer $infoWindowRenderer
     */
    public function setInfoWindowRenderer(DefaultInfoWindowRenderer $infoWindowRenderer)
    {
        $this->infoWindowRenderer = $infoWindowRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();
        $collector = $this->getInfoWindowCollector();

        foreach ($collector->collect($map, [], InfoWindowCollector::STRATEGY_MAP) as $infoWindow) {
            $event->addCode($this->renderInfoWindow($map, $infoWindow));
        }

        foreach ($collector->collect($map, [], InfoWindowCollector::STRATEGY_MARKER) as $infoWindow) {
            $event->addCode($this->renderInfoWindow($map, $infoWindow, false));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_INFO_WINDOW => 'handleMap'];
    }

    /**
     * @param Map        $map
     * @param InfoWindow $infoWindow
     * @param bool       $position
     *
     * @return string
     */
    private function renderInfoWindow(Map $map, InfoWindow $infoWindow, $position = true)
    {
        return $this->getFormatter()->renderContainerAssignment(
            $map,
            $this->infoWindowRenderer->render($infoWindow, $position),
            'overlays.info_windows',
            $infoWindow
        );
    }
}
