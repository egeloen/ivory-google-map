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

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\EncodedPolylineSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Encoded polyline subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\EncodedPolylineSubscriber */
    private $encodedPolylineSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $encodedPolylineAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $encodedPolylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->encodedPolylineSubscriber = new EncodedPolylineSubscriber(
            $this->formatter,
            $this->encodedPolylineAggregator = $this->createEncodedPolylineAggregatorMock(),
            $this->encodedPolylineRenderer = $this->createEncodedPolylineRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->encodedPolylineRenderer);
        unset($this->encodedPolylineAggregator);
        unset($this->encodedPolylineSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->encodedPolylineSubscriber);
    }

    public function testDefaultState()
    {
        $this->encodedPolylineSubscriber = new EncodedPolylineSubscriber();

        $this->assertEncodedPolylineAggregatorInstance(
            $this->encodedPolylineSubscriber->getEncodedPolylineAggregator()
        );

        $this->assertEncodedPolylineRendererInstance($this->encodedPolylineSubscriber->getEncodedPolylineRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame(
            $this->encodedPolylineAggregator,
            $this->encodedPolylineSubscriber->getEncodedPolylineAggregator()
        );

        $this->assertSame(
            $this->encodedPolylineRenderer,
            $this->encodedPolylineSubscriber->getEncodedPolylineRenderer()
        );
    }

    public function testSetEncodedPolylineAggregator()
    {
        $this->encodedPolylineSubscriber->setEncodedPolylineAggregator(
            $encodedPolylineAggregator = $this->createEncodedPolylineAggregatorMock()
        );

        $this->assertSame($encodedPolylineAggregator, $this->encodedPolylineSubscriber->getEncodedPolylineAggregator());
    }

    public function testSetEncodedPolylineRenderer()
    {
        $this->encodedPolylineSubscriber->setEncodedPolylineRenderer(
            $encodedPolylineRenderer = $this->createEncodedPolylineRendererMock()
        );

        $this->assertSame($encodedPolylineRenderer, $this->encodedPolylineSubscriber->getEncodedPolylineRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = EncodedPolylineSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE]);

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE]);
    }

    public function testOnApi()
    {
        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->once())
            ->method('getItems')
            ->with($this->identicalTo(ApiEvent::MAP))
            ->will($this->returnValue(array($map = $this->createMapMock())));

        $this->encodedPolylineAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue(array($encodedPolyline = $this->createEncodedPolylineMock())));

        $apiEvent
            ->expects($this->once())
            ->method('addLibrary')
            ->with($this->identicalTo('geometry'));

        $this->encodedPolylineSubscriber->onApi($apiEvent);
    }

    public function testOnMap()
    {
        $this->encodedPolylineAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($encodedPolyline = $this->createEncodedPolylineMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.encoded_polylines'),
                $this->identicalTo($encodedPolyline)
            )
            ->will($this->returnValue($code = 'code'));

        $this->encodedPolylineRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($encodedPolyline),
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

        $this->encodedPolylineSubscriber->onMap($mapEvent);
    }
}
