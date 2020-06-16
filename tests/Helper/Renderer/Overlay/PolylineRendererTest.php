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
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineRendererTest extends TestCase
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

        $iconSequence = new IconSequence(new Symbol(SymbolPath::CIRCLE), ['baz' => 'bat']);
        $iconSequence->setVariable('icon_sequence');

        $polyline = new Polyline([$coordinate1, $coordinate2], [$iconSequence], ['foo' => 'bar']);
        $polyline->setVariable('polyline');

        $this->assertSame(
            'polyline=new google.maps.Polyline({"map":map,"path":[coordinate1,coordinate2],"icons":[icon_sequence],"foo":"bar"})',
            $this->polylineRenderer->render($polyline, $map)
        );
    }
}
