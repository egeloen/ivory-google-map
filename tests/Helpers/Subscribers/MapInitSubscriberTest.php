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
use Ivory\GoogleMap\Helpers\Subscribers\MapInitSubscriber;

/**
 * Map init subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapInitSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapInitSubscriber */
    private $mapInitSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapInitSubscriber = new MapInitSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapInitSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapInitSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_INIT, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_INIT]);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT, $mapEvent),
                array(MapEvents::JAVASCRIPT_INIT_CONTAINER, $mapEvent),
            )));

        $this->mapInitSubscriber->onMap($mapEvent);
    }
}
