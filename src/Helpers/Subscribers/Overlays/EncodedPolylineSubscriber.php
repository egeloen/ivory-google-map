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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator;
use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Encoded polyline subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator */
    private $encodedPolylineAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer */
    private $encodedPolylineRenderer;

    /**
     * Creates an encoded polyline subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                          $formatter                 The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator|null $encodedPolylineAggregator The encoded polyline aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer|null     $encodedPolylineRenderer   The encoded polyline renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        EncodedPolylineAggregator $encodedPolylineAggregator = null,
        EncodedPolylineRenderer $encodedPolylineRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setEncodedPolylineAggregator($encodedPolylineAggregator ?: new EncodedPolylineAggregator());
        $this->setEncodedPolylineRenderer($encodedPolylineRenderer ?: new EncodedPolylineRenderer());
    }

    /**
     * Gets the encoded polyline aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator The encoded polyline aggregator.
     */
    public function getEncodedPolylineAggregator()
    {
        return $this->encodedPolylineAggregator;
    }

    /**
     * Sets the encoded polyline aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator $encodedPolylineAggregator The encoded polyline aggregator.
     */
    public function setEncodedPolylineAggregator(EncodedPolylineAggregator $encodedPolylineAggregator)
    {
        $this->encodedPolylineAggregator = $encodedPolylineAggregator;
    }

    /**
     * Gets the encoded polyline renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer The encoded polyline renderer.
     */
    public function getEncodedPolylineRenderer()
    {
        return $this->encodedPolylineRenderer;
    }

    /**
     * Sets the encoded polyline renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer $encodedPolylineRenderer The encoded polyline renderer.
     */
    public function setEncodedPolylineRenderer(EncodedPolylineRenderer $encodedPolylineRenderer)
    {
        $this->encodedPolylineRenderer = $encodedPolylineRenderer;
    }

    /**
     * Configures the map javascript encoded polyline api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        foreach ($apiEvent->getItems(ApiEvent::MAP) as $map) {
            $encodedPolylines = $this->encodedPolylineAggregator->aggregate($map);

            if (!empty($encodedPolylines)) {
                $apiEvent->addLibrary('geometry');
            }
        }
    }

    /**
     * Renders the map javascript overlays encoded polylines.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->encodedPolylineAggregator->aggregate($map) as $encodedPolyline) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->encodedPolylineRenderer->render($encodedPolyline, $map),
                'overlays.encoded_polylines',
                $encodedPolyline
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE      => 'onApi',
            MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE => 'onMap',
        );
    }
}
