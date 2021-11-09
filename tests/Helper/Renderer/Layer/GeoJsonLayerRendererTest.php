<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Layer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Layer\GeoJsonLayerRenderer;
use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Map;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerRendererTest extends TestCase
{
    private GeoJsonLayerRenderer $geoJsonLayerRenderer;

    protected function setUp(): void
    {
        $this->geoJsonLayerRenderer = new GeoJsonLayerRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->geoJsonLayerRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $geoJsonLayer = new GeoJsonLayer('url', ['foo' => 'bar']);

        $this->assertSame(
            'map.data.loadGeoJson("url",{"foo":"bar"})',
            $this->geoJsonLayerRenderer->render($geoJsonLayer, $map)
        );
    }
}
