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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;
use Ivory\GoogleMap\Overlays\MarkerClusterType;

/**
 * Marker subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer */
    private $markerRenderer;

    /**
     * Creates a marker subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter        The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|null $markerAggregator The marker aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer|null     $markerRenderer   The marker renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        MarkerAggregator $markerAggregator = null,
        MarkerRenderer $markerRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setMarkerAggregator($markerAggregator ?: new MarkerAggregator());
        $this->setMarkerRenderer($markerRenderer ?: new MarkerRenderer());
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
     * Gets the marker renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer The marker renderer.
     */
    public function getMarkerRenderer()
    {
        return $this->markerRenderer;
    }

    /**
     * Sets the marker renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer $markerRenderer The marker renderer.
     */
    public function setMarkerRenderer(MarkerRenderer $markerRenderer)
    {
        $this->markerRenderer = $markerRenderer;
    }

    /**
     * Renders the map javascript overlays markers.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->markerRenderer->render(
                    $marker,
                    $map->getOverlays()->getMarkerCluster()->getType() === MarkerClusterType::DEFAULT_ ? $map : null
                ),
                'overlays.markers',
                $marker
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_MARKER => 'onMap');
    }
}
