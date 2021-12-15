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
    private ?DefaultInfoWindowRenderer $infoWindowRenderer = null;

    public function __construct(
        Formatter $formatter,
        DefaultInfoWindowCollector $infoWindowCollector,
        DefaultInfoWindowRenderer $infoWindowRenderer
    ) {
        parent::__construct($formatter, $infoWindowCollector);

        $this->setInfoWindowRenderer($infoWindowRenderer);
    }

    public function getInfoWindowRenderer(): DefaultInfoWindowRenderer
    {
        return $this->infoWindowRenderer;
    }

    public function setInfoWindowRenderer(DefaultInfoWindowRenderer $infoWindowRenderer): void
    {
        $this->infoWindowRenderer = $infoWindowRenderer;
    }

    public function handleMap(MapEvent $event): void
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

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_INFO_WINDOW => 'handleMap'];
    }

    /**
     * @param bool       $position
     *
     */
    private function renderInfoWindow(Map $map, InfoWindow $infoWindow, $position = true): string
    {
        return $this->getFormatter()->renderContainerAssignment(
            $map,
            $this->infoWindowRenderer->render($infoWindow, $position),
            'overlays.info_windows',
            $infoWindow
        );
    }
}
