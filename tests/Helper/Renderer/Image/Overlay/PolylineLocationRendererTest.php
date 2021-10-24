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
use Ivory\GoogleMap\Overlay\Polyline;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineLocationRendererTest extends TestCase
{
    /**
     * @var PolylineLocationRenderer
     */
    private $polylineLocationRenderer;

    protected function setUp(): void
    {
        $this->polylineLocationRenderer = new PolylineLocationRenderer(new CoordinateRenderer());
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
            $this->polylineLocationRenderer->render($polyline)
        );
    }

    public function testRenderLocationAddress()
    {
        $polyline = new Polyline([]);
        $polyline->setStaticOption('locations', ['foo', 'bar', 'baz']);

        $this->assertSame(
            'foo|bar|baz',
            $this->polylineLocationRenderer->render($polyline)
        );
    }

    public function testRenderLocationMixed()
    {
        $polyline = new Polyline([]);
        $polyline->setStaticOption('locations', ['foo', new Coordinate(), 'bar']);

        $this->assertSame(
            'foo|0,0|bar',
            $this->polylineLocationRenderer->render($polyline)
        );
    }
}
