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
use Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Street view control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer */
    private $streetViewControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControlRenderer = new StreetViewControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->streetViewControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->streetViewControlRenderer->getJsonBuilder());
        $this->assertControlPositionRendererInstance($this->streetViewControlRenderer->getControlPositionRenderer());
    }

    public function testInitialState()
    {
        $this->streetViewControlRenderer = new StreetViewControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->streetViewControlRenderer->getJsonBuilder());
        $this->assertSame($controlPositionRenderer, $this->streetViewControlRenderer->getControlPositionRenderer());
    }

    public function testSetControlPositionRenderer()
    {
        $this->streetViewControlRenderer->setControlPositionRenderer(
            $controlPositionRenderer = $this->createControlPositionRendererMock()
        );

        $this->assertSame($controlPositionRenderer, $this->streetViewControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $streetViewControl = $this->createStreetViewControlMock();
        $streetViewControl
            ->expects($this->any())
            ->method('getControlPosition')
            ->will($this->returnValue(ControlPosition::BOTTOM_CENTER));

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->streetViewControlRenderer->render($streetViewControl)
        );
    }
}
