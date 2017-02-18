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
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineValueRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolylineValueRenderer
     */
    private $encodedPolylineValueRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
