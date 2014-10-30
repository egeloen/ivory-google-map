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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerShapeSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Marker shape subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerShapeSubscriber */
    private $markerShapeSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerShapeAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $markerShapeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->markerShapeSubscriber = new MarkerShapeSubscriber(
            $this->formatter,
            $this->markerShapeAggregator = $this->createMarkerShapeAggregatorMock(),
            $this->markerShapeRenderer = $this->createMarkerShapeRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->markerShapeRenderer);
        unset($this->markerShapeAggregator);
        unset($this->markerShapeSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->markerShapeSubscriber);
    }

    public function testDefaultState()
    {
        $this->markerShapeSubscriber = new MarkerShapeSubscriber();

        $this->assertMarkerShapeAggregatorInstance($this->markerShapeSubscriber->getMarkerShapeAggregator());
        $this->assertMarkerShapeRendererInstance($this->markerShapeSubscriber->getMarkerShapeRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerShapeAggregator, $this->markerShapeSubscriber->getMarkerShapeAggregator());
        $this->assertSame($this->markerShapeRenderer, $this->markerShapeSubscriber->getMarkerShapeRenderer());
    }

    public function testSetMarkerShapeAggregator()
    {
        $this->markerShapeSubscriber->setMarkerShapeAggregator(
            $markerShapeAggregator = $this->createMarkerShapeAggregatorMock()
        );

        $this->assertSame($markerShapeAggregator, $this->markerShapeSubscriber->getMarkerShapeAggregator());
    }

    public function testSetMarkerShapeRenderer()
    {
        $this->markerShapeSubscriber->setMarkerShapeRenderer(
            $markerShapeRenderer = $this->createMarkerShapeRendererMock()
        );

        $this->assertSame($markerShapeRenderer, $this->markerShapeSubscriber->getMarkerShapeRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MarkerShapeSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE]);
    }

    public function testOnMap()
    {
        $this->markerShapeAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($markerShape = $this->createMarkerShapeMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.marker_shapes'),
                $this->identicalTo($markerShape)
            )
            ->will($this->returnValue($code = 'code'));

        $this->markerShapeRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($markerShape))
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

        $this->markerShapeSubscriber->onMap($mapEvent);
    }
}
