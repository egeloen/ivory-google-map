<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place\Event;

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteSimpleEventSubscriber extends AbstractSubscriber
{
    private ?AutocompleteEventCollector $eventCollector = null;

    private ?EventRenderer $eventRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteEventCollector $eventCollector,
        EventRenderer $eventRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventCollector($eventCollector);
        $this->setEventRenderer($eventRenderer);
    }

    public function getEventCollector(): AutocompleteEventCollector
    {
        return $this->eventCollector;
    }

    public function setEventCollector(AutocompleteEventCollector $eventCollector): void
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

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->eventCollector->collect($autocomplete) as $rawEvent) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->eventRenderer->render($rawEvent),
                'events.events',
                $rawEvent
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_EVENT => 'handleAutocomplete'];
    }
}
