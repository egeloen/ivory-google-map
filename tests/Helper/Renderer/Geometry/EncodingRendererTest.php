<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Geometry;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Geometry\EncodingRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodingRenderer
     */
    private $encodingRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodingRenderer = new EncodingRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->encodingRenderer);
    }

    /**
     * @param string $expected
     * @param string $encodedPath
     *
     * @dataProvider renderProvider
     */
    public function testRender($expected, $encodedPath)
    {
        $this->assertSame(
            'google.maps.geometry.encoding.decodePath("'.$expected.'")',
            $this->encodingRenderer->renderDecodePath($encodedPath)
        );
    }

    /**
     * @return string[][]
     */
    public function renderProvider()
    {
        return [
            ['foo', 'foo'],
            ['\\\\\"', '"'],
            ['\\\\\'', '\''],
            ['\\\\\\\\', '\\'],
        ];
    }
}
