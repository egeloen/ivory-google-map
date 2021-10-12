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

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerInfoWindowOpenSubscriber extends AbstractMarkerSubscriber
{
    private ?InfoWindowOpenRenderer $infoWindowOpenRenderer = null;

    private ?EventRenderer $eventRenderer = null;

    public function __construct(
        Formatter $formatter,
        MarkerCollector $markerCollector,
        InfoWindowOpenRenderer $infoWindowOpenRenderer,
        EventRenderer $eventRenderer
    ) {
        parent::__construct($formatter, $markerCollector);

        $this->setInfoWindowOpenRenderer($infoWindowOpenRenderer);
        $this->setEventRenderer($eventRenderer);
    }

    public function getInfoWindowOpenRenderer(): InfoWindowOpenRenderer
    {
        return $this->infoWindowOpenRenderer;
    }

    public function setInfoWindowOpenRenderer(InfoWindowOpenRenderer $infoWindowOpenRenderer): void
    {
        $this->infoWindowOpenRenderer = $infoWindowOpenRenderer;
    }

    public function getEventRenderer(): EventRenderer
    {
        return $this->eventRenderer;
    }

    public function setEventRenderer(EventRenderer $eventRenderer): void
    {
        $this->eventRenderer = $eventRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getMarkerCollector()->collect($map) as $marker) {
            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoOpen()) {
                $event->addCode($formatter->renderContainerAssignment(
                    $map,
                    $this->getEventRenderer()->render($rawEvent = $this->createEvent($map, $marker)),
                    'events.events',
                    $rawEvent
                ));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_EVENT => 'handleMap'];
    }

    private function createEvent(Map $map, Marker $marker): Event
    {
        $formatter = $this->getFormatter();

        $rawEvent = new Event(
            $marker->getVariable(),
            $marker->getInfoWindow()->getOpenEvent(),
            $formatter->renderClosure($formatter->renderLines([
                $formatter->renderCall(
                    $formatter->renderProperty(
                        $formatter->renderContainerVariable($map, 'functions'),
                        'info_windows_close'
                    ),
                    [],
                    true
                ),
                $formatter->renderCode(
                    $this->getInfoWindowOpenRenderer()->render($marker->getInfoWindow(), $map, $marker),
                    true,
                    false
                ),
            ]))
        );

        $rawEvent->setVariable($marker->getVariable().'_info_window_open_event');

        return $rawEvent;
    }
}
