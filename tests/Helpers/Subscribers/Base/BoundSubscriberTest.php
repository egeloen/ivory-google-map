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
use Ivory\GoogleMap\Helpers\Subscribers\Base\BoundSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Bound subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Base\BoundSubscriber */
    private $boundSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $boundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->boundSubscriber = new BoundSubscriber(
            $this->formatter,
            $this->boundAggregator = $this->createBoundAggregatorMock(),
            $this->boundRenderer = $this->createBoundRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->boundRenderer);
        unset($this->boundAggregator);
        unset($this->boundSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->boundSubscriber);
    }

    public function testDefaultState()
    {
        $this->boundSubscriber = new BoundSubscriber();

        $this->assertFormatterInstance($this->boundSubscriber->getFormatter());
        $this->assertBoundAggregatorInstance($this->boundSubscriber->getBoundAggregator());
        $this->assertBoundRendererInstance($this->boundSubscriber->getBoundRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->boundSubscriber->getFormatter());
        $this->assertSame($this->boundAggregator, $this->boundSubscriber->getBoundAggregator());
        $this->assertSame($this->boundRenderer, $this->boundSubscriber->getBoundRenderer());
    }

    public function testSetBoundAggregator()
    {
        $this->boundSubscriber->setBoundAggregator($boundAggregator = $this->createBoundAggregatorMock());

        $this->assertSame($boundAggregator, $this->boundSubscriber->getBoundAggregator());
    }

    public function testSetBoundRenderer()
    {
        $this->boundSubscriber->setBoundRenderer($boundRenderer = $this->createBoundRendererMock());

        $this->assertSame($boundRenderer, $this->boundSubscriber->getBoundRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = BoundSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_BASE_BOUND, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_BASE_BOUND]);
    }

    public function testOnMap()
    {
        $this->boundAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($bound = $this->createBoundMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.bounds'),
                $this->identicalTo($bound)
            )
            ->will($this->returnValue($code = 'code'));

        $this->boundRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($bound))
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

        $this->boundSubscriber->onMap($mapEvent);
    }
}
