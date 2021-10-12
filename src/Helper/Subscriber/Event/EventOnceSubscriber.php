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
    private ?EventOnceCollector $eventOnceCollector = null;

    private ?EventOnceRenderer $eventOnceRenderer = null;

    public function __construct(
        Formatter $formatter,
        EventOnceCollector $eventOnceCollector,
        EventOnceRenderer $eventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventOnceCollector($eventOnceCollector);
        $this->setEventOnceRenderer($eventOnceRenderer);
    }

    public function getEventOnceCollector(): EventOnceCollector
    {
        return $this->eventOnceCollector;
    }

    public function setEventOnceCollector(EventOnceCollector $eventOnceCollector): void
    {
        $this->eventOnceCollector = $eventOnceCollector;
    }

    public function getEventOnceRenderer(): EventOnceRenderer
    {
        return $this->eventOnceRenderer;
    }

    public function setEventOnceRenderer(EventOnceRenderer $eventOnceRenderer): void
    {
        $this->eventOnceRenderer = $eventOnceRenderer;
    }

    public function handleMap(MapEvent $event): void
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
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_EVENT_EVENT_ONCE => 'handleMap'];
    }
}
