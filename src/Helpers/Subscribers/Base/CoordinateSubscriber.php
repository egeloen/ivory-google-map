<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Base;

use Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Coordinate subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer */
    private $coordinateRenderer;

    /**
     * Creates a coordinate subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter            The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator|null $coordinateAggregator The coordinate aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer|null     $coordinateRenderer   The coordinate renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        CoordinateAggregator $coordinateAggregator = null,
        CoordinateRenderer $coordinateRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setCoordinateAggregator($coordinateAggregator ?: new CoordinateAggregator());
        $this->setCoordinateRenderer($coordinateRenderer ?: new CoordinateRenderer());
    }

    /**
     * Gets the coordinate aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator The coordinate aggregator.
     */
    public function getCoordinateAggregator()
    {
        return $this->coordinateAggregator;
    }

    /**
     * Sets the coordinate aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator $coordinateAggregator The coordinate aggregator.
     */
    public function setCoordinateAggregator(CoordinateAggregator $coordinateAggregator)
    {
        $this->coordinateAggregator = $coordinateAggregator;
    }

    /**
     * Gets the coordinate renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer The coordinate renderer.
     */
    public function getCoordinateRenderer()
    {
        return $this->coordinateRenderer;
    }

    /**
     * Sets the coordinate renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer $coordinateRenderer The coordinate renderer.
     */
    public function setCoordinateRenderer(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    /**
     * Renders the map javascript base coordinates.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->coordinateAggregator->aggregate($map) as $coordinate) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->coordinateRenderer->render($coordinate),
                'base.coordinates',
                $coordinate
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_BASE_COORDINATE => 'onMap');
    }
}
