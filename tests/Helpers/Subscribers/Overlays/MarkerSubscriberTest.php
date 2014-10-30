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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerSubscriber;
use Ivory\GoogleMap\Overlays\MarkerClusterType;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Marker subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\MarkerSubscriber */
    private $markerSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $markerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->markerSubscriber = new MarkerSubscriber(
            $this->formatter,
            $this->markerAggregator = $this->createMarkerAggregatorMock(),
            $this->markerRenderer = $this->createMarkerRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->markerRenderer);
        unset($this->markerAggregator);
        unset($this->markerSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->markerSubscriber);
    }

    public function testDefaultState()
    {
        $this->markerSubscriber = new MarkerSubscriber();

        $this->assertMarkerAggregatorInstance($this->markerSubscriber->getMarkerAggregator());
        $this->assertMarkerRendererInstance($this->markerSubscriber->getMarkerRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerAggregator, $this->markerSubscriber->getMarkerAggregator());
        $this->assertSame($this->markerRenderer, $this->markerSubscriber->getMarkerRenderer());
    }

    public function testSetMarkerAggregator()
    {
        $this->markerSubscriber->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->markerSubscriber->getMarkerAggregator());
    }

    public function testSetMarkerRenderer()
    {
        $this->markerSubscriber->setMarkerRenderer($markerRenderer = $this->createMarkerRendererMock());

        $this->assertSame($markerRenderer, $this->markerSubscriber->getMarkerRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MarkerSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_MARKER, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_MARKER]);
    }

    /**
     * @dataProvider onMapProvider
     */
    public function testOnMap($markerClusterType, $useMap)
    {
        $this->markerAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($markerClusterType)))
            ->will($this->returnValue(array($marker = $this->createMarkerMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.markers'),
                $this->identicalTo($marker)
            )
            ->will($this->returnValue($code = 'code'));

        $this->markerRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($marker),
                $this->identicalTo($useMap ? $map : null)
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

        $this->markerSubscriber->onMap($mapEvent);
    }

    /**
     * Gets the on map provider.
     *
     * @return array The on map provider.
     */
    public function onMapProvider()
    {
        return array(
            array(MarkerClusterType::DEFAULT_, true),
            array(MarkerClusterType::MARKER_CLUSTER, false),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param string $markerClusterType The marker cluster type.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock($markerClusterType = MarkerClusterType::DEFAULT_)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($this->createOverlaysMock($markerClusterType)));

        return $map;
    }

    /**
     * Creates a marker cluster mock.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster|\PHPUnit_Framework_MockObject_MockObject The marker cluster mock.
     */
    protected function createMarkerClusterMock($type = MarkerClusterType::DEFAULT_)
    {
        $markerCluster = parent::createMarkerClusterMock();
        $markerCluster
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue($type));

        return $markerCluster;
    }

    /**
     * Creates an overlays mock.
     *
     * @param string $markerClusterType The marker cluster type.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock($markerClusterType = MarkerClusterType::DEFAULT_)
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getMarkerCluster')
            ->will($this->returnValue($this->createMarkerClusterMock($markerClusterType)));

        return $overlays;
    }
}
