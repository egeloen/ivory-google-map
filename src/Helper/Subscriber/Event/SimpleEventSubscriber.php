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

use Ivory\GoogleMap\Helper\Collector\Event\EventCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SimpleEventSubscriber extends AbstractSubscriber
{
    private ?EventCollector $eventCollector = null;

    private ?EventRenderer $eventRenderer = null;

    public function __construct(
        Formatter $formatter,
        EventCollector $eventCollector,
        EventRenderer $eventRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventCollector($eventCollector);
        $this->setEventRenderer($eventRenderer);
    }

    public function getEventCollector(): EventCollector
    {
        return $this->eventCollector;
    }

    public function setEventCollector(EventCollector $eventCollector): void
    {
        $this->eventCollector = $eventCollector;
    }

    public function getEventRenderer(): EventRenderer
    {
        return $this->eventRenderer;
    }

    public function setEventRenderer(EventRenderer $eventRenderer): void
    {
        $this->eventRenderer = $eventRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->eventCollector->collect($map) as $rawEvent) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->eventRenderer->render($rawEvent),
                'events.events',
                $rawEvent
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_EVENT_EVENT => 'handleMap'];
    }
}
