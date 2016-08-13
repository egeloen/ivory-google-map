<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Event\EventManager;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventManager = new EventManager();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->eventManager->hasDomEvents());
        $this->assertEmpty($this->eventManager->getDomEvents());
        $this->assertFalse($this->eventManager->hasDomEventsOnce());
        $this->assertEmpty($this->eventManager->getDomEventsOnce());
        $this->assertFalse($this->eventManager->hasEvents());
        $this->assertEmpty($this->eventManager->getEvents());
        $this->assertFalse($this->eventManager->hasEventsOnce());
        $this->assertEmpty($this->eventManager->getEventsOnce());
    }

    public function testSetDomEvents()
    {
        $this->eventManager->setDomEvents($domEvents = [$domEvent = $this->createEventMock()]);
        $this->eventManager->setDomEvents($domEvents);

        $this->assertTrue($this->eventManager->hasDomEvents());
        $this->assertTrue($this->eventManager->hasDomEvent($domEvent));
        $this->assertSame($domEvents, $this->eventManager->getDomEvents());
    }

    public function testAddDomEvents()
    {
        $this->eventManager->setDomEvents($firstDomEvents = [$this->createEventMock()]);
        $this->eventManager->addDomEvents($secondDomEvents = [$this->createEventMock()]);

        $this->assertTrue($this->eventManager->hasDomEvents());
        $this->assertSame(array_merge($firstDomEvents, $secondDomEvents), $this->eventManager->getDomEvents());
    }

    public function testAddDomEvent()
    {
        $this->eventManager->addDomEvent($domEvent = $this->createEventMock());

        $this->assertTrue($this->eventManager->hasDomEvents());
        $this->assertTrue($this->eventManager->hasDomEvent($domEvent));
        $this->assertSame([$domEvent], $this->eventManager->getDomEvents());
    }

    public function testRemoveDomEvent()
    {
        $this->eventManager->addDomEvent($domEvent = $this->createEventMock());
        $this->eventManager->removeDomEvent($domEvent);

        $this->assertFalse($this->eventManager->hasDomEvents());
        $this->assertFalse($this->eventManager->hasDomEvent($domEvent));
        $this->assertEmpty($this->eventManager->getDomEvents());
    }

    public function testSetDomEventsOnce()
    {
        $this->eventManager->setDomEventsOnce($domEventsOnce = [$domEventOnce = $this->createEventMock()]);
        $this->eventManager->setDomEventsOnce($domEventsOnce);

        $this->assertTrue($this->eventManager->hasDomEventsOnce());
        $this->assertTrue($this->eventManager->hasDomEventOnce($domEventOnce));
        $this->assertSame($domEventsOnce, $this->eventManager->getDomEventsOnce());
    }

    public function testAddDomEventsOnce()
    {
        $this->eventManager->setDomEventsOnce($firstDomEventsOnce = [$this->createEventMock()]);
        $this->eventManager->addDomEventsOnce($secondDomEventsOnce = [$this->createEventMock()]);

        $this->assertTrue($this->eventManager->hasDomEventsOnce());
        $this->assertSame(
            array_merge($firstDomEventsOnce, $secondDomEventsOnce),
            $this->eventManager->getDomEventsOnce()
        );
    }

    public function testAddDomEventOnce()
    {
        $this->eventManager->addDomEventOnce($domEventOnce = $this->createEventMock());

        $this->assertTrue($this->eventManager->hasDomEventsOnce());
        $this->assertTrue($this->eventManager->hasDomEventOnce($domEventOnce));
        $this->assertSame([$domEventOnce], $this->eventManager->getDomEventsOnce());
    }

    public function testRemoveDomEventOnce()
    {
        $this->eventManager->addDomEventOnce($domEventOnce = $this->createEventMock());
        $this->eventManager->removeDomEventOnce($domEventOnce);

        $this->assertFalse($this->eventManager->hasDomEventsOnce());
        $this->assertFalse($this->eventManager->hasDomEventOnce($domEventOnce));
        $this->assertEmpty($this->eventManager->getDomEventsOnce());
    }

    public function testSetEvents()
    {
        $this->eventManager->setEvents($events = [$event = $this->createEventMock()]);
        $this->eventManager->setEvents($events);

        $this->assertTrue($this->eventManager->hasEvents());
        $this->assertTrue($this->eventManager->hasEvent($event));
        $this->assertSame($events, $this->eventManager->getEvents());
    }

    public function testAddEvents()
    {
        $this->eventManager->setEvents($firstEvents = [$this->createEventMock()]);
        $this->eventManager->addEvents($secondEvents = [$this->createEventMock()]);

        $this->assertTrue($this->eventManager->hasEvents());
        $this->assertSame(array_merge($firstEvents, $secondEvents), $this->eventManager->getEvents());
    }

    public function testAddEvent()
    {
        $this->eventManager->addEvent($event = $this->createEventMock());

        $this->assertTrue($this->eventManager->hasEvents());
        $this->assertTrue($this->eventManager->hasEvent($event));
        $this->assertSame([$event], $this->eventManager->getEvents());
    }

    public function testRemoveEvent()
    {
        $this->eventManager->addEvent($event = $this->createEventMock());
        $this->eventManager->removeEvent($event);

        $this->assertFalse($this->eventManager->hasEvents());
        $this->assertFalse($this->eventManager->hasEvent($event));
        $this->assertEmpty($this->eventManager->getEvents());
    }

    public function testSetEventsOnce()
    {
        $this->eventManager->setEventsOnce($eventsOnce = [$eventOnce = $this->createEventMock()]);
        $this->eventManager->setEventsOnce($eventsOnce);

        $this->assertTrue($this->eventManager->hasEventsOnce());
        $this->assertTrue($this->eventManager->hasEventOnce($eventOnce));
        $this->assertSame($eventsOnce, $this->eventManager->getEventsOnce());
    }

    public function testAddEventsOnce()
    {
        $this->eventManager->setEventsOnce($firstEventsOnce = [$this->createEventMock()]);
        $this->eventManager->addEventsOnce($secondEventsOnce = [$this->createEventMock()]);

        $this->assertTrue($this->eventManager->hasEventsOnce());
        $this->assertSame(
            array_merge($firstEventsOnce, $secondEventsOnce),
            $this->eventManager->getEventsOnce()
        );
    }

    public function testAddEventOnce()
    {
        $this->eventManager->addEventOnce($eventOnce = $this->createEventMock());

        $this->assertTrue($this->eventManager->hasEventsOnce());
        $this->assertTrue($this->eventManager->hasEventOnce($eventOnce));
        $this->assertSame([$eventOnce], $this->eventManager->getEventsOnce());
    }

    public function testRemoveEventOnce()
    {
        $this->eventManager->addEventOnce($eventOnce = $this->createEventMock());
        $this->eventManager->removeEventOnce($eventOnce);

        $this->assertFalse($this->eventManager->hasEventsOnce());
        $this->assertFalse($this->eventManager->hasEventOnce($eventOnce));
        $this->assertEmpty($this->eventManager->getEventsOnce());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Event
     */
    private function createEventMock()
    {
        return $this->createMock(Event::class);
    }
}
