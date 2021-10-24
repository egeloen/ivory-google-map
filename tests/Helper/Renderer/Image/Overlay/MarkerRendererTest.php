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
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerLocationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerStyleRenderer;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRendererTest extends TestCase
{
    /**
     * @var MarkerRenderer
     */
    private $markerRenderer;

    protected function setUp(): void
    {
        $this->markerRenderer = new MarkerRenderer(
            new MarkerStyleRenderer(new PointRenderer()),
            new MarkerLocationRenderer(new CoordinateRenderer())
        );
    }

    public function testRender()
    {
        $this->assertSame(
            '1.2,2.3|2.2,3.3',
            $this->markerRenderer->render([
                new Marker(new Coordinate(1.2, 2.3)),
                new Marker(new Coordinate(2.2, 3.3)),
            ])
        );
    }

    public function testRenderWithStyles()
    {
        $styles = [
            'size'   => 'tiny',
            'color'  => 'blue',
        ];

        $marker1 = new Marker(new Coordinate(1.2, 2.3));
        $marker1->setStaticOption('styles', $styles);

        $marker2 = new Marker(new Coordinate(2.2, 3.3));
        $marker2->setStaticOption('styles', $styles);

        $this->assertSame(
            'color:blue|size:tiny|1.2,2.3|2.2,3.3',
            $this->markerRenderer->render([$marker1, $marker2])
        );
    }
}
