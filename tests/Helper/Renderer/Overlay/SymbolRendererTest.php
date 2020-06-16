<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolPathRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolRenderer;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolRendererTest extends TestCase
{
    /**
     * @var SymbolRenderer
     */
    private $symbolRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->symbolRenderer = new SymbolRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new SymbolPathRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->symbolRenderer);
    }

    public function testRender()
    {
        $anchor = new Point();
        $anchor->setVariable('anchor');

        $labelOrigin = new Point();
        $labelOrigin->setVariable('label_origin');

        $symbol = new Symbol(SymbolPath::CIRCLE, $anchor, $labelOrigin, ['foo' => 'bar']);
        $symbol->setVariable('symbol');

        $this->assertSame(
            'symbol={"path":google.maps.SymbolPath.CIRCLE,"anchor":anchor,"labelOrigin":label_origin,"foo":"bar"}',
            $this->symbolRenderer->render($symbol)
        );
    }

    public function testRenderWithoutOptions()
    {
        $symbol = new Symbol(SymbolPath::CIRCLE);
        $symbol->setVariable('symbol');

        $this->assertSame(
            'symbol={"path":google.maps.SymbolPath.CIRCLE}',
            $this->symbolRenderer->render($symbol)
        );
    }
}
