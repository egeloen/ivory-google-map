<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Events;

/**
 * Events.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class Events
{
    /** @var array */
    private $events = array();

    /** @var array */
    private $eventsOnce = array();

    /** @var array */
    private $domEvents = array();

    /** @var array */
    private $domEventsOnce = array();

    /**
     * Resets the events.
     */
    public function resetEvents()
    {
        $this->events = array();
    }

    /**
     * Checks if there are events.
     *
     * @return boolean TRUE if there are events else FALSE.
     */
    public function hasEvents()
    {
        return !empty($this->events);
    }

    /**
     * Gets the events.
     *
     * @return array The events.
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Sets the events.
     *
     * @param array $events The events.
     */
    public function setEvents(array $events)
    {
        $this->resetEvents();
        $this->addEvents($events);
    }

    /**
     * Adds the events.
     *
     * @param array $events The events.
     */
    public function addEvents(array $events)
    {
        foreach ($events as $event) {
            $this->addEvent($event);
        }
    }

    /**
     * Removes the events.
     *
     * @param array $events The events.
     */
    public function removeEvents(array $events)
    {
        foreach ($events as $event) {
            $this->removeEvent($event);
        }
    }

    /**
     * Checks if there is an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     *
     * @return boolean TRUE if there is the event else FALSE.
     */
    public function hasEvent(Event $event)
    {
        return in_array($event, $this->events, true);
    }

    /**
     * Adds an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     */
    public function addEvent(Event $event)
    {
        if (!$this->hasEvent($event)) {
            $this->events[] = $event;
        }
    }

    /**
     * Removes an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     */
    public function removeEvent(Event $event)
    {
        unset($this->events[array_search($event, $this->events, true)]);
    }

    /**
     * Resets the events once.
     */
    public function resetEventsOnce()
    {
        $this->eventsOnce = array();
    }

    /**
     * Checks if there are events once.
     *
     * @return boolean TRUE if there are events once else FALSE.
     */
    public function hasEventsOnce()
    {
        return !empty($this->eventsOnce);
    }

    /**
     * Gets the events once.
     *
     * @return array The events once.
     */
    public function getEventsOnce()
    {
        return $this->eventsOnce;
    }

    /**
     * Sets the events once.
     *
     * @param array $eventsOnce The events once.
     */
    public function setEventsOnce(array $eventsOnce)
    {
        $this->resetEventsOnce();
        $this->addEventsOnce($eventsOnce);
    }

    /**
     * Adds the events once.
     *
     * @param array $eventsOnce The events once.
     */
    public function addEventsOnce(array $eventsOnce)
    {
        foreach ($eventsOnce as $eventOnce) {
            $this->addEventOnce($eventOnce);
        }
    }

    /**
     * Removes the events once.
     *
     * @param array $eventsOnce The events once.
     */
    public function removeEventsOnce(array $eventsOnce)
    {
        foreach ($eventsOnce as $eventOnce) {
            $this->removeEventOnce($eventOnce);
        }
    }

    /**
     * Checks if there is an event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     *
     * @return boolean TRUE if there is the dom event once else FALSE.
     */
    public function hasEventOnce(Event $eventOnce)
    {
        return in_array($eventOnce, $this->eventsOnce, true);
    }

    /**
     * Adds an event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     */
    public function addEventOnce(Event $eventOnce)
    {
        if (!$this->hasEventOnce($eventOnce)) {
            $this->eventsOnce[] = $eventOnce;
        }
    }

    /**
     * Removes an event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     */
    public function removeEventOnce(Event $eventOnce)
    {
        unset($this->eventsOnce[array_search($eventOnce, $this->eventsOnce, true)]);
    }

    /**
     * Resets the dom events.
     */
    public function resetDomEvents()
    {
        $this->domEvents = array();
    }

    /**
     * Checks if there are dom events.
     *
     * @return boolean TRUE if there are dom events else FALSE.
     */
    public function hasDomEvents()
    {
        return !empty($this->domEvents);
    }

    /**
     * Gets the dom events.
     *
     * @return array The dom events.
     */
    public function getDomEvents()
    {
        return $this->domEvents;
    }

    /**
     * Sets the dom events.
     *
     * @param array $domEvents The dom events.
     */
    public function setDomEvents(array $domEvents)
    {
        $this->resetDomEvents();
        $this->addDomEvents($domEvents);
    }

    /**
     * Adds the dom events.
     *
     * @param array $domEvents The dom events.
     */
    public function addDomEvents(array $domEvents)
    {
        foreach ($domEvents as $domEvent) {
            $this->addDomEvent($domEvent);
        }
    }

    /**
     * Removes the dom events.
     *
     * @param array $domEvents The dom events.
     */
    public function removeDomEvents(array $domEvents)
    {
        foreach ($domEvents as $domEvent) {
            $this->removeDomEvent($domEvent);
        }
    }

    /**
     * Checks if there is a dom event.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     *
     * @return boolean TRUE if there is the dom event else FALSE.
     */
    public function hasDomEvent(DomEvent $domEvent)
    {
        return in_array($domEvent, $this->domEvents, true);
    }

    /**
     * Adds a dom event.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     */
    public function addDomEvent(DomEvent $domEvent)
    {
        if (!$this->hasDomEvent($domEvent)) {
            $this->domEvents[] = $domEvent;
        }
    }

    /**
     * Removes a dom event.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     */
    public function removeDomEvent(DomEvent $domEvent)
    {
        unset($this->domEvents[array_search($domEvent, $this->domEvents, true)]);
    }

    /**
     * Resets the dom events once.
     */
    public function resetDomEventsOnce()
    {
        $this->domEventsOnce = array();
    }

    /**
     * Checks if there are dom events once.
     *
     * @return boolean TRUE if there are dom events once else FALSE.
     */
    public function hasDomEventsOnce()
    {
        return !empty($this->domEventsOnce);
    }

    /**
     * Gets the dom events once.
     *
     * @return array The dom events once.
     */
    public function getDomEventsOnce()
    {
        return $this->domEventsOnce;
    }

    /**
     * Sets the dom events once.
     *
     * @param array $domEventsOnce The dom events once.
     */
    public function setDomEventsOnce(array $domEventsOnce)
    {
        $this->resetDomEventsOnce();
        $this->addDomEventsOnce($domEventsOnce);
    }

    /**
     * Adds the dom events once.
     *
     * @param array $domEventsOnce The dom events once.
     */
    public function addDomEventsOnce(array $domEventsOnce)
    {
        foreach ($domEventsOnce as $domEventOnce) {
            $this->addDomEventOnce($domEventOnce);
        }
    }

    /**
     * Removes the dom events once.
     *
     * @param array $domEventsOnce The dom events once.
     */
    public function removeDomEventsOnce(array $domEventsOnce)
    {
        foreach ($domEventsOnce as $domEventOnce) {
            $this->removeDomEventOnce($domEventOnce);
        }
    }

    /**
     * Checks if there is a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEventOnce The dom event once.
     *
     * @return boolean TRUE if there is the dom event once else FALSE.
     */
    public function hasDomEventOnce(DomEvent $domEventOnce)
    {
        return in_array($domEventOnce, $this->domEventsOnce, true);
    }

    /**
     * Adds a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEventOnce A dom event once.
     */
    public function addDomEventOnce(DomEvent $domEventOnce)
    {
        if (!$this->hasDomEventOnce($domEventOnce)) {
            $this->domEventsOnce[] = $domEventOnce;
        }
    }

    /**
     * Removes a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEventOnce The dom event once.
     */
    public function removeDomEventOnce(DomEvent $domEventOnce)
    {
        unset($this->domEventsOnce[array_search($domEventOnce, $this->domEventsOnce, true)]);
    }
}
