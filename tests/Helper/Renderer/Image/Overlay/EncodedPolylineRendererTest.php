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

use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineValueRenderer;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRendererTest extends TestCase
{
    /**
     * @var EncodedPolylineRenderer
     */
    private $encodedPolylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineRenderer = new EncodedPolylineRenderer(
            new EncodedPolylineStyleRenderer(),
            new EncodedPolylineValueRenderer()
        );
    }

    public function testRender()
    {
        $this->assertSame(
            'enc:foo',
            $this->encodedPolylineRenderer->render(new EncodedPolyline('foo'))
        );
    }

    public function testRenderWithOptions()
    {
        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setStaticOption('styles', [
            'color'  => 'blue',
            'weight' => 2,
        ]);

        $this->assertSame(
            'color:blue|weight:2|enc:foo',
            $this->encodedPolylineRenderer->render($encodedPolyline)
        );
    }
}
