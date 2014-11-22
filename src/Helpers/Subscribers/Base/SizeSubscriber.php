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

use Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Size subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator */
    private $sizeAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer */
    private $sizeRenderer;

    /**
     * Creates a size subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null           $formatter      The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator|null $sizeAggregator The size aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer|null     $sizeRenderer   The size renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        SizeAggregator $sizeAggregator = null,
        SizeRenderer $sizeRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setSizeAggregator($sizeAggregator ?: new SizeAggregator());
        $this->setSizeRenderer($sizeRenderer ?: new SizeRenderer());
    }

    /**
     * Gets the size aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator The size aggregator.
     */
    public function getSizeAggregator()
    {
        return $this->sizeAggregator;
    }

    /**
     * Sets the size aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator $sizeAggregator The size aggregator.
     */
    public function setSizeAggregator(SizeAggregator $sizeAggregator)
    {
        $this->sizeAggregator = $sizeAggregator;
    }

    /**
     * Gets the size renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer The size renderer.
     */
    public function getSizeRenderer()
    {
        return $this->sizeRenderer;
    }

    /**
     * Sets the size renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer $sizeRenderer The size renderer.
     */
    public function setSizeRenderer(SizeRenderer $sizeRenderer)
    {
        $this->sizeRenderer = $sizeRenderer;
    }

    /**
     * Renders the map javascript base sizes.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->sizeAggregator->aggregate($map) as $size) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->sizeRenderer->render($size),
                'base.sizes',
                $size
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_BASE_SIZE => 'onMap');
    }
}
