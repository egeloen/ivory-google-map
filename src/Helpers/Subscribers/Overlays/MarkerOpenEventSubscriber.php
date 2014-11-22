<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Overlays;

use Ivory\GoogleMap\Events\Event;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker open event subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerOpenEventSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer */
    private $infoWindowOpenRenderer;

    /**
     * Creates a marker open event subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                     $formatter              The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|null     $markerAggregator       The marker aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer|null $infoWindowOpenRenderer The info window open renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        MarkerAggregator $markerAggregator = null,
        InfoWindowOpenRenderer $infoWindowOpenRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setMarkerAggregator($markerAggregator ?: new MarkerAggregator());
        $this->setInfoWindowOpenRenderer($infoWindowOpenRenderer ?: new InfoWindowOpenRenderer());
    }

    /**
     * Gets the marker aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator The marker aggregator.
     */
    public function getMarkerAggregator()
    {
        return $this->markerAggregator;
    }

    /**
     * Sets the marker aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator $markerAggregator The marker aggregator.
     */
    public function setMarkerAggregator(MarkerAggregator $markerAggregator)
    {
        $this->markerAggregator = $markerAggregator;
    }

    /**
     * Gets the info window open renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer The info window open renderer.
     */
    public function getInfoWindowOpenRenderer()
    {
        return $this->infoWindowOpenRenderer;
    }

    /**
     * Set the info window open renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer $infoWindowOpenRenderer The info window open renderer.
     */
    public function setInfoWindowOpenRenderer(InfoWindowOpenRenderer $infoWindowOpenRenderer)
    {
        $this->infoWindowOpenRenderer = $infoWindowOpenRenderer;
    }

    /**
     * Initializes the map javascript marker open events.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoOpen()) {
                $map->getEvents()->addEvent(new Event(
                    $marker->getVariable(),
                    $marker->getInfoWindow()->getOpenEvent(),
                    $this->createEventHandle($marker, $map)
                ));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT => 'onMap');
    }

    /**
     * Creates the event handle.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The event handle.
     */
    private function createEventHandle(Marker $marker, Map $map)
    {
        $code = $this->getFormatter()->formatFunctionCall($this->getFormatter()->formatContainerVariable(
            $map,
            'functions.info_windows.close'
        ));

        $code .= $this->getFormatter()->formatCode(
            $this->infoWindowOpenRenderer->render($marker->getInfoWindow(), $map, $marker)
        );

        return $this->getFormatter()->formatFunction($code, array(), null, false, true, false);
    }
}
