<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Events;

use Ivory\GoogleMap\Events\Events;

/**
 * Events test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventsTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Events\Events */
    private $events;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->events = new Events();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->events);
    }

    public function testDefaultState()
    {
        $this->assertNoEvents();
        $this->assertNoEventsOnce();
        $this->assertNoDomEvents();
        $this->assertNoDomEventsOnce();
    }

    public function testSetEvents()
    {
        $this->events->setEvents($events = array($this->createEventMock()));

        $this->assertEvents($events);
    }

    public function testAddEvents()
    {
        $this->events->setEvents($events = array($this->createEventMock()));
        $this->events->addEvents($newEvents = array($this->createEventMock()));

        $this->assertEvents(array_merge($events, $newEvents));
    }

    public function testRemoveEvents()
    {
        $this->events->setEvents($events = array($this->createEventMock()));
        $this->events->removeEvents($events);

        $this->assertNoEvents();
    }

    public function testResetEvents()
    {
        $this->events->setEvents(array($this->createEventMock()));
        $this->events->resetEvents();

        $this->assertNoEvents();
    }

    public function testAddEvent()
    {
        $this->events->addEvent($event = $this->createEventMock());

        $this->assertEvent($event);
    }

    public function testAddEventUnicity()
    {
        $this->events->resetEvents();
        $this->events->addEvent($event = $this->createEventMock());
        $this->events->addEvent($event);

        $this->assertEvents(array($event));
    }

    public function testRemoveEvent()
    {
        $this->events->addEvent($event = $this->createEventMock());
        $this->events->removeEvent($event);

        $this->assertNoEvent($event);
    }

    public function testSetEventsOnce()
    {
        $this->events->setEventsOnce($eventsOnce = array($this->createEventMock()));

        $this->assertEventsOnce($eventsOnce);
    }

    public function testAddEventsOnce()
    {
        $this->events->setEventsOnce($eventsOnce = array($this->createEventMock()));
        $this->events->addEventsOnce($newEventsOnce = array($this->createEventMock()));

        $this->assertEventsOnce(array_merge($eventsOnce, $newEventsOnce));
    }

    public function testRemoveEventsOnce()
    {
        $this->events->setEventsOnce($eventsOnce = array($this->createEventMock()));
        $this->events->removeEventsOnce($eventsOnce);

        $this->assertNoEventsOnce();
    }

    public function testResetEventsOnce()
    {
        $this->events->setEventsOnce(array($this->createEventMock()));
        $this->events->resetEventsOnce();

        $this->assertNoEventsOnce();
    }

    public function testAddEventOnce()
    {
        $this->events->addEventOnce($eventOnce = $this->createEventMock());

        $this->assertEventOnce($eventOnce);
    }

    public function testAddEventOnceUnicity()
    {
        $this->events->resetEventsOnce();
        $this->events->addEventOnce($eventOnce = $this->createEventMock());
        $this->events->addEventOnce($eventOnce);

        $this->assertEventsOnce(array($eventOnce));
    }

    public function testRemoveEventOnce()
    {
        $this->events->addEventOnce($eventOnce = $this->createEventMock());
        $this->events->removeEventOnce($eventOnce);

        $this->assertNoEventOnce($eventOnce);
    }

    public function testSetDomEvents()
    {
        $this->events->setDomEvents($domEvents = array($this->createDomEventMock()));

        $this->assertDomEvents($domEvents);
    }

    public function testAddDomEvents()
    {
        $this->events->setDomEvents($domEvents = array($this->createDomEventMock()));
        $this->events->addDomEvents($newDomEvents = array($this->createDomEventMock()));

        $this->assertDomEvents(array_merge($domEvents, $newDomEvents));
    }

    public function testRemoveDomEvents()
    {
        $this->events->setDomEvents($domEvents = array($this->createDomEventMock()));
        $this->events->removeDomEvents($domEvents);

        $this->assertNoDomEvents();
    }

    public function testResetDomEvents()
    {
        $this->events->setDomEvents(array($this->createDomEventMock()));
        $this->events->resetDomEvents();

        $this->assertNoDomEvents();
    }

    public function testAddDomEvent()
    {
        $this->events->addDomEvent($domEvent = $this->createDomEventMock());

        $this->assertDomEvent($domEvent);
    }

    public function testAddDomEventUnicity()
    {
        $this->events->resetDomEvents();
        $this->events->addDomEvent($domEvent = $this->createDomEventMock());
        $this->events->addDomEvent($domEvent);

        $this->assertDomEvents(array($domEvent));
    }

    public function testRemoveDomEvent()
    {
        $this->events->addDomEvent($domEvent = $this->createDomEventMock());
        $this->events->removeDomEvent($domEvent);

        $this->assertNoDomEvent($domEvent);
    }

    public function testSetDomEventsOnce()
    {
        $this->events->setDomEventsOnce($domEventsOnce = array($this->createDomEventMock()));

        $this->assertDomEventsOnce($domEventsOnce);
    }

    public function testAddDomEventsOnce()
    {
        $this->events->setDomEventsOnce($domEventsOnce = array($this->createDomEventMock()));
        $this->events->addDomEventsOnce($newDomEventsOnce = array($this->createDomEventMock()));

        $this->assertDomEventsOnce(array_merge($domEventsOnce, $newDomEventsOnce));
    }

    public function testRemoveDomEventsOnce()
    {
        $this->events->setDomEventsOnce($domEventsOnce = array($this->createDomEventMock()));
        $this->events->removeDomEventsOnce($domEventsOnce);

        $this->assertNoDomEventsOnce();
    }

    public function testResetDomEventsOnce()
    {
        $this->events->setDomEventsOnce(array($this->createDomEventMock()));
        $this->events->resetDomEventsOnce();

        $this->assertNoDomEventsOnce();
    }

    public function testAddDomEventOnce()
    {
        $this->events->addDomEventOnce($domEventOnce = $this->createDomEventMock());

        $this->assertDomEventOnce($domEventOnce);
    }

    public function testAddDomEventOnceUnicity()
    {
        $this->events->resetDomEventsOnce();
        $this->events->addDomEventOnce($domEventOnce = $this->createDomEventMock());
        $this->events->addDomEventOnce($domEventOnce);

        $this->assertDomEventsOnce(array($domEventOnce));
    }

    public function testRemoveDomEventOnce()
    {
        $this->events->addDomEventOnce($domEventOnce = $this->createDomEventMock());
        $this->events->removeDomEventOnce($domEventOnce);

        $this->assertNoDomEventOnce($domEventOnce);
    }

    /**
     * Asserts there are no events.
     */
    private function assertNoEvents()
    {
        $this->assertFalse($this->events->hasEvents());
        $this->assertEmpty($this->events->getEvents());
    }

    /**
     * Asserts there is no event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     */
    private function assertNoEvent($event)
    {
        $this->assertEventInstance($event);
        $this->assertFalse($this->events->hasEvent($event));
    }

    /**
     * Asserts there are no events once.
     */
    private function assertNoEventsOnce()
    {
        $this->assertFalse($this->events->hasEventsOnce());
        $this->assertEmpty($this->events->getEventsOnce());
    }

    /**
     * Asserts there is no event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     */
    private function assertNoEventOnce($eventOnce)
    {
        $this->assertEventInstance($eventOnce);
        $this->assertFalse($this->events->hasEventOnce($eventOnce));
    }

    /**
     * Asserts there are no dom events.
     */
    private function assertNoDomEvents()
    {
        $this->assertFalse($this->events->hasDomEvents());
        $this->assertEmpty($this->events->getDomEvents());
    }

    /**
     * Asserts there is no dom event.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     */
    private function assertNoDomEvent($domEvent)
    {
        $this->assertDomEventInstance($domEvent);
        $this->assertFalse($this->events->hasDomEvent($domEvent));
    }

    /**
     * Asserts there are no dom events once.
     */
    private function assertNoDomEventsOnce()
    {
        $this->assertFalse($this->events->hasDomEventsOnce());
        $this->assertEmpty($this->events->getDomEventsOnce());
    }

    /**
     * Asserts there is no dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEventOnce The dom event once.
     */
    private function assertNoDomEventOnce($domEventOnce)
    {
        $this->assertDomEventInstance($domEventOnce);
        $this->assertFalse($this->events->hasDomEventOnce($domEventOnce));
    }

    /**
     * Asserts there are events.
     *
     * @param array $events The events.
     */
    private function assertEvents($events)
    {
        $this->assertInternalType('array', $events);

        $this->assertTrue($this->events->hasEvents());
        $this->assertSame($events, $this->events->getEvents());

        foreach ($events as $event) {
            $this->assertEvent($event);
        }
    }

    /**
     * Asserts there is an event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     */
    private function assertEvent($event)
    {
        $this->assertEventInstance($event);
        $this->assertTrue($this->events->hasEvent($event));
    }

    /**
     * Asserts there are dom events once.
     *
     * @param array $eventsOnce The events once.
     */
    private function assertEventsOnce($eventsOnce)
    {
        $this->assertInternalType('array', $eventsOnce);

        $this->assertTrue($this->events->hasEventsOnce());
        $this->assertSame($eventsOnce, $this->events->getEventsOnce());

        foreach ($eventsOnce as $eventOnce) {
            $this->assertEventOnce($eventOnce);
        }
    }

    /**
     * Asserts there is an event once.
     *
     * @param \Ivory\GoogleMap\Events\Event $eventOnce The event once.
     */
    private function assertEventOnce($eventOnce)
    {
        $this->assertEventInstance($eventOnce);
        $this->assertTrue($this->events->hasEventOnce($eventOnce));
    }

    /**
     * Asserts there are dom events.
     *
     * @param array $domEvents The dom events.
     */
    private function assertDomEvents($domEvents)
    {
        $this->assertInternalType('array', $domEvents);

        $this->assertTrue($this->events->hasDomEvents());
        $this->assertSame($domEvents, $this->events->getDomEvents());

        foreach ($domEvents as $domEvent) {
            $this->assertDomEvent($domEvent);
        }
    }

    /**
     * Asserts there is a dom event.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     */
    private function assertDomEvent($domEvent)
    {
        $this->assertDomEventInstance($domEvent);
        $this->assertTrue($this->events->hasDomEvent($domEvent));
    }

    /**
     * Asserts there are dom events once.
     *
     * @param array $domEventsOnce The dom events once.
     */
    private function assertDomEventsOnce($domEventsOnce)
    {
        $this->assertInternalType('array', $domEventsOnce);

        $this->assertTrue($this->events->hasDomEventsOnce());
        $this->assertSame($domEventsOnce, $this->events->getDomEventsOnce());

        foreach ($domEventsOnce as $domEventOnce) {
            $this->assertDomEventOnce($domEventOnce);
        }
    }

    /**
     * Asserts there is a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEventOnce The dom event once.
     */
    private function assertDomEventOnce($domEventOnce)
    {
        $this->assertDomEventInstance($domEventOnce);
        $this->assertTrue($this->events->hasDomEventOnce($domEventOnce));
    }
}
