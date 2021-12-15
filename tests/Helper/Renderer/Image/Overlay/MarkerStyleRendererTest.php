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
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerStyleRenderer;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerStyleRendererTest extends TestCase
{
    private MarkerStyleRenderer $markerStyleRenderer;

    protected function setUp(): void
    {
        $this->markerStyleRenderer = new MarkerStyleRenderer(new PointRenderer());
    }

    public function testRender()
    {
        $marker = new Marker(new Coordinate());
        $marker->setStaticOption('styles', [
            'anchor' => 'bottomright',
            'size'   => 'tiny',
            'color'  => 'blue',
        ]);

        $this->assertSame(
            'anchor:bottomright|color:blue|size:tiny',
            $this->markerStyleRenderer->render($marker)
        );
    }

    public function testRenderWithIcon()
    {
        $marker = new Marker(new Coordinate());
        $marker->setIcon(new Icon('http://maps.google.com/mapfiles/ms/icons/blue-pushpin.png', new Point()));

        $this->assertSame(
            'anchor:0,0|icon:http://maps.google.com/mapfiles/ms/icons/blue-pushpin.png',
            $this->markerStyleRenderer->render($marker)
        );
    }

    public function testRenderEmpty()
    {
        $this->assertNull($this->markerStyleRenderer->render(new Marker(new Coordinate())));
    }
}
