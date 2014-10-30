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
use Ivory\GoogleMap\Helpers\Subscribers\MapContainerSubscriber;

/**
 * Map container subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapContainerSubscriber */
    private $mapContainerSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $mapContainerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapContainerSubscriber = new MapContainerSubscriber(
            $this->formatter,
            $this->mapContainerRenderer = $this->createMapContainerRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapContainerRenderer);
        unset($this->mapContainerSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapContainerSubscriber);
    }

    public function testDefaultState()
    {
        $this->assertFormatterInstance($this->mapContainerSubscriber->getFormatter());
        $this->assertMapContainerRendererInstance($this->mapContainerSubscriber->getContainerRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->mapContainerSubscriber->getFormatter());
        $this->assertSame($this->mapContainerRenderer, $this->mapContainerSubscriber->getContainerRenderer());
    }

    public function testSetContainerRenderer()
    {
        $this->mapContainerSubscriber->setContainerRenderer(
            $containerRenderer = $this->createMapContainerRendererMock()
        );

        $this->assertSame($containerRenderer, $this->mapContainerSubscriber->getContainerRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapContainerSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_INIT_CONTAINER, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_INIT_CONTAINER]);
    }

    public function testOnMap()
    {
        $this->mapContainerRenderer
            ->expects($this->once())
            ->method('render')
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with($this->identicalTo($map = $this->createMapMock()), $this->identicalTo($render))
            ->will($this->returnValue($code = 'code'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->mapContainerSubscriber->onMap($mapEvent);
    }
}
