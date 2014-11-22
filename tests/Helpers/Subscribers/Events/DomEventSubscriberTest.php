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
use Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Dom event subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Events\DomEventSubscriber */
    private $domEventSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $domEventAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $domEventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->domEventSubscriber = new DomEventSubscriber(
            $this->formatter,
            $this->domEventAggregator = $this->createDomEventAggregatorMock(),
            $this->domEventRenderer = $this->createDomEventRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->domEventRenderer);
        unset($this->domEventAggregator);
        unset($this->domEventSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->domEventSubscriber);
    }

    public function testDefaultState()
    {
        $this->domEventSubscriber = new DomEventSubscriber();

        $this->assertFormatterInstance($this->domEventSubscriber->getFormatter());
        $this->assertDomEventAggregatorInstance($this->domEventSubscriber->getDomEventAggregator());
        $this->assertDomEventRendererInstance($this->domEventSubscriber->getDomEventRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->domEventSubscriber->getFormatter());
        $this->assertSame($this->domEventAggregator, $this->domEventSubscriber->getDomEventAggregator());
        $this->assertSame($this->domEventRenderer, $this->domEventSubscriber->getDomEventRenderer());
    }

    public function testSetDomEventAggregator()
    {
        $this->domEventSubscriber->setDomEventAggregator($domEventAggregator = $this->createDomEventAggregatorMock());

        $this->assertSame($domEventAggregator, $this->domEventSubscriber->getDomEventAggregator());
    }

    public function testSetDomEventRenderer()
    {
        $this->domEventSubscriber->setDomEventRenderer($domEventRenderer = $this->createDomEventRendererMock());

        $this->assertSame($domEventRenderer, $this->domEventSubscriber->getDomEventRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = DomEventSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT]);
    }

    public function testOnMap()
    {
        $this->domEventAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($domEvent = $this->createDomEventMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('events.dom_events'),
                $this->identicalTo($domEvent)
            )
            ->will($this->returnValue($code = 'code'));

        $this->domEventRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($domEvent))
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

        $this->domEventSubscriber->onMap($mapEvent);
    }
}
