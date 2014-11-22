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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowCloseSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Info window close subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Extra\MapInfoWindowCloseSubscriber */
    private $infoWindowCloseSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowCloseRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->infoWindowCloseSubscriber = new InfoWindowCloseSubscriber(
            $this->formatter,
            $this->infoWindowAggregator = $this->createInfoWindowAggregatorMock(),
            $this->infoWindowCloseRenderer = $this->createInfoWindowCloseRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->infoWindowCloseRenderer);
        unset($this->infoWindowAggregator);
        unset($this->infoWindowCloseSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->infoWindowCloseSubscriber);
    }

    public function testDefaultState()
    {
        $this->infoWindowCloseSubscriber = new InfoWindowCloseSubscriber();

        $this->assertFormatterInstance($this->infoWindowCloseSubscriber->getFormatter());
        $this->assertInfoWindowAggregatorInstance($this->infoWindowCloseSubscriber->getInfoWindowAggregator());
        $this->assertInfoWindowCloseRendererInstance($this->infoWindowCloseSubscriber->getInfoWindowCloseRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->infoWindowCloseSubscriber->getFormatter());
        $this->assertSame($this->infoWindowAggregator, $this->infoWindowCloseSubscriber->getInfoWindowAggregator());

        $this->assertSame(
            $this->infoWindowCloseRenderer,
            $this->infoWindowCloseSubscriber->getInfoWindowCloseRenderer()
        );
    }

    public function testSetInfoWindowAggregator()
    {
        $this->infoWindowCloseSubscriber->setInfoWindowAggregator(
            $infoWindowAggregator = $this->createInfoWindowAggregatorMock()
        );

        $this->assertSame($infoWindowAggregator, $this->infoWindowCloseSubscriber->getInfoWindowAggregator());
    }

    public function testSetInfoWindwoCloseRenderer()
    {
        $this->infoWindowCloseSubscriber->setInfoWindowCloseRenderer(
            $infoWindowCloseRenderer = $this->createInfoWindowCloseRendererMock()
        );

        $this->assertSame($infoWindowCloseRenderer, $this->infoWindowCloseSubscriber->getInfoWindowCloseRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = InfoWindowCloseSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE]);
    }

    public function testOnMap()
    {
        $this->infoWindowAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array(
                $autoCloseInfoWindow = $this->createInfoWindowMock(),
                $this->createInfoWindowMock(false),
            )));

        $this->infoWindowCloseRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($autoCloseInfoWindow))
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatCode')
            ->with($this->identicalTo($render))
            ->will($this->returnValue($code = 'code'));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunction')
            ->with(
                $this->identicalTo($code),
                $this->identicalTo(array()),
                $this->identicalTo(null),
                $this->identicalTo(false),
                $this->identicalTo(true),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($function = 'function'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($function),
                $this->identicalTo('functions.info_windows.close')
            )
            ->will($this->returnValue($container = 'container'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($container));

        $this->infoWindowCloseSubscriber->onMap($mapEvent);
    }

    /**
     * Creates an info window mock.
     *
     * @param boolean $autoClose TRUE if it is auto closed else FALSE.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock($autoClose = true)
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('isAutoClose')
            ->will($this->returnValue($autoClose));

        return $infoWindow;
    }
}
