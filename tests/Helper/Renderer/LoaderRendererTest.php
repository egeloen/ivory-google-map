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
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRendererTest extends TestCase
{
    private LoaderRenderer $loaderRenderer;

    protected function setUp(): void
    {
        $this->loaderRenderer = new LoaderRenderer(new Formatter(), new JsonBuilder());
    }

    /*****************************************************************************/
    /* Tests
    /*****************************************************************************/

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->loaderRenderer);
    }

    public function testDefaultState()
    {
        $this->assertSame('en', $this->loaderRenderer->getLanguage());
        $this->assertFalse($this->loaderRenderer->hasKey());
        $this->assertNull($this->loaderRenderer->getKey());
    }

    public function testInitialState()
    {
        $this->loaderRenderer = new LoaderRenderer(
            new Formatter(),
            new JsonBuilder(),
            $language = 'fr',
            $key = 'key'
        );

        $this->assertSame($language, $this->loaderRenderer->getLanguage());
        $this->assertTrue($this->loaderRenderer->hasKey());
        $this->assertSame($key, $this->loaderRenderer->getKey());
    }

    public function testLanguage()
    {
        $this->loaderRenderer->setLanguage($language = 'fr');

        $this->assertSame($language, $this->loaderRenderer->getLanguage());
    }

    public function testKey()
    {
        $this->loaderRenderer->setKey($key = 'key');

        $this->assertTrue($this->loaderRenderer->hasKey());
        $this->assertSame($key, $this->loaderRenderer->getKey());
    }

    //-----------------------------------------------------------------------------
    // render
    //-----------------------------------------------------------------------------

    public function testRender()
    {
        $this->assertSame(
            'function name(){google.load("current",{"callback":callback})};',
            $this->loaderRenderer->render('name', 'callback', ['library1', 'library2'])
        );
    }

    public function testRenderWithLanguage()
    {
        $this->loaderRenderer->setLanguage('fr');

        $this->assertSame(
            'function name(){google.load("current",{"callback":callback})};',
            $this->loaderRenderer->render('name', 'callback')
        );
    }

    public function testRenderWithKey()
    {
        $this->loaderRenderer->setKey('key');

        $this->assertSame(
            'function name(){google.load("current",{"callback":callback})};',
            $this->loaderRenderer->render('name', 'callback')
        );
    }




    public function testRenderWithDebug()
    {
        $this->loaderRenderer->getFormatter()->setDebug(true);

        $expected = <<<'EOF'
function name () {
    google.load("current", {
        "callback": callback
    })
};

EOF;

        $this->assertSame($expected, $this->loaderRenderer->render(
            'name',
            'callback',
            ['library1', 'library2']
        ));
    }

    //-----------------------------------------------------------------------------
    // renderSource
    //-----------------------------------------------------------------------------

    /**
     * @group source
     */
    public function test_render_source_without_libraries()
    {
        $result = $this->loaderRenderer->renderSource('callback');
        $this->assertSame('https://maps.googleapis.com/maps/api/js?language=en&callback=callback', $result);
    }

    /**
     * @group source
     */
    public function test_render_source_with_libraries()
    {
        $result = $this->loaderRenderer->renderSource('init_google_map', ['places', 'charts']);
        $this->assertSame(sprintf('https://maps.googleapis.com/maps/api/js?language=en&libraries=%s&callback=init_google_map', urlencode('places,charts')), $result);
    }
}
