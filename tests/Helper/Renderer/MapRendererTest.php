<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlManagerRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapRenderer
     */
    private $mapRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapRenderer = new MapRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new MapTypeIdRenderer($formatter),
            new ControlManagerRenderer(),
            new RequirementRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->mapRenderer);
    }

    public function testMapTypeIdRenderer()
    {
        $this->mapRenderer->setMapTypeIdRenderer($mapTypeIdRenderer = $this->createMapTypeIdRendererMock());

        $this->assertSame($mapTypeIdRenderer, $this->mapRenderer->getMapTypeIdRenderer());
    }

    public function testControlManagerRenderer()
    {
        $controlManagerRenderer = $this->createControlManagerRendererMock();
        $this->mapRenderer->setControlManagerRenderer($controlManagerRenderer);

        $this->assertSame($controlManagerRenderer, $this->mapRenderer->getControlManagerRenderer());
    }

    public function testRequirementRenderer()
    {
        $this->mapRenderer->setRequirementRenderer($requirementRenderer = $this->createRequirementRendererMock());

        $this->assertSame($requirementRenderer, $this->mapRenderer->getRequirementRenderer());
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->setMapOptions(['foo' => 'bar']);

        $this->assertSame(
            'map=new google.maps.Map(document.getElementById("map_canvas"),{"mapTypeId":google.maps.MapTypeId.ROADMAP,"foo":"bar","zoom":3})',
            $this->mapRenderer->render($map)
        );
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->setAutoZoom(true);

        $this->assertSame(
            'map=new google.maps.Map(document.getElementById("map_canvas"),{"mapTypeId":google.maps.MapTypeId.ROADMAP})',
            $this->mapRenderer->render($map)
        );
    }

    public function testRenderWithExplicitZoom()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->setMapOption('zoom', 5);

        $this->assertSame(
            'map=new google.maps.Map(document.getElementById("map_canvas"),{"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":5})',
            $this->mapRenderer->render($map)
        );
    }

    public function testRenderWithExplicitMapTypeId()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->setMapOption('mapTypeId', MapTypeId::HYBRID);

        $this->assertSame(
            'map=new google.maps.Map(document.getElementById("map_canvas"),{"mapTypeId":google.maps.MapTypeId.HYBRID,"zoom":3})',
            $this->mapRenderer->render($map)
        );
    }

    public function testRenderRequirement()
    {
        $this->assertSame('typeof google.maps!==typeof undefined', $this->mapRenderer->renderRequirement());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MapTypeIdRenderer
     */
    private function createMapTypeIdRendererMock()
    {
        return $this->createMock(MapTypeIdRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlManagerRenderer
     */
    private function createControlManagerRendererMock()
    {
        return $this->createMock(ControlManagerRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequirementRenderer
     */
    private function createRequirementRendererMock()
    {
        return $this->createMock(RequirementRenderer::class);
    }
}
