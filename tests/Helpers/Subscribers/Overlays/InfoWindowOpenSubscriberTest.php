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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowOpenSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Info window open subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Extra\MapInfoWindowOpenSubscriber */
    private $infoWindowOpenSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowOpenRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->infoWindowOpenSubscriber = new InfoWindowOpenSubscriber(
            $this->formatter,
            $this->infoWindowAggregator = $this->createInfoWindowAggregatorMock(),
            $this->infoWindowOpenRenderer = $this->createInfoWindowOpenRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->infoWindowOpenRenderer);
        unset($this->infoWindowAggregator);
        unset($this->infoWindowOpenSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->infoWindowOpenSubscriber);
    }

    public function testDefaultState()
    {
        $this->infoWindowOpenSubscriber = new InfoWindowOpenSubscriber();

        $this->assertFormatterInstance($this->infoWindowOpenSubscriber->getFormatter());
        $this->assertInfoWindowAggregatorInstance($this->infoWindowOpenSubscriber->getInfoWindowAggregator());
        $this->assertInfoWindowOpenRendererInstance($this->infoWindowOpenSubscriber->getInfoWindowOpenRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->infoWindowOpenSubscriber->getFormatter());
        $this->assertSame($this->infoWindowAggregator, $this->infoWindowOpenSubscriber->getInfoWindowAggregator());

        $this->assertSame(
            $this->infoWindowOpenRenderer,
            $this->infoWindowOpenSubscriber->getInfoWindowOpenRenderer()
        );
    }

    public function testSetInfoWindowAggregator()
    {
        $this->infoWindowOpenSubscriber->setInfoWindowAggregator(
            $infoWindowAggregator = $this->createInfoWindowAggregatorMock()
        );

        $this->assertSame($infoWindowAggregator, $this->infoWindowOpenSubscriber->getInfoWindowAggregator());
    }

    public function testSetInfoWindwoOpenRenderer()
    {
        $this->infoWindowOpenSubscriber->setInfoWindowOpenRenderer(
            $infoWindowOpenRenderer = $this->createInfoWindowOpenRendererMock()
        );

        $this->assertSame($infoWindowOpenRenderer, $this->infoWindowOpenSubscriber->getInfoWindowOpenRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = InfoWindowOpenSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN]);
    }

    public function testOnMap()
    {
        $this->infoWindowAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array(
                $openInfoWindow = $this->createInfoWindowMock(),
                $this->createInfoWindowMock(false),
            )));

        $this->infoWindowOpenRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($openInfoWindow),
                $this->identicalTo($map)
            )
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatCode')
            ->with($this->identicalTo($render))
            ->will($this->returnValue($code = 'code'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->infoWindowOpenSubscriber->onMap($mapEvent);
    }

    /**
     * Creates an info window mock.
     *
     * @param boolean $open TRUE if it is opened else FALSE.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock($open = true)
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('isOpen')
            ->will($this->returnValue($open));

        return $infoWindow;
    }
}
