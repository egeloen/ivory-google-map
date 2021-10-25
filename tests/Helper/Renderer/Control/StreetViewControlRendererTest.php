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

use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Control\StreetViewControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\StreetViewControlRenderer;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlRendererTest extends TestCase
{
    /**
     * @var StreetViewControlRenderer
     */
    private $streetViewControlRenderer;

    protected function setUp(): void
    {
        $this->streetViewControlRenderer = new StreetViewControlRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new ControlPositionRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->streetViewControlRenderer);
        $this->assertInstanceOf(ControlRendererInterface::class, $this->streetViewControlRenderer);
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->streetViewControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->streetViewControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '{"position":google.maps.ControlPosition.TOP_LEFT}',
            $this->streetViewControlRenderer->render(new StreetViewControl())
        );
    }

    /**
     */
    public function testRenderWithInvalidControl()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a "Ivory\GoogleMap\Control\StreetViewControl", got "string".');
        $this->streetViewControlRenderer->render('foo');
    }

    /**
     * @return MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }
}
