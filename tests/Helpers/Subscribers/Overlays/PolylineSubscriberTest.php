<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Overlays;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolylineSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Polyline subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolylineSubscriber */
    private $polylineSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $polylineAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $polylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->polylineSubscriber = new PolylineSubscriber(
            $this->formatter,
            $this->polylineAggregator = $this->createPolylineAggregatorMock(),
            $this->polylineRenderer = $this->createPolylineRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->polylineRenderer);
        unset($this->polylineAggregator);
        unset($this->polylineSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->polylineSubscriber);
    }

    public function testDefaultState()
    {
        $this->polylineSubscriber = new PolylineSubscriber();

        $this->assertPolylineAggregatorInstance($this->polylineSubscriber->getPolylineAggregator());
        $this->assertPolylineRendererInstance($this->polylineSubscriber->getPolylineRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->polylineAggregator, $this->polylineSubscriber->getPolylineAggregator());
        $this->assertSame($this->polylineRenderer, $this->polylineSubscriber->getPolylineRenderer());
    }

    public function testSetPolylineAggregator()
    {
        $this->polylineSubscriber->setPolylineAggregator($polylineAggregator = $this->createPolylineAggregatorMock());

        $this->assertSame($polylineAggregator, $this->polylineSubscriber->getPolylineAggregator());
    }

    public function testSetPolylineRenderer()
    {
        $this->polylineSubscriber->setPolylineRenderer($polylineRenderer = $this->createPolylineRendererMock());

        $this->assertSame($polylineRenderer, $this->polylineSubscriber->getPolylineRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = PolylineSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE]);
    }

    public function testOnMap()
    {
        $this->polylineAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($polyline = $this->createPolylineMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.polylines'),
                $this->identicalTo($polyline)
            )
            ->will($this->returnValue($code = 'code'));

        $this->polylineRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($polyline),
                $this->identicalTo($map)
            )
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

        $this->polylineSubscriber->onMap($mapEvent);
    }
}
