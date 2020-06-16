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

use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\PolylineStyleRenderer;
use Ivory\GoogleMap\Overlay\Polyline;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineStyleRendererTest extends TestCase
{
    /**
     * @var PolylineStyleRenderer
     */
    private $polylineStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineStyleRenderer = new PolylineStyleRenderer();
    }

    public function testRender()
    {
        $polyline = new Polyline();
        $polyline->setStaticOption('styles', [
            'color'  => 'blue',
            'weight' => 2,
        ]);

        $this->assertSame(
            'color:blue|weight:2',
            $this->polylineStyleRenderer->render($polyline)
        );
    }

    public function testRenderWithOptions()
    {
        $polyline = new Polyline();
        $polyline->setOptions([
            'geodisc'      => true,
            'strokeColor'  => 'blue',
            'strokeWeight' => 2,
        ]);

        $this->assertSame(
            'color:blue|geodesic:1|weight:2',
            $this->polylineStyleRenderer->render($polyline)
        );
    }

    public function testRenderEmpty()
    {
        $this->assertNull($this->polylineStyleRenderer->render(new Polyline()));
    }
}
