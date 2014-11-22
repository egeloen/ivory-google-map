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

use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Dom event once subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator */
    private $domEventOnceAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer */
    private $domEventOnceRenderer;

    /**
     * Creates a dom event once subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                     $formatter              The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator|null $domEventOnceAggregator The dom event once aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer|null     $domEventOnceRenderer   The dom event once renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        DomEventOnceAggregator $domEventOnceAggregator = null,
        DomEventOnceRenderer $domEventOnceRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setDomEventOnceAggregator($domEventOnceAggregator ?: new DomEventOnceAggregator());
        $this->setDomEventOnceRenderer($domEventOnceRenderer ?: new DomEventOnceRenderer());
    }

    /**
     * Gets the dom event once aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator The dom event once aggregator.
     */
    public function getDomEventOnceAggregator()
    {
        return $this->domEventOnceAggregator;
    }

    /**
     * Sets the dom event once aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator $domEventOnceAggregator The dom event once aggregator.
     */
    public function setDomEventOnceAggregator(DomEventOnceAggregator $domEventOnceAggregator)
    {
        $this->domEventOnceAggregator = $domEventOnceAggregator;
    }

    /**
     * Gets the dom event once renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer The dom event once renderer.
     */
    public function getDomEventOnceRenderer()
    {
        return $this->domEventOnceRenderer;
    }

    /**
     * Sets the dom event once renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer $domEventOnceRenderer The dom event once renderer.
     */
    public function setDomEventOnceRenderer(DomEventOnceRenderer $domEventOnceRenderer)
    {
        $this->domEventOnceRenderer = $domEventOnceRenderer;
    }

    /**
     * Renders the map javascript events dom events once.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->domEventOnceAggregator->aggregate($map) as $domEventOnce) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->domEventOnceRenderer->render($domEventOnce),
                'events.dom_events_once',
                $domEventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE => 'onMap');
    }
}
