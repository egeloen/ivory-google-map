<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolygonRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PolygonRenderer
     */
    private $polygonRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygonRenderer = new PolygonRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->polygonRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $coordinate1 = new Coordinate();
        $coordinate1->setVariable('coordinate1');

        $coordinate2 = new Coordinate();
        $coordinate2->setVariable('coordinate2');

        $polygon = new Polygon([$coordinate1, $coordinate2], ['foo' => 'bar']);
        $polygon->setVariable('polygon');

        $this->assertSame(
            'polygon=new google.maps.Polygon({"map":map,"paths":[coordinate1,coordinate2],"foo":"bar"})',
            $this->polygonRenderer->render($polygon, $map)
        );
    }
}
