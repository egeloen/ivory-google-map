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
use Ivory\GoogleMap\Helpers\Subscribers\Layers\KmlLayerSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Kml layer subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Layers\KmlLayerSubscriber */
    private $kmlLayerSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $kmlLayerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $kmlLayerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->kmlLayerSubscriber = new KmlLayerSubscriber(
            $this->formatter,
            $this->kmlLayerAggregator = $this->createKmlLayerAggregatorMock(),
            $this->kmlLayerRenderer = $this->createKmlLayerRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->kmlLayerRenderer);
        unset($this->kmlLayerAggregator);
        unset($this->kmlLayerSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->kmlLayerSubscriber);
    }

    public function testDefaultState()
    {
        $this->kmlLayerSubscriber = new KmlLayerSubscriber();

        $this->assertKmlLayerAggregatorInstance($this->kmlLayerSubscriber->getKmlLayerAggregator());
        $this->assertKmlLayerRendererInstance($this->kmlLayerSubscriber->getKmlLayerRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->kmlLayerAggregator, $this->kmlLayerSubscriber->getKmlLayerAggregator());
        $this->assertSame($this->kmlLayerRenderer, $this->kmlLayerSubscriber->getKmlLayerRenderer());
    }

    public function testSetKmlLayerAggregator()
    {
        $this->kmlLayerSubscriber->setKmlLayerAggregator($kmlLayerAggregator = $this->createKmlLayerAggregatorMock());

        $this->assertSame($kmlLayerAggregator, $this->kmlLayerSubscriber->getKmlLayerAggregator());
    }

    public function testSetKmlLayerRenderer()
    {
        $this->kmlLayerSubscriber->setKmlLayerRenderer($kmlLayerRenderer = $this->createKmlLayerRendererMock());

        $this->assertSame($kmlLayerRenderer, $this->kmlLayerSubscriber->getKmlLayerRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = KmlLayerSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(MapEvents::JAVASCRIPT_LAYERS_KML_LAYER, $subscribedEvents);
        $this->assertSame('onMap', $subscribedEvents[MapEvents::JAVASCRIPT_LAYERS_KML_LAYER]);
    }

    public function testOnMap()
    {
        $this->kmlLayerAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue(array($kmlLayer = $this->createKmlLayerMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($map),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('layers.kml_layers'),
                $this->identicalTo($kmlLayer)
            )
            ->will($this->returnValue($code = 'code'));

        $this->kmlLayerRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($kmlLayer),
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

        $this->kmlLayerSubscriber->onMap($mapEvent);
    }
}
