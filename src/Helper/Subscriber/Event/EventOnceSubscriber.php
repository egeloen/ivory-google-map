<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Event;

use Ivory\GoogleMap\Helper\Collector\Event\EventOnceCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceSubscriber extends AbstractSubscriber
{
    /**
     * @var EventOnceCollector
     */
    private $eventOnceCollector;

    /**
     * @var EventOnceRenderer
     */
    private $eventOnceRenderer;

    /**
     * @param Formatter          $formatter
     * @param EventOnceCollector $eventOnceCollector
     * @param EventOnceRenderer  $eventOnceRenderer
     */
    public function __construct(
        Formatter $formatter,
        EventOnceCollector $eventOnceCollector,
        EventOnceRenderer $eventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventOnceCollector($eventOnceCollector);
        $this->setEventOnceRenderer($eventOnceRenderer);
    }

    /**
     * @return EventOnceCollector
     */
    public function getEventOnceCollector()
    {
        return $this->eventOnceCollector;
    }

    /**
     * @param EventOnceCollector $eventOnceCollector
     */
    public function setEventOnceCollector(EventOnceCollector $eventOnceCollector)
    {
        $this->eventOnceCollector = $eventOnceCollector;
    }

    /**
     * @return EventOnceRenderer
     */
    public function getEventOnceRenderer()
    {
        return $this->eventOnceRenderer;
    }

    /**
     * @param EventOnceRenderer $eventOnceRenderer
     */
    public function setEventOnceRenderer(EventOnceRenderer $eventOnceRenderer)
    {
        $this->eventOnceRenderer = $eventOnceRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->eventOnceCollector->collect($map) as $eventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
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
        return [MapEvents::JAVASCRIPT_EVENT_EVENT_ONCE => 'handleMap'];
    }
}
