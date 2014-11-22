<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Layers;

use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Layers\LayersSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Layers subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayersSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Layers\LayersSubscriber */
    private $layersSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->layersSubscriber = new LayersSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->layersSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = LayersSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_LAYERS, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_LAYERS]);
    }

    public function testOnMap()
    {
        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(1))
            ->method('dispatch')
            ->will($this->returnValueMap(array(array(MapEvents::JAVASCRIPT_LAYERS_KML_LAYER, $mapEvent))));

        $this->layersSubscriber->onMap($mapEvent);
    }
}
