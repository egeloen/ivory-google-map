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
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapHtmlRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHtmlRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapHtmlRenderer
     */
    private $mapHtmlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapHtmlRenderer = new MapHtmlRenderer(
            $formatter = new Formatter(),
            new TagRenderer($formatter),
            new StylesheetRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractTagRenderer::class, $this->mapHtmlRenderer);
    }

    public function testStylesheetRenderer()
    {
        $this->mapHtmlRenderer->setStylesheetRenderer($stylesheetRenderer = $this->createStylesheetRendererMock());

        $this->assertSame($stylesheetRenderer, $this->mapHtmlRenderer->getStylesheetRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            '<div id="map_canvas" style="width:300px;height:300px;"></div>',
            $this->mapHtmlRenderer->render(new Map())
        );
    }

    public function testRenderWithSizes()
    {
        $map = new Map();
        $map->setStylesheetOption('width', '100px');
        $map->setStylesheetOption('height', '200px');

        $this->assertSame(
            '<div id="map_canvas" style="width:100px;height:200px;"></div>',
            $this->mapHtmlRenderer->render($map)
        );
    }

    public function testRenderWithAttributes()
    {
        $map = new Map();
        $map->setHtmlAttributes(['class' => 'my-class']);

        $this->assertSame(
            '<div class="my-class" id="map_canvas" style="width:300px;height:300px;"></div>',
            $this->mapHtmlRenderer->render($map)
        );
    }

    public function testRenderWithDebug()
    {
        $this->mapHtmlRenderer->getFormatter()->setDebug(true);

        $this->assertSame(
            '<div id="map_canvas" style="width: 300px;height: 300px;"></div>'.PHP_EOL,
            $this->mapHtmlRenderer->render(new Map())
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StylesheetRenderer
     */
    private function createStylesheetRendererMock()
    {
        return $this->createMock(StylesheetRenderer::class);
    }
}
