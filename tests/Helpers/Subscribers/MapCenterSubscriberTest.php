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
use Ivory\GoogleMap\Helpers\Subscribers\MapCenterSubscriber;

/**
 * Map center subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapCenterSubscriber */
    private $mapCenterSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer */
    private $mapCenterRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapCenterSubscriber = new MapCenterSubscriber(
            $this->formatter,
            $this->mapCenterRenderer = $this->createMapCenterRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapCenterRenderer);
        unset($this->mapCenterSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapCenterSubscriber);
    }

    public function testDefaultState()
    {
        $this->mapCenterSubscriber = new MapCenterSubscriber();

        $this->assertFormatterInstance($this->mapCenterSubscriber->getFormatter());
        $this->assertMapCenterRendererInstance($this->mapCenterSubscriber->getMapCenterRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->mapCenterSubscriber->getFormatter());
        $this->assertSame($this->mapCenterRenderer, $this->mapCenterSubscriber->getMapCenterRenderer());
    }

    public function testSetMapCenterRenderer()
    {
        $this->mapCenterSubscriber->setMapCenterRenderer($mapCenterRenderer = $this->createMapCenterRendererMock());

        $this->assertSame($mapCenterRenderer, $this->mapCenterSubscriber->getMapCenterRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapCenterSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH_MAP_CENTER, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH_MAP_CENTER]);
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

        if (!$autoZoom) {
            $this->mapCenterRenderer
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

        $this->mapCenterSubscriber->onMap($mapEvent);
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
