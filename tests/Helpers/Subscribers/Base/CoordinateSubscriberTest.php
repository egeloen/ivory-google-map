<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Base;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Base\CoordinateSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Coordinate subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Base\CoordinateSubscriber */
    private $coordinateSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $coordinateRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->coordinateSubscriber = new CoordinateSubscriber(
            $this->formatter,
            $this->coordinateAggregator = $this->createCoordinateAggregatorMock(),
            $this->coordinateRenderer = $this->createCoordinateRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->coordinateRenderer);
        unset($this->coordinateAggregator);
        unset($this->coordinateSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->coordinateSubscriber);
    }

    public function testDefaultState()
    {
        $this->coordinateSubscriber = new CoordinateSubscriber();

        $this->assertFormatterInstance($this->coordinateSubscriber->getFormatter());
        $this->assertCoordinateAggregatorInstance($this->coordinateSubscriber->getCoordinateAggregator());
        $this->assertCoordinateRendererInstance($this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->coordinateSubscriber->getFormatter());
        $this->assertSame($this->coordinateAggregator, $this->coordinateSubscriber->getCoordinateAggregator());
        $this->assertSame($this->coordinateRenderer, $this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testSetCoordinateAggregator()
    {
        $this->coordinateSubscriber->setCoordinateAggregator(
            $coordinateAggregator = $this->createCoordinateAggregatorMock()
        );

        $this->assertSame($coordinateAggregator, $this->coordinateSubscriber->getCoordinateAggregator());
    }

    public function testSetCoordinateRenderer()
    {
        $this->coordinateSubscriber->setCoordinateRenderer(
            $coordinateRenderer = $this->createCoordinateRendererMock()
        );

        $this->assertSame($coordinateRenderer, $this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = CoordinateSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_BASE_COORDINATE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_BASE_COORDINATE]);
    }

    public function testOnMap()
    {
        $this->coordinateAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($coordinate = $this->createCoordinateMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.coordinates'),
                $this->identicalTo($coordinate)
            )
            ->will($this->returnValue($code = 'code'));

        $this->coordinateRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($coordinate))
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

        $this->coordinateSubscriber->onMap($mapEvent);
    }
}
