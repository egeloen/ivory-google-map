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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\RectangleSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Rectangle subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\RectangleSubscriber */
    private $rectangleSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $rectangleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $rectangleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->rectangleSubscriber = new RectangleSubscriber(
            $this->formatter,
            $this->rectangleAggregator = $this->createRectangleAggregatorMock(),
            $this->rectangleRenderer = $this->createRectangleRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->rectangleRenderer);
        unset($this->rectangleAggregator);
        unset($this->rectangleSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->rectangleSubscriber);
    }

    public function testDefaultState()
    {
        $this->rectangleSubscriber = new RectangleSubscriber();

        $this->assertRectangleAggregatorInstance($this->rectangleSubscriber->getRectangleAggregator());
        $this->assertRectangleRendererInstance($this->rectangleSubscriber->getRectangleRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->rectangleAggregator, $this->rectangleSubscriber->getRectangleAggregator());
        $this->assertSame($this->rectangleRenderer, $this->rectangleSubscriber->getRectangleRenderer());
    }

    public function testSetRectangleAggregator()
    {
        $this->rectangleSubscriber->setRectangleAggregator($rectangleAggregator = $this->createRectangleAggregatorMock());

        $this->assertSame($rectangleAggregator, $this->rectangleSubscriber->getRectangleAggregator());
    }

    public function testSetRectangleRenderer()
    {
        $this->rectangleSubscriber->setRectangleRenderer($rectangleRenderer = $this->createRectangleRendererMock());

        $this->assertSame($rectangleRenderer, $this->rectangleSubscriber->getRectangleRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = RectangleSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE]);
    }

    public function testOnMap()
    {
        $this->rectangleAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($rectangle = $this->createRectangleMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.rectangles'),
                $this->identicalTo($rectangle)
            )
            ->will($this->returnValue($code = 'code'));

        $this->rectangleRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($rectangle),
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

        $this->rectangleSubscriber->onMap($mapEvent);
    }
}
