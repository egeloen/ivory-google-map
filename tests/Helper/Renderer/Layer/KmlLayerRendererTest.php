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
use Ivory\GoogleMap\Helper\Renderer\Layer\KmlLayerRenderer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Map;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KmlLayerRenderer
     */
    private $kmlLayerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerRenderer = new KmlLayerRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->kmlLayerRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $kmlLayer = new KmlLayer('url', ['foo' => 'bar']);
        $kmlLayer->setVariable('kml_layer');

        $this->assertSame(
            'kml_layer=new google.maps.KmlLayer("url",{"map":map,"foo":"bar"})',
            $this->kmlLayerRenderer->render($kmlLayer, $map)
        );
    }
}
