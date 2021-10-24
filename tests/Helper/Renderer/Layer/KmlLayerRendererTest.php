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
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerRendererTest extends TestCase
{
    /**
     * @var KmlLayerRenderer
     */
    private $kmlLayerRenderer;

    protected function setUp(): void
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
