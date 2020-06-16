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

use Ivory\GoogleMap\Helper\Renderer\Image\StyleRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StyleRendererTest extends TestCase
{
    /**
     * @var StyleRenderer
     */
    private $styleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->styleRenderer = new StyleRenderer();
    }

    /**
     * @param string  $expected
     * @param mixed[] $style
     *
     * @dataProvider renderProvider
     */
    public function testRender($expected, array $style)
    {
        $this->assertSame($expected, $this->styleRenderer->render($style));
    }

    /**
     * @return mixed[]
     */
    public function renderProvider()
    {
        return [
            ['color:0x00ff00', ['rules' => ['color' => '0x00ff00']]],
            ['color:0x00ff00|lightness:50', ['rules' => ['color' => '0x00ff00', 'lightness' => '50']]],
            ['feature:road|color:0x00ff00|lightness:50', [
                'feature' => 'road',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
            ['element:geometry|color:0x00ff00|lightness:50', [
                'element' => 'geometry',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
            ['feature:road.local|element:geometry|color:0x00ff00|lightness:50', [
                'feature' => 'road.local',
                'element' => 'geometry',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
        ];
    }
}
