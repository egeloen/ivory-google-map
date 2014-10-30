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
use Ivory\GoogleMap\Helpers\Subscribers\Base\PointSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Point subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Base\PointSubscriber */
    private $pointSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $pointAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $pointRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->pointSubscriber = new PointSubscriber(
            $this->formatter,
            $this->pointAggregator = $this->createPointAggregatorMock(),
            $this->pointRenderer = $this->createPointRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->pointRenderer);
        unset($this->pointAggregator);
        unset($this->pointSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->pointSubscriber);
    }

    public function testDefaultState()
    {
        $this->pointSubscriber = new PointSubscriber();

        $this->assertFormatterInstance($this->pointSubscriber->getFormatter());
        $this->assertPointAggregatorInstance($this->pointSubscriber->getPointAggregator());
        $this->assertPointRendererInstance($this->pointSubscriber->getPointRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->pointSubscriber->getFormatter());
        $this->assertSame($this->pointAggregator, $this->pointSubscriber->getPointAggregator());
        $this->assertSame($this->pointRenderer, $this->pointSubscriber->getPointRenderer());
    }

    public function testSetPointAggregator()
    {
        $this->pointSubscriber->setPointAggregator($pointAggregator = $this->createPointAggregatorMock());

        $this->assertSame($pointAggregator, $this->pointSubscriber->getPointAggregator());
    }

    public function testSetPointRenderer()
    {
        $this->pointSubscriber->setPointRenderer($pointRenderer = $this->createPointRendererMock());

        $this->assertSame($pointRenderer, $this->pointSubscriber->getPointRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = PointSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_BASE_POINT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_BASE_POINT]);
    }

    public function testOnMap()
    {
        $this->pointAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($point = $this->createPointMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.points'),
                $this->identicalTo($point)
            )
            ->will($this->returnValue($code = 'code'));

        $this->pointRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($point))
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

        $this->pointSubscriber->onMap($mapEvent);
    }
}
