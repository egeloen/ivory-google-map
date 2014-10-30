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

use Ivory\GoogleMap\Events\Event;
use Ivory\GoogleMap\Events\Events;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerOpenEventSubscriber;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Marker open event subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerOpenEventSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerOpenEventSubscriber */
    private $markerOpenEventSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowOpenRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->markerOpenEventSubscriber = new MarkerOpenEventSubscriber(
            $this->formatter,
            $this->markerAggregator = $this->createMarkerAggregatorMock(),
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
        unset($this->markerAggregator);
        unset($this->markerOpenEventSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->markerOpenEventSubscriber);
    }

    public function testDefaultState()
    {
        $this->markerOpenEventSubscriber = new MarkerOpenEventSubscriber();

        $this->assertFormatterInstance($this->markerOpenEventSubscriber->getFormatter());
        $this->assertMarkerAggregatorInstance($this->markerOpenEventSubscriber->getMarkerAggregator());
        $this->assertInfoWindowOpenRendererInstance($this->markerOpenEventSubscriber->getInfoWindowOpenRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->markerOpenEventSubscriber->getFormatter());
        $this->assertSame($this->markerAggregator, $this->markerOpenEventSubscriber->getMarkerAggregator());

        $this->assertSame(
            $this->infoWindowOpenRenderer,
            $this->markerOpenEventSubscriber->getInfoWindowOpenRenderer()
        );
    }

    public function testSetMarkerAggregator()
    {
        $this->markerOpenEventSubscriber->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->markerOpenEventSubscriber->getMarkerAggregator());
    }

    public function testSetInfoWindowOpenRenderer()
    {
        $this->markerOpenEventSubscriber->setInfoWindowOpenRenderer(
            $infoWindowOpenRenderer = $this->createInfoWindowOpenRendererMock()
        );

        $this->assertSame($infoWindowOpenRenderer, $this->markerOpenEventSubscriber->getInfoWindowOpenRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MarkerOpenEventSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT]);
    }

    public function testOnMap()
    {
        $this->markerAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($events = $this->createEventsMock())))
            ->will($this->returnValue(array(
                $marker = $this->createMarkerMock($infoWindow = $this->createInfoWindowMock()),
            )));

        $this->infoWindowOpenRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($infoWindow),
                $this->identicalTo($map),
                $this->identicalTo($marker)
            )
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerVariable')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo('functions.info_windows.close')
            )
            ->will($this->returnValue($closeInfoWindow = 'map.functions.info_windows.close'));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunctionCall')
            ->with($this->identicalTo($closeInfoWindow))
            ->will($this->returnValue($closeInfoWindowCode = 'map.functions.info_windows.close();'));

        $this->formatter
            ->expects($this->once())
            ->method('formatCode')
            ->with($this->identicalTo($render))
            ->will($this->returnValue($openInfoWindowCode = 'info_window.open();'));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunction')
            ->with(
                $this->identicalTo($closeInfoWindowCode.$openInfoWindowCode),
                $this->identicalTo(array()),
                $this->identicalTo(null),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($handle = 'function () {'.$closeInfoWindowCode.$openInfoWindowCode.'}'));

        $events
            ->expects($this->once())
            ->method('addEvent')
            ->with($this->callback(function ($event) use ($handle) {
                return $event instanceof Event
                    && $event->getInstance() === 'marker'
                    && $event->getEventName() === 'open_event'
                    && $event->getHandle() === $handle;
            }));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $this->markerOpenEventSubscriber->onMap($mapEvent);
    }

    /**
     * {@inheritdoc}
     */
    protected function createInfoWindowMock()
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('info_window'));

        $infoWindow
            ->expects($this->any())
            ->method('isAutoOpen')
            ->will($this->returnValue(true));

        $infoWindow
            ->expects($this->any())
            ->method('getOpenEvent')
            ->will($this->returnValue('open_event'));

        return $infoWindow;
    }

    /**
     * Creates a map mock.
     *
     * @param \Ivory\HttpAdapter\Event\Events $events The events.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(Events $events = null)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        $map
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($events));

        return $map;
    }

    /**
     * Creates a marker mock.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow|null $infoWindow The info window.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(InfoWindow $infoWindow = null)
    {
        $marker = parent::createMarkerMock();
        $marker
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('marker'));

        $marker
            ->expects($this->any())
            ->method('hasInfoWindow')
            ->will($this->returnValue(true));

        $marker
            ->expects($this->any())
            ->method('getInfoWindow')
            ->will($this->returnValue($infoWindow));

        return $marker;
    }
}
