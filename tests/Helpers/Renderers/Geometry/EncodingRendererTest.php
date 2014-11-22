<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Geometry;

use Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Encoding renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer */
    private $encodingRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodingRenderer = new EncodingRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodingRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.geometry.encoding.decodePath("foo")',
            $this->encodingRenderer->renderDecodePath('foo')
        );
    }
}
