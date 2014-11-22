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
use Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Rotate control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer */
    private $rotateControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlRenderer = new RotateControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->rotateControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->rotateControlRenderer->getJsonBuilder());
        $this->assertControlPositionRendererInstance($this->rotateControlRenderer->getControlPositionRenderer());
    }

    public function testInitialState()
    {
        $this->rotateControlRenderer = new RotateControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->rotateControlRenderer->getJsonBuilder());
        $this->assertSame($controlPositionRenderer, $this->rotateControlRenderer->getControlPositionRenderer());
    }

    public function testSetControlPositionRenderer()
    {
        $this->rotateControlRenderer->setControlPositionRenderer(
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($controlPositionRenderer, $this->rotateControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $rotateControl = $this->createRotateControlMock();
        $rotateControl
            ->expects($this->any())
            ->method('getControlPosition')
            ->will($this->returnValue(ControlPosition::BOTTOM_CENTER));

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->rotateControlRenderer->render($rotateControl)
        );
    }
}
