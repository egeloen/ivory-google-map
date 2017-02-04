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
    /**
     * @var InfoWindowOpenRenderer
     */
    private $infoWindowOpenRenderer;

    /**
     * @var EventRenderer
     */
    private $eventRenderer;

    /**
     * @param Formatter              $formatter
     * @param MarkerCollector        $markerCollector
     * @param InfoWindowOpenRenderer $infoWindowOpenRenderer
     * @param EventRenderer          $eventRenderer
     */
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

    /**
     * @return InfoWindowOpenRenderer
     */
    public function getInfoWindowOpenRenderer()
    {
        return $this->infoWindowOpenRenderer;
    }

    /**
     * @param InfoWindowOpenRenderer $infoWindowOpenRenderer
     */
    public function setInfoWindowOpenRenderer(InfoWindowOpenRenderer $infoWindowOpenRenderer)
    {
        $this->infoWindowOpenRenderer = $infoWindowOpenRenderer;
    }

    /**
     * @return EventRenderer
     */
    public function getEventRenderer()
    {
        return $this->eventRenderer;
    }

    /**
     * @param EventRenderer $eventRenderer
     */
    public function setEventRenderer(EventRenderer $eventRenderer)
    {
        $this->eventRenderer = $eventRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_EVENT => 'handleMap'];
    }

    /**
     * @param Map    $map
     * @param Marker $marker
     *
     * @return Event
     */
    private function createEvent(Map $map, Marker $marker)
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
