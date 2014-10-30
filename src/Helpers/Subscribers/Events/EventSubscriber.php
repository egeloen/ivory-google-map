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

use Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Event subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator */
    private $eventAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer */
    private $eventRenderer;

    /**
     * Creates a event subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null              $formatter       The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator|null $eventAggregator The event aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer|null     $eventRenderer   The event renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        EventAggregator $eventAggregator = null,
        EventRenderer $eventRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setEventAggregator($eventAggregator ?: new EventAggregator());
        $this->setEventRenderer($eventRenderer ?: new EventRenderer());
    }

    /**
     * Gets the event aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator The event aggregator.
     */
    public function getEventAggregator()
    {
        return $this->eventAggregator;
    }

    /**
     * Sets the event aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator $eventAggregator The event aggregator.
     */
    public function setEventAggregator(EventAggregator $eventAggregator)
    {
        $this->eventAggregator = $eventAggregator;
    }

    /**
     * Gets the event renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer The event renderer.
     */
    public function getEventRenderer()
    {
        return $this->eventRenderer;
    }

    /**
     * Sets the event renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer $eventRenderer The event renderer.
     */
    public function setEventRenderer(EventRenderer $eventRenderer)
    {
        $this->eventRenderer = $eventRenderer;
    }

    /**
     * Renders the map javascript events events.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->eventAggregator->aggregate($map) as $event) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->eventRenderer->render($event),
                'events.events',
                $event
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_EVENTS_EVENT => 'onMap');
    }
}
