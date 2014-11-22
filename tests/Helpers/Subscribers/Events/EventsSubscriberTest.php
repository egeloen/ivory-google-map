<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Events;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Events\EventsSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Events subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventsSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Events\EventsSubscriber */
    private $eventsSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventsSubscriber = new EventsSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventsSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = EventsSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_EVENTS, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_EVENTS]);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(4))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT, $mapEvent),
                array(MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE, $mapEvent),
                array(MapEvents::JAVASCRIPT_EVENTS_EVENT, $mapEvent),
                array(MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE, $mapEvent),
            )));

        $this->eventsSubscriber->onMap($mapEvent);
    }
}
