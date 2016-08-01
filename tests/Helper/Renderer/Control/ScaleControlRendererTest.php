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

use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlStyleRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlRendererTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var ScaleControlRenderer
     */
    private $scaleControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Expected a "Ivory\GoogleMap\Control\ScaleControl", got "string".
     */
    public function testRenderWithInvalidControl()
    {
        $this->scaleControlRenderer->render('foo');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ScaleControlStyleRenderer
     */
    private function createScaleControlStyleRendererMock()
    {
        return $this->createMock(ScaleControlStyleRenderer::class);
    }
}
