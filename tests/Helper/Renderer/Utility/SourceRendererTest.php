<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Utility;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\SourceRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SourceRendererTest extends TestCase
{
    /**
     * @var SourceRenderer
     */
    private $sourceRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sourceRenderer = new SourceRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->sourceRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'function name(src){var script=document.createElement("script");script.type="text/javascript";script.async=true;script.src=src;document.getElementsByTagName("head")[0].appendChild(script);};',
            $this->sourceRenderer->render('name')
        );
    }

    public function testRenderWithVariables()
    {
        $this->assertSame(
            'function name(source){var variable=document.createElement("script");variable.type="text/javascript";variable.async=true;variable.src=source;document.getElementsByTagName("head")[0].appendChild(variable);};',
            $this->sourceRenderer->render('name', 'source', 'variable')
        );
    }

    public function testRenderWithDebug()
    {
        $this->sourceRenderer->getFormatter()->setDebug(true);

        $this->assertSame(
            'function name (src) {'."\n".'    var script = document.createElement("script");'."\n".'    script.type = "text/javascript";'."\n".'    script.async = true;'."\n".'    script.src = src;'."\n".'    document.getElementsByTagName("head")[0].appendChild(script);'."\n".'};'."\n",
            $this->sourceRenderer->render('name')
        );
    }
}
