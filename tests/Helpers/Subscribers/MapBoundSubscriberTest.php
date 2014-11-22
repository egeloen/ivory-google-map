<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\MapBoundSubscriber;

/**
 * Map bound subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapBoundSubscriber */
    private $mapBoundSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $mapBoundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapBoundSubscriber = new MapBoundSubscriber(
            $this->formatter,
            $this->mapBoundRenderer = $this->createMapBoundRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapBoundRenderer);
        unset($this->mapBoundSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapBoundSubscriber);
    }

    public function testDefaultState()
    {
        $this->mapBoundSubscriber = new MapBoundSubscriber();

        $this->assertFormatterInstance($this->mapBoundSubscriber->getFormatter());
        $this->assertMapBoundRendererInstance($this->mapBoundSubscriber->getMapBoundRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->mapBoundSubscriber->getFormatter());
        $this->assertSame($this->mapBoundRenderer, $this->mapBoundSubscriber->getMapBoundRenderer());
    }

    public function testSetMapBoundRenderer()
    {
        $this->mapBoundSubscriber->setMapBoundRenderer($mapBoundRenderer = $this->createMapBoundRendererMock());

        $this->assertSame($mapBoundRenderer, $this->mapBoundSubscriber->getMapBoundRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapBoundSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH_MAP_BOUND, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH_MAP_BOUND]);
    }

    /**
     * @dataProvider onMapProvider
     */
    public function testOnMap($autoZoom = false)
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map = $this->createMapMock($autoZoom)));

        if ($autoZoom) {
            $this->mapBoundRenderer
                ->expects($this->once())
                ->method('render')
                ->with($this->identicalTo($map))
                ->will($this->returnValue($render = 'render'));

            $this->formatter
                ->expects($this->once())
                ->method('formatCode')
                ->with($this->identicalTo($render))
                ->will($this->returnValue($code = 'code'));

            $mapEvent
                ->expects($this->once())
                ->method('addCode')
                ->with($this->identicalTo($code));
        } else {
            $mapEvent
                ->expects($this->never())
                ->method('addCode');
        }

        $this->mapBoundSubscriber->onMap($mapEvent);
    }

    /**
     * Gets the on map provider.
     *
     * @return array The on map provider.
     */
    public function onMapProvider()
    {
        return array(
            array(),
            array(true),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param boolean $autoZoom The auto zoom.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock($autoZoom = false)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($this->createOverlaysMock($autoZoom)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param boolean $autoZoom The auto zoom.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock($autoZoom = false)
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue($autoZoom));

        return $overlays;
    }
}
