<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Control\RotateControl;
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Control\StreetViewControl;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlManagerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\RotateControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\StreetViewControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlManagerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControlManagerRenderer
     */
    private $controlManagerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlManagerRenderer = new ControlManagerRenderer();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->controlManagerRenderer->hasRenderers());
        $this->assertEmpty($this->controlManagerRenderer->getRenderers());
    }

    public function testSetRenderers()
    {
        $this->controlManagerRenderer->setRenderers($renderers = [$renderer = $this->createControlRendererMock()]);
        $this->controlManagerRenderer->setRenderers($renderers);

        $this->assertTrue($this->controlManagerRenderer->hasRenderers());
        $this->assertTrue($this->controlManagerRenderer->hasRenderer($renderer));
        $this->assertSame($renderers, $this->controlManagerRenderer->getRenderers());
    }

    public function testAddRenderers()
    {
        $this->controlManagerRenderer->setRenderers($firstRenderers = [$this->createControlRendererMock()]);
        $this->controlManagerRenderer->addRenderers($secondRenderers = [$this->createControlRendererMock()]);

        $this->assertTrue($this->controlManagerRenderer->hasRenderers());
        $this->assertSame(
            array_merge($firstRenderers, $secondRenderers),
            $this->controlManagerRenderer->getRenderers()
        );
    }

    public function testAddRenderer()
    {
        $this->controlManagerRenderer->addRenderer($renderer = $this->createControlRendererMock());

        $this->assertTrue($this->controlManagerRenderer->hasRenderers());
        $this->assertTrue($this->controlManagerRenderer->hasRenderer($renderer));
        $this->assertSame([$renderer], $this->controlManagerRenderer->getRenderers());
    }

    public function testRemoveRenderer()
    {
        $this->controlManagerRenderer->addRenderer($renderer = $this->createControlRendererMock());
        $this->controlManagerRenderer->removeRenderer($renderer);

        $this->assertFalse($this->controlManagerRenderer->hasRenderers());
        $this->assertFalse($this->controlManagerRenderer->hasRenderer($renderer));
        $this->assertEmpty($this->controlManagerRenderer->getRenderers());
    }

    public function testRender()
    {
        $this->controlManagerRenderer->addRenderers([
            new MapTypeControlRenderer(
                $formatter = new Formatter(),
                $jsonBuilder = new JsonBuilder(),
                new MapTypeIdRenderer($formatter),
                $controlPositionRenderer = new ControlPositionRenderer($formatter),
                new MapTypeControlStyleRenderer($formatter)
            ),
            new RotateControlRenderer($formatter, $jsonBuilder, $controlPositionRenderer),
            new ScaleControlRenderer(
                $formatter,
                $jsonBuilder,
                $controlPositionRenderer,
                new ScaleControlStyleRenderer($formatter)
            ),
            new StreetViewControlRenderer($formatter, $jsonBuilder, $controlPositionRenderer),
            new ZoomControlRenderer(
                $formatter,
                $jsonBuilder,
                $controlPositionRenderer,
                new ZoomControlStyleRenderer($formatter)
            ),
        ]);

        $controlManager = new ControlManager();
        $controlManager->setMapTypeControl(new MapTypeControl());
        $controlManager->setRotateControl(new RotateControl());
        $controlManager->setScaleControl(new ScaleControl());
        $controlManager->setStreetViewControl(new StreetViewControl());
        $controlManager->setZoomControl(new ZoomControl());

        $this->controlManagerRenderer->render($controlManager, $jsonBuilder = new JsonBuilder());

        $this->assertSame(
            '{"mapTypeControl":true,"mapTypeControlOptions":{"mapTypeIds":[google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.SATELLITE],"position":google.maps.ControlPosition.TOP_RIGHT,"style":google.maps.MapTypeControlStyle.DEFAULT},"rotateControl":true,"rotateControlOptions":{"position":google.maps.ControlPosition.TOP_LEFT},"scaleControl":true,"scaleControlOptions":{"position":google.maps.ControlPosition.BOTTOM_LEFT,"style":google.maps.ScaleControlStyle.DEFAULT},"streetViewControl":true,"streetViewControlOptions":{"position":google.maps.ControlPosition.TOP_LEFT},"zoomControl":true,"zoomControlOptions":{"position":google.maps.ControlPosition.TOP_LEFT,"style":google.maps.ZoomControlStyle.DEFAULT}}',
            $jsonBuilder->build()
        );
    }

    public function testRenderWithoutControls()
    {
        $this->controlManagerRenderer->render(new ControlManager(), $jsonBuilder = new JsonBuilder());

        $this->assertSame('[]', $jsonBuilder->build());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlRendererInterface
     */
    private function createControlRendererMock()
    {
        return $this->createMock(ControlRendererInterface::class);
    }
}
