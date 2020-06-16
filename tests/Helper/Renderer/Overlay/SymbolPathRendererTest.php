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
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolPathRenderer;
use Ivory\GoogleMap\Overlay\SymbolPath;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolPathRendererTest extends TestCase
{
    /**
     * @var SymbolPathRenderer
     */
    private $symbolPathRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->symbolPathRenderer = new SymbolPathRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->symbolPathRenderer);
    }

    public function testRender()
    {
        $this->assertSame('google.maps.SymbolPath.CIRCLE', $this->symbolPathRenderer->render(SymbolPath::CIRCLE));
    }
}
