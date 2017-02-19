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

use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineStyleRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineStyleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolylineStyleRenderer
     */
    private $encodedPolylineStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineStyleRenderer = new EncodedPolylineStyleRenderer();
    }

    public function testRender()
    {
        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setStaticOption('styles', [
            'color'  => 'blue',
            'weight' => 2,
        ]);

        $this->assertSame(
            'color:blue|weight:2',
            $this->encodedPolylineStyleRenderer->render($encodedPolyline)
        );
    }

    public function testRenderWithOptions()
    {
        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setOptions([
            'geodisc'      => true,
            'strokeColor'  => 'blue',
            'strokeWeight' => 2,
        ]);

        $this->assertSame(
            'color:blue|geodesic:1|weight:2',
            $this->encodedPolylineStyleRenderer->render($encodedPolyline)
        );
    }

    public function testRenderEmpty()
    {
        $this->assertNull($this->encodedPolylineStyleRenderer->render(new EncodedPolyline('foo')));
    }
}
