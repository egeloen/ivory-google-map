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

use PHPUnit\Framework\MockObject\MockObject;
use InvalidArgumentException;
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlStyleRenderer;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlRendererTest extends TestCase
{
    private ?ScaleControlRenderer $scaleControlRenderer = null;

    protected function setUp(): void
    {
        $this->scaleControlRenderer = new ScaleControlRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new ControlPositionRenderer($formatter),
            new ScaleControlStyleRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->scaleControlRenderer);
        $this->assertInstanceOf(ControlRendererInterface::class, $this->scaleControlRenderer);
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->scaleControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->scaleControlRenderer->getControlPositionRenderer());
    }

    public function testScaleControlStyleRenderer()
    {
        $scaleControlStyleRenderer = $this->createScaleControlStyleRendererMock();
        $this->scaleControlRenderer->setScaleControlStyleRenderer($scaleControlStyleRenderer);

        $this->assertSame($scaleControlStyleRenderer, $this->scaleControlRenderer->getScaleControlStyleRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_LEFT,"style":google.maps.ScaleControlStyle.DEFAULT}',
            $this->scaleControlRenderer->render(new ScaleControl())
        );
    }

    /**
     */
    public function testRenderWithInvalidControl()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a "Ivory\GoogleMap\Control\ScaleControl", got "string".');
        $this->scaleControlRenderer->render('foo');
    }

    /**
     * @return MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }

    /**
     * @return MockObject|ScaleControlStyleRenderer
     */
    private function createScaleControlStyleRendererMock()
    {
        return $this->createMock(ScaleControlStyleRenderer::class);
    }
}
