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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Marker shape subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator */
    private $markerShapeAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer */
    private $markerShapeRenderer;

    /**
     * Creates a marker shape subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                      $formatter             The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator|null $markerShapeAggregator The marker shape aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer|null     $markerShapeRenderer   The marker shape renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        MarkerShapeAggregator $markerShapeAggregator = null,
        MarkerShapeRenderer $markerShapeRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setMarkerShapeAggregator($markerShapeAggregator ?: new MarkerShapeAggregator());
        $this->setMarkerShapeRenderer($markerShapeRenderer ?: new MarkerShapeRenderer());
    }

    /**
     * Gets the marker shape aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator The marker shape aggregator.
     */
    public function getMarkerShapeAggregator()
    {
        return $this->markerShapeAggregator;
    }

    /**
     * Sets the marker shape aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator $markerShapeAggregator The marker shape aggregator.
     */
    public function setMarkerShapeAggregator(MarkerShapeAggregator $markerShapeAggregator)
    {
        $this->markerShapeAggregator = $markerShapeAggregator;
    }

    /**
     * Gets the marker shape renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer The marker shape renderer.
     */
    public function getMarkerShapeRenderer()
    {
        return $this->markerShapeRenderer;
    }

    /**
     * Sets the marker shape renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer $markerShapeRenderer The marker shape renderer.
     */
    public function setMarkerShapeRenderer(MarkerShapeRenderer $markerShapeRenderer)
    {
        $this->markerShapeRenderer = $markerShapeRenderer;
    }

    /**
     * Renders the map javascript overlays marker shapes.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->markerShapeAggregator->aggregate($map) as $markerShape) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->markerShapeRenderer->render($markerShape),
                'overlays.marker_shapes',
                $markerShape
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE => 'onMap');
    }
}
