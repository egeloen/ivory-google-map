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
 * Event manager which manages the google map event.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManager
{
    /** @var array */
    protected $domEvents;

    /** @var array */
    protected $domEventsOnce;

    /** @var array */
    protected $events;

    /** @var array */
    protected $eventsOnce;

    /**
     * Creates an event manager.
     *
     * @param array $domEvents     The dom events.Z
     * @param array $domEventsOnce The dom events which are triggered only one time.
     * @param array $events        The events.
     * @param array $eventsOnce    The events which are triggered only one time.
     */
    public function __construct(
        array $domEvents = array(),
        array $domEventsOnce = array(),
        array $events = array(),
        array $eventsOnce = array()
    ) {
        $this->domEvents = array();
        foreach ($domEvents as $domEvent) {
            $this->addDomEvent($domEvent);
        }

        $this->domEventsOnce = array();
        foreach ($domEventsOnce as $domEventOnce) {
            $this->addDomEventOnce($domEventOnce);
        }

        $this->events = array();
        foreach ($events as $event) {
            $this->addEvent($event);
        }

        $this->eventsOnce = array();
        foreach ($eventsOnce as $eventOnce) {
            $this->addEventOnce($eventOnce);
        }
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
     * Add a dom event.
     *
     * @param \Ivory\GoogleMap\Events\Event $domEvent The dom event.
     */
    public function addDomEvent(Event $domEvent)
    {
        $this->domEvents[] = $domEvent;
    }

    /**
     * Gets the dom events which are just triggered one time.
     *
     * @return array The dom events which are just triggered one time.
     */
    public function getDomEventsOnce()
    {
        return $this->domEventsOnce;
    }

    /**
     * Adds a dom event which is just triggered one time.
     *
     * @param \Ivory\GoogleMap\Events\Event $domEventOnce A dom event which is just triggered one time.
     */
    public function addDomEventOnce(Event $domEventOnce)
    {
        $this->domEventsOnce[] = $domEventOnce;
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
     * Adds an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event An event.
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Gets the events which are just triggered one time.
     *
     * @return array The events which are just triggered one time.
     */
    public function getEventsOnce()
    {
        return $this->eventsOnce;
    }

    /**
     * Adds an event which is just triggered one time.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce An event which is just triggered one time.
     */
    public function addEventOnce(Event $eventOnce)
    {
        $this->eventsOnce[] = $eventOnce;
    }
}
