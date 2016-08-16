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
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeoJsonLayerRenderer
     */
    private $geoJsonLayerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
