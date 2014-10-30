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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Polyline subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator */
    private $polylineAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer */
    private $polylineRenderer;

    /**
     * Creates a polyline subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                   $formatter          The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator|null $polylineAggregator The polyline aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer|null     $polylineRenderer   The polyline renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        PolylineAggregator $polylineAggregator = null,
        PolylineRenderer $polylineRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setPolylineAggregator($polylineAggregator ?: new PolylineAggregator());
        $this->setPolylineRenderer($polylineRenderer ?: new PolylineRenderer());
    }

    /**
     * Gets the polyline aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator The polyline aggregator.
     */
    public function getPolylineAggregator()
    {
        return $this->polylineAggregator;
    }

    /**
     * Sets the polyline aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator $polylineAggregator The polyline aggregator.
     */
    public function setPolylineAggregator(PolylineAggregator $polylineAggregator)
    {
        $this->polylineAggregator = $polylineAggregator;
    }

    /**
     * Gets the polyline renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer The polyline renderer.
     */
    public function getPolylineRenderer()
    {
        return $this->polylineRenderer;
    }

    /**
     * Sets the polyline renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer $polylineRenderer The polyline renderer.
     */
    public function setPolylineRenderer(PolylineRenderer $polylineRenderer)
    {
        $this->polylineRenderer = $polylineRenderer;
    }

    /**
     * Renders the map javascript overlays polylines.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->polylineAggregator->aggregate($map) as $polyline) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
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
        return array(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE => 'onMap');
    }
}
