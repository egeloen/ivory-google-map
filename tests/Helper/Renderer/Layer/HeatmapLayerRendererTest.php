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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Layer\HeatmapLayerRenderer;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Map;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HeatmapLayerRenderer
     */
    private $heatmapLayerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->heatmapLayerRenderer = new HeatmapLayerRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->heatmapLayerRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $coordinate1 = new Coordinate();
        $coordinate1->setVariable('coordinate1');

        $coordinate2 = new Coordinate();
        $coordinate2->setVariable('coordinate2');

        $heatmapLayer = new HeatmapLayer([$coordinate1, $coordinate2], ['dissipating' => true]);
        $heatmapLayer->setVariable('heatmap_layer');

        $this->assertSame(
            'heatmap_layer=new google.maps.visualization.HeatmapLayer({"data":[coordinate1,coordinate2],"map":map,"dissipating":true})',
            $this->heatmapLayerRenderer->render($heatmapLayer, $map)
        );
    }

    public function testRenderRequirement()
    {
        $this->assertSame('google.maps.visualization', $this->heatmapLayerRenderer->renderRequirement());
    }
}
