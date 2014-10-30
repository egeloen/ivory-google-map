<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Zoom control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer */
    private $zoomControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlRenderer = new ZoomControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->zoomControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->zoomControlRenderer->getJsonBuilder());
        $this->assertControlPositionRendererInstance($this->zoomControlRenderer->getControlPositionRenderer());
        $this->assertZoomControlStyleRendererInstance($this->zoomControlRenderer->getZoomControlStyleRenderer());
    }

    public function testInitialState()
    {
        $this->zoomControlRenderer = new ZoomControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $controlPositionRenderer = $this->createControlPositionRendererMock(),
            $zoomControlStyleRenderer = $this->createZoomControlStyleRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->zoomControlRenderer->getJsonBuilder());
        $this->assertSame($controlPositionRenderer, $this->zoomControlRenderer->getControlPositionRenderer());
        $this->assertSame($zoomControlStyleRenderer, $this->zoomControlRenderer->getZoomControlStyleRenderer());
    }

    public function testSetControlPositionRenderer()
    {
        $this->zoomControlRenderer->setControlPositionRenderer(
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($controlPositionRenderer, $this->zoomControlRenderer->getControlPositionRenderer());
    }

    public function testSetZoomControlStyleRenderer()
    {
        $this->zoomControlRenderer->setZoomControlStyleRenderer(
            $zoomControlStyleRenderer = $this->createZoomControlStyleRendererMock()
        );

        $this->assertSame($zoomControlStyleRenderer, $this->zoomControlRenderer->getZoomControlStyleRenderer());
    }

    public function testRender()
    {
        $zoomControl = $this->createZoomControlMock();
        $zoomControl
            ->expects($this->any())
            ->method('getControlPosition')
            ->will($this->returnValue(ControlPosition::BOTTOM_CENTER));

        $zoomControl
            ->expects($this->any())
            ->method('getZoomControlStyle')
            ->will($this->returnValue(ZoomControlStyle::DEFAULT_));

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ZoomControlStyle.DEFAULT}',
            $this->zoomControlRenderer->render($zoomControl)
        );
    }
}
