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

use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\EncodedPolylineValueRenderer;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineValueRendererTest extends TestCase
{
    private EncodedPolylineValueRenderer $encodedPolylineValueRenderer;

    protected function setUp(): void
    {
        $this->encodedPolylineValueRenderer = new EncodedPolylineValueRenderer();
    }

    public function testRender()
    {
        $this->assertSame(
            'enc:foo',
            $this->encodedPolylineValueRenderer->render(new EncodedPolyline('foo'))
        );
    }
}
