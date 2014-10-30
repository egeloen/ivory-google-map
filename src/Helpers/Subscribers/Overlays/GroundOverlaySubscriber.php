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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Ground overlay subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlaySubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator */
    private $groundOverlayAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer */
    private $groundOverlayRenderer;

    /**
     * Creates a ground overlay subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                        $formatter               The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator|null $groundOverlayAggregator The ground overlay aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer|null     $groundOverlayRenderer   The ground overlay renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        GroundOverlayAggregator $groundOverlayAggregator = null,
        GroundOverlayRenderer $groundOverlayRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setGroundOverlayAggregator($groundOverlayAggregator ?: new GroundOverlayAggregator());
        $this->setGroundOverlayRenderer($groundOverlayRenderer ?: new GroundOverlayRenderer());
    }

    /**
     * Gets the ground overlay aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator The ground overlay aggregator.
     */
    public function getGroundOverlayAggregator()
    {
        return $this->groundOverlayAggregator;
    }

    /**
     * Sets the ground overlay aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator $groundOverlayAggregator The ground overlay aggregator.
     */
    public function setGroundOverlayAggregator(GroundOverlayAggregator $groundOverlayAggregator)
    {
        $this->groundOverlayAggregator = $groundOverlayAggregator;
    }

    /**
     * Gets the ground overlay renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer The ground overlay renderer.
     */
    public function getGroundOverlayRenderer()
    {
        return $this->groundOverlayRenderer;
    }

    /**
     * Sets the ground overlay renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer $groundOverlayRenderer The ground overlay renderer.
     */
    public function setGroundOverlayRenderer(GroundOverlayRenderer $groundOverlayRenderer)
    {
        $this->groundOverlayRenderer = $groundOverlayRenderer;
    }

    /**
     * Renders the map javascript overlays ground overlays.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->groundOverlayAggregator->aggregate($map) as $groundOverlay) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->groundOverlayRenderer->render($groundOverlay, $map),
                'overlays.ground_overlays',
                $groundOverlay
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY => 'onMap');
    }
}
