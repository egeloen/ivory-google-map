<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Event;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManager
{
    /**
     * @var Event[]
     */
    private array $domEvents = [];

    /**
     * @var Event[]
     */
    private array $domEventsOnce = [];

    /**
     * @var Event[]
     */
    private array $events = [];

    /**
     * @var Event[]
     */
    private array $eventsOnce = [];

    public function hasDomEvents(): bool
    {
        return !empty($this->domEvents);
    }

    /**
     * @return Event[]
     */
    public function getDomEvents(): array
    {
        return $this->domEvents;
    }

    /**
     * @param Event[] $domEvents
     */
    public function setDomEvents(array $domEvents): void
    {
        $this->domEvents = [];
        $this->addDomEvents($domEvents);
    }

    /**
     * @param Event[] $domEvents
     */
    public function addDomEvents(array $domEvents): void
    {
        foreach ($domEvents as $domEvent) {
            $this->addDomEvent($domEvent);
        }
    }

    public function hasDomEvent(Event $domEvent): bool
    {
        return in_array($domEvent, $this->domEvents, true);
    }

    public function addDomEvent(Event $domEvent): void
    {
        if (!$this->hasDomEvent($domEvent)) {
            $this->domEvents[] = $domEvent;
        }
    }

    public function removeDomEvent(Event $domEvent): void
    {
        unset($this->domEvents[array_search($domEvent, $this->domEvents, true)]);
        $this->domEvents = empty($this->domEvents) ? [] : array_values($this->domEvents);
    }

    public function hasDomEventsOnce(): bool
    {
        return !empty($this->domEventsOnce);
    }

    /**
     * @return Event[]
     */
    public function getDomEventsOnce(): array
    {
        return $this->domEventsOnce;
    }

    /**
     * @param Event[] $domEventsOnce
     */
    public function setDomEventsOnce(array $domEventsOnce): void
    {
        $this->domEventsOnce = [];
        $this->addDomEventsOnce($domEventsOnce);
    }

    /**
     * @param Event[] $domEventsOnce
     */
    public function addDomEventsOnce(array $domEventsOnce): void
    {
        foreach ($domEventsOnce as $domEventOnce) {
            $this->addDomEventOnce($domEventOnce);
        }
    }

    public function hasDomEventOnce(Event $domEventOnce): bool
    {
        return in_array($domEventOnce, $this->domEventsOnce, true);
    }

    public function addDomEventOnce(Event $domEventOnce): void
    {
        if (!$this->hasDomEventOnce($domEventOnce)) {
            $this->domEventsOnce[] = $domEventOnce;
        }
    }

    public function removeDomEventOnce(Event $domEventOnce): void
    {
        unset($this->domEventsOnce[array_search($domEventOnce, $this->domEventsOnce, true)]);
        $this->domEventsOnce = empty($this->domEventsOnce) ? [] : array_values($this->domEventsOnce);
    }

    public function hasEvents(): bool
    {
        return !empty($this->events);
    }

    /**
     * @return Event[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param Event[] $events
     */
    public function setEvents(array $events): void
    {
        $this->events = [];
        $this->addEvents($events);
    }

    /**
     * @param Event[] $events
     */
    public function addEvents(array $events): void
    {
        foreach ($events as $event) {
            $this->addEvent($event);
        }
    }

    public function hasEvent(Event $event): bool
    {
        return in_array($event, $this->events, true);
    }

    public function addEvent(Event $event): void
    {
        if (!$this->hasEvent($event)) {
            $this->events[] = $event;
        }
    }

    public function removeEvent(Event $event): void
    {
        unset($this->events[array_search($event, $this->events, true)]);
        $this->events = empty($this->events) ? [] : array_values($this->events);
    }

    public function hasEventsOnce(): bool
    {
        return !empty($this->eventsOnce);
    }

    /**
     * @return Event[]
     */
    public function getEventsOnce(): array
    {
        return $this->eventsOnce;
    }

    /**
     * @param Event[] $eventsOnce
     */
    public function setEventsOnce(array $eventsOnce): void
    {
        $this->eventsOnce = [];
        $this->addEventsOnce($eventsOnce);
    }

    /**
     * @param Event[] $eventsOnce
     */
    public function addEventsOnce(array $eventsOnce): void
    {
        foreach ($eventsOnce as $eventOnce) {
            $this->addEventOnce($eventOnce);
        }
    }

    public function hasEventOnce(Event $eventOnce): bool
    {
        return in_array($eventOnce, $this->eventsOnce, true);
    }

    public function addEventOnce(Event $eventOnce): void
    {
        $this->eventsOnce[] = $eventOnce;
    }

    public function removeEventOnce(Event $eventOnce): void
    {
        unset($this->eventsOnce[array_search($eventOnce, $this->eventsOnce, true)]);
        $this->eventsOnce = empty($this->eventsOnce) ? [] : array_values($this->eventsOnce);
    }
}
