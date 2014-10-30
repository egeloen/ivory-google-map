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
use Ivory\GoogleMap\Helpers\Subscribers\MapSubscriber;

/**
 * Map subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\MapSubscriber */
    private $mapSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $mapRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapSubscriber = new MapSubscriber(
            $this->formatter,
            $this->mapRenderer = $this->createMapRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->mapRenderer);
        unset($this->mapSubscriber);
    }

    public function testUnheritance()
    {
        $this->assertFormatterSubscriberInstance($this->mapSubscriber);
    }

    public function testDefaultState()
    {
        $this->mapSubscriber = new MapSubscriber();

        $this->assertFormatterInstance($this->mapSubscriber->getFormatter());
        $this->assertMapRendererInstance($this->mapSubscriber->getMapRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->mapSubscriber->getFormatter());
        $this->assertSame($this->mapRenderer, $this->mapSubscriber->getMapRenderer());
    }

    public function testSetMapRenderer()
    {
        $this->mapSubscriber->setMapRenderer($mapRenderer = $this->createMapRendererMock());

        $this->assertSame($mapRenderer, $this->mapSubscriber->getMapRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = MapSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_MAP, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_MAP]);
    }

    public function testOnMap()
    {
        $this->mapRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render),
                $this->identicalTo('map'),
                $this->identicalTo($map),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($code = 'code'));

        $mapEvent = $this->createMapEventMock();
        $mapEvent
            ->expects($this->any())
            ->method('getMap')
            ->will($this->returnValue($map));

        $mapEvent
            ->expects($this->any())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->mapSubscriber->onMap($mapEvent);
    }
}
