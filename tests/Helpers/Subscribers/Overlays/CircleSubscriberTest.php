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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\CircleSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Circle subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\CircleSubscriber */
    private $circleSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $circleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $circleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->circleSubscriber = new CircleSubscriber(
            $this->formatter,
            $this->circleAggregator = $this->createCircleAggregatorMock(),
            $this->circleRenderer = $this->createCircleRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->circleRenderer);
        unset($this->circleAggregator);
        unset($this->circleSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->circleSubscriber);
    }

    public function testDefaultState()
    {
        $this->circleSubscriber = new CircleSubscriber();

        $this->assertCircleAggregatorInstance($this->circleSubscriber->getCircleAggregator());
        $this->assertCircleRendererInstance($this->circleSubscriber->getCircleRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->circleAggregator, $this->circleSubscriber->getCircleAggregator());
        $this->assertSame($this->circleRenderer, $this->circleSubscriber->getCircleRenderer());
    }

    public function testSetCircleAggregator()
    {
        $this->circleSubscriber->setCircleAggregator($circleAggregator = $this->createCircleAggregatorMock());

        $this->assertSame($circleAggregator, $this->circleSubscriber->getCircleAggregator());
    }

    public function testSetCircleRenderer()
    {
        $this->circleSubscriber->setCircleRenderer($circleRenderer = $this->createCircleRendererMock());

        $this->assertSame($circleRenderer, $this->circleSubscriber->getCircleRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = CircleSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE]);
    }

    public function testOnMap()
    {
        $this->circleAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($circle = $this->createCircleMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.circles'),
                $this->identicalTo($circle)
            )
            ->will($this->returnValue($code = 'code'));

        $this->circleRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($circle),
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

        $this->circleSubscriber->onMap($mapEvent);
    }
}
