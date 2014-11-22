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
use Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Pan control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer */
    private $panControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControlRenderer = new PanControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->panControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->panControlRenderer->getJsonBuilder());
        $this->assertControlPositionRendererInstance($this->panControlRenderer->getControlPositionRenderer());
    }

    public function testInitialState()
    {
        $this->panControlRenderer = new PanControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->panControlRenderer->getJsonBuilder());
        $this->assertSame($controlPositionRenderer, $this->panControlRenderer->getControlPositionRenderer());
    }

    public function testSetControlPositionRenderer()
    {
        $this->panControlRenderer->setControlPositionRenderer(
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($controlPositionRenderer, $this->panControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $panControl = $this->createPanControlMock();
        $panControl
            ->expects($this->any())
            ->method('getControlPosition')
            ->will($this->returnValue(ControlPosition::BOTTOM_CENTER));

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->panControlRenderer->render($panControl)
        );
    }
}
