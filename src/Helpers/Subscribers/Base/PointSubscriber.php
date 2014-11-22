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

use Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Point subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator */
    private $pointAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer */
    private $pointRenderer;

    /**
     * Creates a point subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null            $formatter       The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator|null $pointAggregator The point aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer|null     $pointRenderer   The point renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        PointAggregator $pointAggregator = null,
        PointRenderer $pointRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setPointAggregator($pointAggregator ?: new PointAggregator());
        $this->setPointRenderer($pointRenderer ?: new PointRenderer());
    }

    /**
     * Gets the point aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator The point aggregator.
     */
    public function getPointAggregator()
    {
        return $this->pointAggregator;
    }

    /**
     * Sets the point aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator $pointAggregator The point aggregator.
     */
    public function setPointAggregator(PointAggregator $pointAggregator)
    {
        $this->pointAggregator = $pointAggregator;
    }

    /**
     * Gets the point renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer The point renderer.
     */
    public function getPointRenderer()
    {
        return $this->pointRenderer;
    }

    /**
     * Sets the point renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer $pointRenderer The point renderer.
     */
    public function setPointRenderer(PointRenderer $pointRenderer)
    {
        $this->pointRenderer = $pointRenderer;
    }

    /**
     * Renders the map javascript base points.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->pointAggregator->aggregate($map) as $point) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->pointRenderer->render($point),
                'base.points',
                $point
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_BASE_POINT => 'onMap');
    }
}
