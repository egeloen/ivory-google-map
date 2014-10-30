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
use Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventOnceSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Dom event once subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventOnceSubscriber */
    private $domEventOnceSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $domEventOnceAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $domEventOnceRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->domEventOnceSubscriber = new DomEventOnceSubscriber(
            $this->formatter,
            $this->domEventOnceAggregator = $this->createDomEventOnceAggregatorMock(),
            $this->domEventOnceRenderer = $this->createDomEventOnceRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->domEventOnceRenderer);
        unset($this->domEventOnceAggregator);
        unset($this->domEventOnceSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->domEventOnceSubscriber);
    }

    public function testDefaultState()
    {
        $this->domEventOnceSubscriber = new DomEventOnceSubscriber();

        $this->assertFormatterInstance($this->domEventOnceSubscriber->getFormatter());
        $this->assertDomEventOnceAggregatorInstance($this->domEventOnceSubscriber->getDomEventOnceAggregator());
        $this->assertDomEventOnceRendererInstance($this->domEventOnceSubscriber->getDomEventOnceRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->domEventOnceSubscriber->getFormatter());
        $this->assertSame($this->domEventOnceAggregator, $this->domEventOnceSubscriber->getDomEventOnceAggregator());
        $this->assertSame($this->domEventOnceRenderer, $this->domEventOnceSubscriber->getDomEventOnceRenderer());
    }

    public function testSetDomEventOnceAggregator()
    {
        $this->domEventOnceSubscriber->setDomEventOnceAggregator(
            $domEventOnceAggregator = $this->createDomEventOnceAggregatorMock()
        );

        $this->assertSame($domEventOnceAggregator, $this->domEventOnceSubscriber->getDomEventOnceAggregator());
    }

    public function testSetDomEventOnceRenderer()
    {
        $this->domEventOnceSubscriber->setDomEventOnceRenderer(
            $domEventOnceRenderer = $this->createDomEventOnceRendererMock()
        );

        $this->assertSame($domEventOnceRenderer, $this->domEventOnceSubscriber->getDomEventOnceRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = DomEventOnceSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE]);
    }

    public function testOnMap()
    {
        $this->domEventOnceAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($domEventOnce = $this->createDomEventMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('events.dom_events_once'),
                $this->identicalTo($domEventOnce)
            )
            ->will($this->returnValue($code = 'code'));

        $this->domEventOnceRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($domEventOnce))
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

        $this->domEventOnceSubscriber->onMap($mapEvent);
    }
}
