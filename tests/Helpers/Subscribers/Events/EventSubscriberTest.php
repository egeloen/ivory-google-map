<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Events;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Event subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Events\EventSubscriber */
    private $eventSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $eventAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $eventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->eventSubscriber = new EventSubscriber(
            $this->formatter,
            $this->eventAggregator = $this->createEventAggregatorMock(),
            $this->eventRenderer = $this->createEventRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->eventRenderer);
        unset($this->eventAggregator);
        unset($this->eventSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->eventSubscriber);
    }

    public function testDefaultState()
    {
        $this->eventSubscriber = new EventSubscriber();

        $this->assertFormatterInstance($this->eventSubscriber->getFormatter());
        $this->assertEventAggregatorInstance($this->eventSubscriber->getEventAggregator());
        $this->assertEventRendererInstance($this->eventSubscriber->getEventRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->eventSubscriber->getFormatter());
        $this->assertSame($this->eventAggregator, $this->eventSubscriber->getEventAggregator());
        $this->assertSame($this->eventRenderer, $this->eventSubscriber->getEventRenderer());
    }

    public function testSetEventAggregator()
    {
        $this->eventSubscriber->setEventAggregator($eventAggregator = $this->createEventAggregatorMock());

        $this->assertSame($eventAggregator, $this->eventSubscriber->getEventAggregator());
    }

    public function testSetEventRenderer()
    {
        $this->eventSubscriber->setEventRenderer($eventRenderer = $this->createEventRendererMock());

        $this->assertSame($eventRenderer, $this->eventSubscriber->getEventRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = EventSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_EVENTS_EVENT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_EVENTS_EVENT]);
    }

    public function testOnMap()
    {
        $this->eventAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($event = $this->createEventMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('events.events'),
                $this->identicalTo($event)
            )
            ->will($this->returnValue($code = 'code'));

        $this->eventRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($event))
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

        $this->eventSubscriber->onMap($mapEvent);
    }
}
