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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Circle subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator */
    private $circleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer */
    private $circleRenderer;

    /**
     * Creates a circle subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter        The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator|null $circleAggregator The circle aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer|null     $circleRenderer   The circle renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        CircleAggregator $circleAggregator = null,
        CircleRenderer $circleRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setCircleAggregator($circleAggregator ?: new CircleAggregator());
        $this->setCircleRenderer($circleRenderer ?: new CircleRenderer());
    }

    /**
     * Gets the circle aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator The circle aggregator.
     */
    public function getCircleAggregator()
    {
        return $this->circleAggregator;
    }

    /**
     * Sets the circle aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator $circleAggregator The circle aggregator.
     */
    public function setCircleAggregator(CircleAggregator $circleAggregator)
    {
        $this->circleAggregator = $circleAggregator;
    }

    /**
     * Gets the circle renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer The circle renderer.
     */
    public function getCircleRenderer()
    {
        return $this->circleRenderer;
    }

    /**
     * Sets the circle renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer $circleRenderer The circle renderer.
     */
    public function setCircleRenderer(CircleRenderer $circleRenderer)
    {
        $this->circleRenderer = $circleRenderer;
    }

    /**
     * Renders the map javascript overlays circles.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->circleAggregator->aggregate($map) as $circle) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->circleRenderer->render($circle, $map),
                'overlays.circles',
                $circle
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE => 'onMap');
    }
}
