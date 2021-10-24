<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Image;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineLocationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineStyleRenderer;
use Ivory\GoogleMap\Overlay\Polyline;
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

    protected function setUp(): void
    {
        $this->polylineRenderer = new PolylineRenderer(
            new PolylineStyleRenderer(),
            new PolylineLocationRenderer(new CoordinateRenderer())
        );
    }

    public function testRender()
    {
        $polyline = new Polyline([
            new Coordinate(1.234, 2.345),
            new Coordinate(2.234, 3.345),
            new Coordinate(4.234, 4.345),
        ]);

        $this->assertSame(
            '1.234,2.345|2.234,3.345|4.234,4.345',
            $this->polylineRenderer->render($polyline)
        );
    }

    public function testRenderWithStyles()
    {
        $polyline = new Polyline([
            new Coordinate(1.234, 2.345),
            new Coordinate(2.234, 3.345),
            new Coordinate(4.234, 4.345),
        ]);

        $polyline->setStaticOption('styles', [
            'color'  => 'blue',
            'weight' => 2,
        ]);

        $this->assertSame(
            'color:blue|weight:2|1.234,2.345|2.234,3.345|4.234,4.345',
            $this->polylineRenderer->render($polyline)
        );
    }
}
