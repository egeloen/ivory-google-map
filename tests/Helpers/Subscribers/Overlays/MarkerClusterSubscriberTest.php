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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerClusterSubscriber;
use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMap\Overlays\MarkerClusterType;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Marker cluster subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerClusterSubscriber */
    private $markerClusterSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $markerClusterRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->markerClusterSubscriber = new MarkerClusterSubscriber(
            $this->formatter,
            $this->markerClusterRenderer = $this->createMarkerClusterRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->markerClusterRenderer);
        unset($this->markerClusterSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->markerClusterSubscriber);
    }

    public function testDefaultState()
    {
        $this->markerClusterSubscriber = new MarkerClusterSubscriber();

        $this->assertMarkerClusterRendererInstance($this->markerClusterSubscriber->getMarkerClusterRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerClusterRenderer, $this->markerClusterSubscriber->getMarkerClusterRenderer());
    }

    public function testSetMarkerClusterRenderer()
    {
        $this->markerClusterSubscriber->setMarkerClusterRenderer($markerClusterRenderer = $this->createMarkerClusterRendererMock());

        $this->assertSame($markerClusterRenderer, $this->markerClusterSubscriber->getMarkerClusterRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MarkerClusterSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER]);

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER]);
    }

    public function testOnApi()
    {
        $this->markerClusterRenderer
            ->expects($this->once())
            ->method('renderSource')
            ->will($this->returnValue($source = 'source'));

        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->once())
            ->method('getItems')
            ->with($this->identicalTo(ApiEvent::MAP))
            ->will($this->returnValue(array($map = $this->createMapMock($this->createMarkerClusterMock()))));

        $apiEvent
            ->expects($this->once())
            ->method('addSource')
            ->with($this->identicalTo($source));

        $this->markerClusterSubscriber->onApi($apiEvent);
    }

    public function testOnMap()
    {
        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map = $this->createMapMock($markerCluster = $this->createMarkerClusterMock())),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.marker_cluster'),
                $this->identicalTo($markerCluster),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($code = 'code'));

        $this->formatter
            ->expects($this->exactly(2))
            ->method('formatContainerVariable')
            ->will($this->returnValueMap(array(
                array(
                    $map,
                    'functions.to_array',
                    null,
                    $functionCallName = 'map.functions.to_array',
                ),
                array(
                    $map,
                    'overlays.markers',
                    null,
                    $functionCallArgument = 'map.overlays.markers',
                ),
            )));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunctionCall')
            ->with(
                $this->identicalTo($functionCallName),
                $this->identicalTo(array($functionCallArgument)),
                $this->identicalTo(false),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($functionCall = 'map.functions.to_array(map.overlays.markers)'));

        $this->markerClusterRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($markerCluster),
                $this->identicalTo($map),
                $this->identicalTo($functionCall)
            )
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

        $this->markerClusterSubscriber->onMap($mapEvent);
    }

    /**
     * Creates a map mock.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster|null $markerCluster The marker cluster.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(MarkerCluster $markerCluster = null)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($this->createOverlaysMock($markerCluster)));

        return $map;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMarkerClusterMock()
    {
        $markerCluster = parent::createMarkerClusterMock();
        $markerCluster
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue(MarkerClusterType::MARKER_CLUSTER));

        return $markerCluster;
    }

    /**
     * Creates an overlays mock.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster|null $markerCluster The marker cluster.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(MarkerCluster $markerCluster = null)
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getMarkerCluster')
            ->will($this->returnValue($markerCluster));

        return $overlays;
    }
}
