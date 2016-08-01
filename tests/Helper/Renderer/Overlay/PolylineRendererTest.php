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
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolylineRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PolylineRenderer
     */
    private $polylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineRenderer = new PolylineRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->polylineRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $coordinate1 = new Coordinate();
        $coordinate1->setVariable('coordinate1');

        $coordinate2 = new Coordinate();
        $coordinate2->setVariable('coordinate2');

        $polyline = new Polyline([$coordinate1, $coordinate2], ['foo' => 'bar']);
        $polyline->setVariable('polyline');

        $this->assertSame(
            'polyline=new google.maps.Polyline({"map":map,"path":[coordinate1,coordinate2],"foo":"bar"})',
            $this->polylineRenderer->render($polyline, $map)
        );
    }
}
