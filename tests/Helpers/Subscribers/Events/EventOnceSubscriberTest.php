<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\EventOnces;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventOnceSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Event once subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\EventOnces\EventOnceSubscriber */
    private $eventOnceSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\EventOnces\EventOnceAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $eventOnceAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\EventOnces\EventOnceRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $eventOnceRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->eventOnceSubscriber = new EventOnceSubscriber(
            $this->formatter,
            $this->eventOnceAggregator = $this->createEventOnceAggregatorMock(),
            $this->eventOnceRenderer = $this->createEventOnceRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->eventOnceRenderer);
        unset($this->eventOnceAggregator);
        unset($this->eventOnceSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->eventOnceSubscriber);
    }

    public function testDefaultState()
    {
        $this->eventOnceSubscriber = new EventOnceSubscriber();

        $this->assertFormatterInstance($this->eventOnceSubscriber->getFormatter());
        $this->assertEventOnceAggregatorInstance($this->eventOnceSubscriber->getEventOnceAggregator());
        $this->assertEventOnceRendererInstance($this->eventOnceSubscriber->getEventOnceRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->eventOnceSubscriber->getFormatter());
        $this->assertSame($this->eventOnceAggregator, $this->eventOnceSubscriber->getEventOnceAggregator());
        $this->assertSame($this->eventOnceRenderer, $this->eventOnceSubscriber->getEventOnceRenderer());
    }

    public function testSetEventOnceAggregator()
    {
        $this->eventOnceSubscriber->setEventOnceAggregator(
            $eventOnceAggregator = $this->createEventOnceAggregatorMock()
        );

        $this->assertSame($eventOnceAggregator, $this->eventOnceSubscriber->getEventOnceAggregator());
    }

    public function testSetEventOnceRenderer()
    {
        $this->eventOnceSubscriber->setEventOnceRenderer($eventOnceRenderer = $this->createEventOnceRendererMock());

        $this->assertSame($eventOnceRenderer, $this->eventOnceSubscriber->getEventOnceRenderer());
    }

    public function testSubscribedEventOnces()
    {
        $subscribedEvents = EventOnceSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE]);
    }

    public function testOnMap()
    {
        $this->eventOnceAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($eventOnce = $this->createEventMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('events.events_once'),
                $this->identicalTo($eventOnce)
            )
            ->will($this->returnValue($code = 'code'));

        $this->eventOnceRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($eventOnce))
            ->will($this->returnValue($render));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->eventOnceSubscriber->onMap($mapEvent);
    }
}
