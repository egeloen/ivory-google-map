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
use Ivory\GoogleMap\Helpers\Subscribers\Overlays\GroundOverlaySubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Ground overlay subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlaySubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Overlays\GroundOverlaySubscriber */
    private $groundOverlaySubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $groundOverlayAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $groundOverlayRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->groundOverlaySubscriber = new GroundOverlaySubscriber(
            $this->formatter,
            $this->groundOverlayAggregator = $this->createGroundOverlayAggregatorMock(),
            $this->groundOverlayRenderer = $this->createGroundOverlayRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->groundOverlayRenderer);
        unset($this->groundOverlayAggregator);
        unset($this->groundOverlaySubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->groundOverlaySubscriber);
    }

    public function testDefaultState()
    {
        $this->groundOverlaySubscriber = new GroundOverlaySubscriber();

        $this->assertGroundOverlayAggregatorInstance($this->groundOverlaySubscriber->getGroundOverlayAggregator());
        $this->assertGroundOverlayRendererInstance($this->groundOverlaySubscriber->getGroundOverlayRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->groundOverlayAggregator, $this->groundOverlaySubscriber->getGroundOverlayAggregator());
        $this->assertSame($this->groundOverlayRenderer, $this->groundOverlaySubscriber->getGroundOverlayRenderer());
    }

    public function testSetGroundOverlayAggregator()
    {
        $this->groundOverlaySubscriber->setGroundOverlayAggregator($groundOverlayAggregator = $this->createGroundOverlayAggregatorMock());

        $this->assertSame($groundOverlayAggregator, $this->groundOverlaySubscriber->getGroundOverlayAggregator());
    }

    public function testSetGroundOverlayRenderer()
    {
        $this->groundOverlaySubscriber->setGroundOverlayRenderer($groundOverlayRenderer = $this->createGroundOverlayRendererMock());

        $this->assertSame($groundOverlayRenderer, $this->groundOverlaySubscriber->getGroundOverlayRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = GroundOverlaySubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY]);
    }

    public function testOnMap()
    {
        $this->groundOverlayAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($groundOverlay = $this->createGroundOverlayMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('overlays.ground_overlays'),
                $this->identicalTo($groundOverlay)
            )
            ->will($this->returnValue($code = 'code'));

        $this->groundOverlayRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($groundOverlay),
                $this->identicalTo($map)
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

        $this->groundOverlaySubscriber->onMap($mapEvent);
    }
}
