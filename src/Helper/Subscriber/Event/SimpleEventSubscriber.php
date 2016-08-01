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
    /**
     * @var EventCollector
     */
    private $eventCollector;

    /**
     * @var EventRenderer
     */
    private $eventRenderer;

    /**
     * @param Formatter      $formatter
     * @param EventCollector $eventCollector
     * @param EventRenderer  $eventRenderer
     */
    public function __construct(
        Formatter $formatter,
        EventCollector $eventCollector,
        EventRenderer $eventRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventCollector($eventCollector);
        $this->setEventRenderer($eventRenderer);
    }

    /**
     * @return EventCollector
     */
    public function getEventCollector()
    {
        return $this->eventCollector;
    }

    /**
     * @param EventCollector $eventCollector
     */
    public function setEventCollector(EventCollector $eventCollector)
    {
        $this->eventCollector = $eventCollector;
    }

    /**
     * @return EventRenderer
     */
    public function getEventRenderer()
    {
        return $this->eventRenderer;
    }

    /**
     * @param EventRenderer $eventRenderer
     */
    public function setEventRenderer(EventRenderer $eventRenderer)
    {
        $this->eventRenderer = $eventRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_EVENT_EVENT => 'handleMap'];
    }
}
