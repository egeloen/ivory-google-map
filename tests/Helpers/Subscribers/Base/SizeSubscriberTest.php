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
use Ivory\GoogleMap\Helpers\Subscribers\Base\SizeSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Size subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Base\SizeSubscriber */
    private $sizeSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $sizeAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $sizeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->sizeSubscriber = new SizeSubscriber(
            $this->formatter,
            $this->sizeAggregator = $this->createSizeAggregatorMock(),
            $this->sizeRenderer = $this->createSizeRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->sizeRenderer);
        unset($this->sizeAggregator);
        unset($this->sizeSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->sizeSubscriber);
    }

    public function testDefaultState()
    {
        $this->sizeSubscriber = new SizeSubscriber();

        $this->assertSizeAggregatorInstance($this->sizeSubscriber->getSizeAggregator());
        $this->assertSizeRendererInstance($this->sizeSubscriber->getSizeRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->sizeAggregator, $this->sizeSubscriber->getSizeAggregator());
        $this->assertSame($this->sizeRenderer, $this->sizeSubscriber->getSizeRenderer());
    }

    public function testSetSizeAggregator()
    {
        $this->sizeSubscriber->setSizeAggregator($sizeAggregator = $this->createSizeAggregatorMock());

        $this->assertSame($sizeAggregator, $this->sizeSubscriber->getSizeAggregator());
    }

    public function testSetSizeRenderer()
    {
        $this->sizeSubscriber->setSizeRenderer($sizeRenderer = $this->createSizeRendererMock());

        $this->assertSame($sizeRenderer, $this->sizeSubscriber->getSizeRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = SizeSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_BASE_SIZE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_BASE_SIZE]);
    }

    public function testOnMap()
    {
        $this->sizeAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($size = $this->createSizeMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.sizes'),
                $this->identicalTo($size)
            )
            ->will($this->returnValue($code = 'code'));

        $this->sizeRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($size))
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

        $this->sizeSubscriber->onMap($mapEvent);
    }
}
