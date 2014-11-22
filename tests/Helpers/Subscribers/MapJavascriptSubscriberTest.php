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

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\MapJavascriptSubscriber;

/**
 * Map javascript subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapJavascriptSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapJavascriptSubscriber */
    private $mapJavascriptSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapJavascriptSubscriber = new MapJavascriptSubscriber($this->formatter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapJavascriptSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapJavascriptSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT_MAP, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT_MAP]);

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT]);
    }

    public function testOnApi()
    {
        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(3))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE, $apiEvent),
                array(ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW, $apiEvent),
                array(ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER, $apiEvent),
            )));

        $apiEvent
            ->expects($this->once())
            ->method('getItems')
            ->with($this->identicalTo(ApiEvent::MAP))
            ->will($this->returnValue(array($map = $this->createMapMock($libraries = array('foo')))));

        $this->formatter
            ->expects($this->once())
            ->method('formatAssetCallback')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($callback = 'callback'));

        $apiEvent
            ->expects($this->once())
            ->method('addCallback')
            ->with($this->identicalTo($callback));

        $apiEvent
            ->expects($this->once())
            ->method('setLanguage')
            ->with($this->identicalTo('fr'));

        $apiEvent
            ->expects($this->once())
            ->method('addLibraries')
            ->with($this->identicalTo($libraries));

        $this->mapJavascriptSubscriber->onApi($apiEvent);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(7))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(MapEvents::JAVASCRIPT_INIT, $mapEvent),
                array(MapEvents::JAVASCRIPT_BASE, $mapEvent),
                array(MapEvents::JAVASCRIPT_MAP, $mapEvent),
                array(MapEvents::JAVASCRIPT_OVERLAYS, $mapEvent),
                array(MapEvents::JAVASCRIPT_LAYERS, $mapEvent),
                array(MapEvents::JAVASCRIPT_EVENTS, $mapEvent),
                array(MapEvents::JAVASCRIPT_FINISH, $mapEvent),
            )));

        $mapEvent
            ->expects($this->any())
            ->method('getCode')
            ->will($this->returnValue($code = 'code'));

        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map = $this->createMapMock()));

        $this->formatter
            ->expects($this->once())
            ->method('formatAssetCallback')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($callback = 'callback'));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunction')
            ->with(
                $this->identicalTo($code),
                $this->identicalTo(array()),
                $this->identicalTo($callback)
            )
            ->will($this->returnValue($function = 'function'));

        $this->formatter
            ->expects($this->once())
            ->method('formatJavascript')
            ->with($this->identicalTo($function))
            ->will($this->returnValue($javascript = 'javascript'));

        $mapEvent
            ->expects($this->once())
            ->method('setCode')
            ->will($this->returnValue($javascript));

        $this->mapJavascriptSubscriber->onMap($mapEvent);
    }

    /**
     * Creates a map mock.
     *
     * @param array $libraries The libraries.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $libraries = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getLibraries')
            ->will($this->returnValue($libraries));

        $map
            ->expects($this->any())
            ->method('getLanguage')
            ->will($this->returnValue('fr'));

        return $map;
    }
}
