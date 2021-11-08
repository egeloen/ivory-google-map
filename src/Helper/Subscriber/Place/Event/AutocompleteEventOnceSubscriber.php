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

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventOnceCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteEventOnceSubscriber extends AbstractSubscriber
{
    private ?AutocompleteEventOnceCollector $eventOnceCollector = null;

    private ?EventOnceRenderer $eventOnceRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteEventOnceCollector $eventOnceCollector,
        EventOnceRenderer $eventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventOnceCollector($eventOnceCollector);
        $this->setEventOnceRenderer($eventOnceRenderer);
    }

    public function getEventOnceCollector(): AutocompleteEventOnceCollector
    {
        return $this->eventOnceCollector;
    }

    public function setEventOnceCollector(AutocompleteEventOnceCollector $eventOnceCollector): void
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

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->eventOnceCollector->collect($autocomplete) as $eventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->eventOnceRenderer->render($eventOnce),
                'events.events_once',
                $eventOnce
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_EVENT_ONCE => 'handleAutocomplete'];
    }
}
