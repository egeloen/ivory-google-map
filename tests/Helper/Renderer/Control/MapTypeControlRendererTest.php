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

use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapTypeControlRenderer
     */
    private $mapTypeControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Expected a "Ivory\GoogleMap\Control\MapTypeControl", got "string".
     */
    public function testRenderWithInvalidControl()
    {
        $this->mapTypeControlRenderer->render('foo');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MapTypeIdRenderer
     */
    private function createMapTypeIdRendererMock()
    {
        return $this->createMock(MapTypeIdRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MapTypeControlStyleRenderer
     */
    private function createMapTypeControlStyleRendererMock()
    {
        return $this->createMock(MapTypeControlStyleRenderer::class);
    }
}
