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

use Ivory\GoogleMap\Control\RotateControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\RotateControlRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RotateControlRenderer
     */
    private $rotateControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlRenderer = new RotateControlRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new ControlPositionRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->rotateControlRenderer);
        $this->assertInstanceOf(ControlRendererInterface::class, $this->rotateControlRenderer);
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->rotateControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->rotateControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '{"position":google.maps.ControlPosition.TOP_LEFT}',
            $this->rotateControlRenderer->render(new RotateControl())
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Expected a "Ivory\GoogleMap\Control\RotateControl", got "string".
     */
    public function testRenderWithInvalidControl()
    {
        $this->rotateControlRenderer->render('foo');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }
}
