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

use Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Event once subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator */
    private $eventOnceAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer */
    private $eventOnceRenderer;

    /**
     * Creates an event once subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                  $formatter           The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator|null $eventOnceAggregator The event once aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer|null     $eventOnceRenderer   The event once renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        EventOnceAggregator $eventOnceAggregator = null,
        EventOnceRenderer $eventOnceRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setEventOnceAggregator($eventOnceAggregator ?: new EventOnceAggregator());
        $this->setEventOnceRenderer($eventOnceRenderer ?: new EventOnceRenderer());
    }

    /**
     * Gets the event once aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator The event once aggregator.
     */
    public function getEventOnceAggregator()
    {
        return $this->eventOnceAggregator;
    }

    /**
     * Sets the event once aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator $eventOnceAggregator The event once aggregator.
     */
    public function setEventOnceAggregator(EventOnceAggregator $eventOnceAggregator)
    {
        $this->eventOnceAggregator = $eventOnceAggregator;
    }

    /**
     * Gets the event once renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer The event once renderer.
     */
    public function getEventOnceRenderer()
    {
        return $this->eventOnceRenderer;
    }

    /**
     * Sets the event once renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer $eventOnceRenderer The event once renderer.
     */
    public function setEventOnceRenderer(EventOnceRenderer $eventOnceRenderer)
    {
        $this->eventOnceRenderer = $eventOnceRenderer;
    }

    /**
     * Renders the map javascript events events once.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->eventOnceAggregator->aggregate($map) as $eventOnce) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->eventOnceRenderer->render($eventOnce),
                'events.events_once',
                $eventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE => 'onMap');
    }
}
