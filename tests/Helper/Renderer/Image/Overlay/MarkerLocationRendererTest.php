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
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerLocationRenderer;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerLocationRendererTest extends TestCase
{
    /**
     * @var MarkerLocationRenderer
     */
    private $markerLocationRenderer;

    protected function setUp(): void
    {
        $this->markerLocationRenderer = new MarkerLocationRenderer(new CoordinateRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '1.2,2.3',
            $this->markerLocationRenderer->render(new Marker(new Coordinate(1.2, 2.3)))
        );
    }

    public function testRenderLocationAddress()
    {
        $marker = new Marker(new Coordinate());
        $marker->setStaticOption('location', 'Lille, France');

        $this->assertSame('Lille, France', $this->markerLocationRenderer->render($marker));
    }
}
