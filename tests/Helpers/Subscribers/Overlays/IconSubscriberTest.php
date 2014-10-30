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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\IconSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Icon subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\IconSubscriber */
    private $iconSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $iconAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $iconRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->iconSubscriber = new IconSubscriber(
            $this->formatter,
            $this->iconAggregator = $this->createIconAggregatorMock(),
            $this->iconRenderer = $this->createIconRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->iconRenderer);
        unset($this->iconAggregator);
        unset($this->iconSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->iconSubscriber);
    }

    public function testDefaultState()
    {
        $this->iconSubscriber = new IconSubscriber();

        $this->assertIconAggregatorInstance($this->iconSubscriber->getIconAggregator());
        $this->assertIconRendererInstance($this->iconSubscriber->getIconRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->iconAggregator, $this->iconSubscriber->getIconAggregator());
        $this->assertSame($this->iconRenderer, $this->iconSubscriber->getIconRenderer());
    }

    public function testSetIconAggregator()
    {
        $this->iconSubscriber->setIconAggregator($iconAggregator = $this->createIconAggregatorMock());

        $this->assertSame($iconAggregator, $this->iconSubscriber->getIconAggregator());
    }

    public function testSetIconRenderer()
    {
        $this->iconSubscriber->setIconRenderer($iconRenderer = $this->createIconRendererMock());

        $this->assertSame($iconRenderer, $this->iconSubscriber->getIconRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = IconSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_ICON, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_ICON]);
    }

    public function testOnMap()
    {
        $this->iconAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($icon = $this->createIconMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.icons'),
                $this->identicalTo($icon)
            )
            ->will($this->returnValue($code = 'code'));

        $this->iconRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($icon))
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

        $this->iconSubscriber->onMap($mapEvent);
    }
}
