<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\LoaderRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoaderRenderer
     */
    private $loaderRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->loaderRenderer = new LoaderRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->loaderRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'function name(){google.load("maps","3",{"other_params":"language=en&libraries=library1,library2","callback":callback})};',
            $this->loaderRenderer->render(
                'name',
                'callback',
                'en',
                ['library1', 'library2']
            )
        );
    }

    public function testRenderWithDebug()
    {
        $this->loaderRenderer->getFormatter()->setDebug(true);

        $expected = <<<EOF
function name () {
    google.load("maps", "3", {
        "other_params": "language=en&libraries=library1,library2",
        "callback": callback
    })
};

EOF;

        $this->assertSame($expected, $this->loaderRenderer->render(
            'name',
            'callback',
            'en',
            ['library1', 'library2']
        ));
    }

    public function testRenderSource()
    {
        $this->assertSame(
            'https://www.google.com/jsapi?callback=callback',
            $this->loaderRenderer->renderSource('callback')
        );
    }
}
