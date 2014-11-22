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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Extendable subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator */
    private $extendableAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer */
    private $extendableRenderer;

    /**
     * Creates an extendable subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                     $formatter            The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator|null $extendableAggregator The extendable aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer|null     $extendableRenderer   The extendable renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        ExtendableAggregator $extendableAggregator = null,
        ExtendableRenderer $extendableRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setExtendableAggregator($extendableAggregator ?: new ExtendableAggregator());
        $this->setExtendableRenderer($extendableRenderer ?: new ExtendableRenderer());
    }

    /**
     * Gets the extendable aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator The extendable aggregator.
     */
    public function getExtendableAggregator()
    {
        return $this->extendableAggregator;
    }

    /**
     * Sets the extendable aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator $extendableAggregator The extendable aggregator.
     */
    public function setExtendableAggregator(ExtendableAggregator $extendableAggregator)
    {
        $this->extendableAggregator = $extendableAggregator;
    }

    /**
     * Gets the extendable renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer The extendable renderer.
     */
    public function getExtendableRenderer()
    {
        return $this->extendableRenderer;
    }

    /**
     * Sets the extendable renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer $extendableRenderer The extendable renderer.
     */
    public function setExtendableRenderer(ExtendableRenderer $extendableRenderer)
    {
        $this->extendableRenderer = $extendableRenderer;
    }

    /**
     * Renders the map javascript extends.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->extendableAggregator->aggregate($map) as $extend) {
            $mapEvent->addCode($this->getFormatter()->formatCode(
                $this->extendableRenderer->render($extend, $map->getBound())
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH_EXTENDABLE => 'onMap');
    }
}
