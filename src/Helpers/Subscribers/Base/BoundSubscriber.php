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

use Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Bound subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer */
    private $boundRenderer;

    /**
     * Creates a bound subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null            $formatter       The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator|null $boundAggregator The bound aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer|null     $boundRenderer   The bound renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        BoundAggregator $boundAggregator = null,
        BoundRenderer $boundRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setBoundAggregator($boundAggregator ?: new BoundAggregator());
        $this->setBoundRenderer($boundRenderer ?: new BoundRenderer());
    }

    /**
     * Gets the bound aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator The bound aggregator.
     */
    public function getBoundAggregator()
    {
        return $this->boundAggregator;
    }

    /**
     * Sets the bound aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator $boundAggregator The bound aggregator.
     */
    public function setBoundAggregator(BoundAggregator $boundAggregator)
    {
        $this->boundAggregator = $boundAggregator;
    }

    /**
     * Gets the bound renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer The bound renderer.
     */
    public function getBoundRenderer()
    {
        return $this->boundRenderer;
    }

    /**
     * Sets the bound renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer $boundRenderer The bound renderer.
     */
    public function setBoundRenderer(BoundRenderer $boundRenderer)
    {
        $this->boundRenderer = $boundRenderer;
    }

    /**
     * Renders the map javascript base bounds.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->boundAggregator->aggregate($map) as $bound) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->boundRenderer->render($bound),
                'base.bounds',
                $bound
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_BASE_BOUND => 'onMap');
    }
}
