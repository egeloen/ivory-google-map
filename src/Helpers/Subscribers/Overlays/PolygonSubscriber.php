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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Polygon subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator */
    private $polygonAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer */
    private $polygonRenderer;

    /**
     * Creates a polygon subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                  $formatter         The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator|null $polygonAggregator The polygon aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer|null     $polygonRenderer   The polygon renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        PolygonAggregator $polygonAggregator = null,
        PolygonRenderer $polygonRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setPolygonAggregator($polygonAggregator ?: new PolygonAggregator());
        $this->setPolygonRenderer($polygonRenderer ?: new PolygonRenderer());
    }

    /**
     * Gets the polygon aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator The polygon aggregator.
     */
    public function getPolygonAggregator()
    {
        return $this->polygonAggregator;
    }

    /**
     * Sets the polygon aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator $polygonAggregator The polygon aggregator.
     */
    public function setPolygonAggregator(PolygonAggregator $polygonAggregator)
    {
        $this->polygonAggregator = $polygonAggregator;
    }

    /**
     * Gets the polygon renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer The polygon renderer.
     */
    public function getPolygonRenderer()
    {
        return $this->polygonRenderer;
    }

    /**
     * Sets the polygon renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer $polygonRenderer The polygon renderer.
     */
    public function setPolygonRenderer(PolygonRenderer $polygonRenderer)
    {
        $this->polygonRenderer = $polygonRenderer;
    }

    /**
     * Renders the map javascript overlays polygons.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->polygonAggregator->aggregate($map) as $polygon) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
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
        return array(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON => 'onMap');
    }
}
