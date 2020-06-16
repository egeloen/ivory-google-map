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

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconSequenceRenderer;
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequenceRendererTest extends TestCase
{
    /**
     * @var IconSequenceRenderer
     */
    private $iconSequenceRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->iconSequenceRenderer = new IconSequenceRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->iconSequenceRenderer);
    }

    public function testRender()
    {
        $symbol = new Symbol(SymbolPath::CIRCLE);
        $symbol->setVariable('symbol');

        $iconSequence = new IconSequence($symbol, ['foo' => 'bar']);
        $iconSequence->setVariable('icon_sequence');

        $this->assertSame(
            'icon_sequence={"icon":symbol,"foo":"bar"}',
            $this->iconSequenceRenderer->render($iconSequence)
        );
    }

    public function testRenderWithoutOptions()
    {
        $symbol = new Symbol(SymbolPath::CIRCLE);
        $symbol->setVariable('symbol');

        $iconSequence = new IconSequence($symbol);
        $iconSequence->setVariable('icon_sequence');

        $this->assertSame(
            'icon_sequence={"icon":symbol}',
            $this->iconSequenceRenderer->render($iconSequence)
        );
    }
}
