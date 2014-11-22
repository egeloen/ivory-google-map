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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\OverlaysSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Overlays subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlaysSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\OverlaysSubscriber */
    private $overlaysSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overlaysSubscriber = new OverlaysSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overlaysSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = OverlaysSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS]);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(11))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_ICON, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_MARKER, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER, $mapEvent),
            )));

        $this->overlaysSubscriber->onMap($mapEvent);
    }
}
