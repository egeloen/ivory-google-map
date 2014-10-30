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
use Ivory\GoogleMap\Helpers\Subscribers\MapFinishSubscriber;

/**
 * Map finish subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapFinishSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapFinishSubscriber */
    private $mapFinishSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapFinishSubscriber = new MapFinishSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapFinishSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapFinishSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_FINISH, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_FINISH]);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(5))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE, $mapEvent),
                array(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN, $mapEvent),
                array(MapEvents::JAVASCRIPT_FINISH_EXTENDABLE, $mapEvent),
                array(MapEvents::JAVASCRIPT_FINISH_MAP_BOUND, $mapEvent),
                array(MapEvents::JAVASCRIPT_FINISH_MAP_CENTER, $mapEvent),
            )));

        $this->mapFinishSubscriber->onMap($mapEvent);
    }
}
