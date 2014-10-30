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

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowSubscriber;
use Ivory\GoogleMap\Overlays\InfoWindowType;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Info window subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWIndowSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\InfoWindowSubscriber */
    private $infoWindowSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $infoBoxRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->infoWindowSubscriber = new InfoWindowSubscriber(
            $this->formatter,
            $this->infoWindowAggregator = $this->createInfoWindowAggregatorMock(),
            $this->infoWindowRenderer = $this->createInfoWindowRendererMock(),
            $this->infoBoxRenderer = $this->createInfoBoxRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->infoBoxRenderer);
        unset($this->infoWindowRenderer);
        unset($this->infoWindowAggregator);
        unset($this->infoWindowSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->infoWindowSubscriber);
    }

    public function testDefaultState()
    {
        $this->infoWindowSubscriber = new InfoWindowSubscriber();

        $this->assertInfoWindowAggregatorInstance($this->infoWindowSubscriber->getInfoWindowAggregator());
        $this->assertInfoWindowRendererInstance($this->infoWindowSubscriber->getInfoWindowRenderer());
        $this->assertInfoBoxRendererInstance($this->infoWindowSubscriber->getInfoBoxRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->infoWindowAggregator, $this->infoWindowSubscriber->getInfoWindowAggregator());
        $this->assertSame($this->infoWindowRenderer, $this->infoWindowSubscriber->getInfoWindowRenderer());
        $this->assertSame($this->infoBoxRenderer, $this->infoWindowSubscriber->getInfoBoxRenderer());
    }

    public function testSetInfoWindowAggregator()
    {
        $this->infoWindowSubscriber->setInfoWindowAggregator($infoWindowAggregator = $this->createInfoWindowAggregatorMock());

        $this->assertSame($infoWindowAggregator, $this->infoWindowSubscriber->getInfoWindowAggregator());
    }

    public function testSetInfoWindowRenderer()
    {
        $this->infoWindowSubscriber->setInfoWindowRenderer($infoWindowRenderer = $this->createInfoWindowRendererMock());

        $this->assertSame($infoWindowRenderer, $this->infoWindowSubscriber->getInfoWindowRenderer());
    }

    public function testSetInfoBoxRenderer()
    {
        $this->infoWindowSubscriber->setInfoBoxRenderer($infoBoxRenderer = $this->createInfoBoxRendererMock());

        $this->assertSame($infoBoxRenderer, $this->infoWindowSubscriber->getInfoBoxRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = InfoWindowSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW]);

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW]);
    }

    public function testOnApi()
    {
        $this->infoWindowAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($this->createMarkerClusterMock())))
            ->will($this->returnValue(array($this->createInfoWindowMock(InfoWindowType::INFOBOX))));

        $this->infoBoxRenderer
            ->expects($this->once())
            ->method('renderSource')
            ->will($this->returnValue($source = 'source'));

        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->once())
            ->method('getItems')
            ->with($this->identicalTo(ApiEvent::MAP))
            ->will($this->returnValue(array($map)));

        $apiEvent
            ->expects($this->once())
            ->method('addSource')
            ->with($this->identicalTo($source));

        $this->infoWindowSubscriber->onApi($apiEvent);
    }

    public function testOnMap()
    {
        $this->infoWindowAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array(
                $infoWindow = $this->createInfoWindowMock(),
                $infoBox = $this->createInfoWindowMock(InfoWindowType::INFOBOX),
            )));

        $this->formatter
            ->expects($this->exactly(2))
            ->method('formatContainerAssignment')
            ->will($this->returnValueMap(array(
                array(
                    $map,
                    $renderInfoWindow = 'renderInfoWindow',
                    'overlays.info_windows',
                    $infoWindow,
                    true,
                    true,
                    true,
                    $codeInfoWindow = 'codeInfoWindow',
                ),
                array(
                    $map,
                    $renderInfoBox = 'renderInfoBox',
                    'overlays.info_boxes',
                    $infoBox,
                    true,
                    true,
                    true,
                    $codeInfoBox = 'codeInfoBox',
                ),
            )));

        $this->infoWindowRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($infoWindow))
            ->will($this->returnValue($renderInfoWindow));

        $this->infoBoxRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($infoBox))
            ->will($this->returnValue($renderInfoBox));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->exactly(2))
            ->method('addCode')
            ->withConsecutive(
                 array($this->identicalTo($codeInfoWindow)),
                 array($this->identicalTo($codeInfoBox))
             );

        $this->infoWindowSubscriber->onMap($mapEvent);
    }

    /**
     * Creates an info window mock.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock($type = InfoWindowType::DEFAULT_)
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue($type));

        return $infoWindow;
    }
}
