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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolygonSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Polygon subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\PolygonSubscriber */
    private $polygonSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $polygonAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $polygonRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->polygonSubscriber = new PolygonSubscriber(
            $this->formatter,
            $this->polygonAggregator = $this->createPolygonAggregatorMock(),
            $this->polygonRenderer = $this->createPolygonRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->polygonRenderer);
        unset($this->polygonAggregator);
        unset($this->polygonSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->polygonSubscriber);
    }

    public function testDefaultState()
    {
        $this->polygonSubscriber = new PolygonSubscriber();

        $this->assertPolygonAggregatorInstance($this->polygonSubscriber->getPolygonAggregator());
        $this->assertPolygonRendererInstance($this->polygonSubscriber->getPolygonRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->polygonAggregator, $this->polygonSubscriber->getPolygonAggregator());
        $this->assertSame($this->polygonRenderer, $this->polygonSubscriber->getPolygonRenderer());
    }

    public function testSetPolygonAggregator()
    {
        $this->polygonSubscriber->setPolygonAggregator($polygonAggregator = $this->createPolygonAggregatorMock());

        $this->assertSame($polygonAggregator, $this->polygonSubscriber->getPolygonAggregator());
    }

    public function testSetPolygonRenderer()
    {
        $this->polygonSubscriber->setPolygonRenderer($polygonRenderer = $this->createPolygonRendererMock());

        $this->assertSame($polygonRenderer, $this->polygonSubscriber->getPolygonRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = PolygonSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_POLYGON]);
    }

    public function testOnMap()
    {
        $this->polygonAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($polygon = $this->createPolygonMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.polygons'),
                $this->identicalTo($polygon)
            )
            ->will($this->returnValue($code = 'code'));

        $this->polygonRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($polygon),
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

        $this->polygonSubscriber->onMap($mapEvent);
    }
}
