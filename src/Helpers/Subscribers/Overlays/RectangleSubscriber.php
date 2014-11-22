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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Rectangle subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator */
    private $rectangleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer */
    private $rectangleRenderer;

    /**
     * Creates a rectangle subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                    $formatter           The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator|null $rectangleAggregator The rectangle aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer|null     $rectangleRenderer   The rectangle renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        RectangleAggregator $rectangleAggregator = null,
        RectangleRenderer $rectangleRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setRectangleAggregator($rectangleAggregator ?: new RectangleAggregator());
        $this->setRectangleRenderer($rectangleRenderer ?: new RectangleRenderer());
    }

    /**
     * Gets the rectangle aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator The rectangle aggregator.
     */
    public function getRectangleAggregator()
    {
        return $this->rectangleAggregator;
    }

    /**
     * Sets the rectangle aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator $rectangleAggregator The rectangle aggregator.
     */
    public function setRectangleAggregator(RectangleAggregator $rectangleAggregator)
    {
        $this->rectangleAggregator = $rectangleAggregator;
    }

    /**
     * Gets the rectangle renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer The rectangle renderer.
     */
    public function getRectangleRenderer()
    {
        return $this->rectangleRenderer;
    }

    /**
     * Sets the rectangle renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer $rectangleRenderer The rectangle renderer.
     */
    public function setRectangleRenderer(RectangleRenderer $rectangleRenderer)
    {
        $this->rectangleRenderer = $rectangleRenderer;
    }

    /**
     * Renders the map javascript overlays rectangles.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->rectangleAggregator->aggregate($map) as $rectangle) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->rectangleRenderer->render($rectangle, $map),
                'overlays.rectangles',
                $rectangle
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE => 'onMap');
    }
}
