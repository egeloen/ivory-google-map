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
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlRendererTest extends TestCase
{
    private MapTypeControlRenderer $mapTypeControlRenderer;

    protected function setUp(): void
    {
        $this->mapTypeControlRenderer = new MapTypeControlRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new MapTypeIdRenderer($formatter),
            new ControlPositionRenderer($formatter),
            new MapTypeControlStyleRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->mapTypeControlRenderer);
        $this->assertInstanceOf(ControlRendererInterface::class, $this->mapTypeControlRenderer);
    }

    public function testMapTypeIdRenderer()
    {
        $mapTypeIdRenderer = $this->createMapTypeIdRendererMock();
        $this->mapTypeControlRenderer->setMapTypeIdRenderer($mapTypeIdRenderer);

        $this->assertSame($mapTypeIdRenderer, $this->mapTypeControlRenderer->getMapTypeIdRenderer());
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->mapTypeControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->mapTypeControlRenderer->getControlPositionRenderer());
    }

    public function testMapTypeControlStyleRenderer()
    {
        $mapTypeControlStyleRenderer = $this->createMapTypeControlStyleRendererMock();
        $this->mapTypeControlRenderer->setMapTypeControlStyleRenderer($mapTypeControlStyleRenderer);

        $this->assertSame(
            $mapTypeControlStyleRenderer,
            $this->mapTypeControlRenderer->getMapTypeControlStyleRenderer()
        );
    }

    public function testRender()
    {
        $this->assertSame(
            '{"mapTypeIds":[google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.SATELLITE],"position":google.maps.ControlPosition.TOP_RIGHT,"style":google.maps.MapTypeControlStyle.DEFAULT}',
            $this->mapTypeControlRenderer->render(new MapTypeControl())
        );
    }

    public function testRenderWithInvalidControl()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a "Ivory\GoogleMap\Control\MapTypeControl", got "string".');
        $this->mapTypeControlRenderer->render('foo');
    }

    /**
     * @return MockObject|MapTypeIdRenderer
     */
    private function createMapTypeIdRendererMock()
    {
        return $this->createMock(MapTypeIdRenderer::class);
    }

    /**
     * @return MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }

    /**
     * @return MockObject|MapTypeControlStyleRenderer
     */
    private function createMapTypeControlStyleRendererMock()
    {
        return $this->createMock(MapTypeControlStyleRenderer::class);
    }
}
