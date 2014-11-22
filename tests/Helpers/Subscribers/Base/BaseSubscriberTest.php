<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Base;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Base\BaseSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Base subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BaseSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Base\BaseSubscriber */
    private $baseSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->baseSubscriber = new BaseSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->baseSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = BaseSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_BASE, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_BASE]);
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
                array(MapEvents::JAVASCRIPT_BASE_COORDINATE, $mapEvent),
                array(MapEvents::JAVASCRIPT_BASE_BOUND, $mapEvent),
                array(MapEvents::JAVASCRIPT_BASE_POINT, $mapEvent),
                array(MapEvents::JAVASCRIPT_BASE_SIZE, $mapEvent),
            )));

        $this->baseSubscriber->onMap($mapEvent);
    }
}
