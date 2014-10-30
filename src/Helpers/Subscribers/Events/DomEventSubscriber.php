<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Events;

use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Dom event subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator */
    private $domEventAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer */
    private $domEventRenderer;

    /**
     * Creates a dom event subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter          The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator|null $domEventAggregator The dom event aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer|null     $domEventRenderer   The dom event renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        DomEventAggregator $domEventAggregator = null,
        DomEventRenderer $domEventRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setDomEventAggregator($domEventAggregator ?: new DomEventAggregator());
        $this->setDomEventRenderer($domEventRenderer ?: new DomEventRenderer());
    }

    /**
     * Gets the dom event aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator The dom event aggregator.
     */
    public function getDomEventAggregator()
    {
        return $this->domEventAggregator;
    }

    /**
     * Sets the dom event aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator $domEventAggregator The dom event aggregator.
     */
    public function setDomEventAggregator(DomEventAggregator $domEventAggregator)
    {
        $this->domEventAggregator = $domEventAggregator;
    }

    /**
     * Gets the dom event renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer The dom event renderer.
     */
    public function getDomEventRenderer()
    {
        return $this->domEventRenderer;
    }

    /**
     * Sets the dom event renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer $domEventRenderer The dom event renderer.
     */
    public function setDomEventRenderer(DomEventRenderer $domEventRenderer)
    {
        $this->domEventRenderer = $domEventRenderer;
    }

    /**
     * Renders the map javascript events dom events.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->domEventAggregator->aggregate($map) as $domEvent) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->domEventRenderer->render($domEvent),
                'events.dom_events',
                $domEvent
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT => 'onMap');
    }
}
