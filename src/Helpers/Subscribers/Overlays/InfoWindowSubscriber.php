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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;
use Ivory\GoogleMap\Overlays\InfoWindowType;

/**
 * Info window subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer */
    private $infoWindowRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer */
    private $infoBoxRenderer;

    /**
     * Creates a map info window subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                     $formatter            The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|null $infoWindowAggregator The info window aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer|null     $infoWindowRenderer   The info window renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer|null        $infoBoxRenderer      The info box renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        InfoWindowAggregator $infoWindowAggregator = null,
        InfoWindowRenderer $infoWindowRenderer = null,
        InfoBoxRenderer $infoBoxRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setInfoWindowAggregator($infoWindowAggregator ?: new InfoWindowAggregator());
        $this->setInfoWindowRenderer($infoWindowRenderer ?: new InfoWindowRenderer());
        $this->setInfoBoxRenderer($infoBoxRenderer ?: new InfoBoxRenderer());
    }

    /**
     * Gets the info window aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator The info window aggregator.
     */
    public function getInfoWindowAggregator()
    {
        return $this->infoWindowAggregator;
    }

    /**
     * Sets the info window aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator $infoWindowAggregator The info window aggregator.
     */
    public function setInfoWindowAggregator(InfoWindowAggregator $infoWindowAggregator)
    {
        $this->infoWindowAggregator = $infoWindowAggregator;
    }

    /**
     * Gets the info window renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer The info window renderer.
     */
    public function getInfoWindowRenderer()
    {
        return $this->infoWindowRenderer;
    }

    /**
     * Sets the info window renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer $infoWindowRenderer The info window renderer.
     */
    public function setInfoWindowRenderer(InfoWindowRenderer $infoWindowRenderer)
    {
        $this->infoWindowRenderer = $infoWindowRenderer;
    }

    /**
     * Gets the info box renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer The info box renderer.
     */
    public function getInfoBoxRenderer()
    {
        return $this->infoBoxRenderer;
    }

    /**
     * Sets the info box renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer $infoBoxRenderer The info box renderer.
     */
    public function setInfoBoxRenderer(InfoBoxRenderer $infoBoxRenderer)
    {
        $this->infoBoxRenderer = $infoBoxRenderer;
    }

    /**
     * Configures the map javascript info window api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        foreach ($apiEvent->getItems(ApiEvent::MAP) as $map) {
            foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
                if ($infoWindow->getType() === InfoWindowType::INFOBOX) {
                    $apiEvent->addSource($this->infoBoxRenderer->renderSource());
                }
            }
        }
    }

    /**
     * Renders the map javascript overlays info windows.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
            if ($infoWindow->getType() === InfoWindowType::INFOBOX) {
                $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                    $map,
                    $this->infoBoxRenderer->render($infoWindow),
                    'overlays.info_boxes',
                    $infoWindow
                ));
            } else {
                $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                    $map,
                    $this->infoWindowRenderer->render($infoWindow),
                    'overlays.info_windows',
                    $infoWindow
                ));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW         => 'onApi',
            MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW => 'onMap',
        );
    }
}
