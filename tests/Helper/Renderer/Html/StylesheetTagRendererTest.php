<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StylesheetTagRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StylesheetTagRenderer
     */
    private $stylesheetTagRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->stylesheetTagRenderer = new StylesheetTagRenderer(
            $formatter = new Formatter(),
            new TagRenderer($formatter),
            new StylesheetRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractTagRenderer::class, $this->stylesheetTagRenderer);
    }

    public function testStylesheetRenderer()
    {
        $stylesheetRenderer = $this->createStylesheetRendererMock();
        $this->stylesheetTagRenderer->setStylesheetRenderer($stylesheetRenderer);

        $this->assertSame($stylesheetRenderer, $this->stylesheetTagRenderer->getStylesheetRenderer());
    }

    /**
     * @param string   $expected
     * @param string   $name
     * @param string[] $stylesheets
     * @param string[] $attributes
     * @param bool     $newLine
     * @param bool     $debug
     *
     * @dataProvider renderProvider
     */
    public function testRender(
        $expected,
        $name,
        array $stylesheets = [],
        array $attributes = [],
        $newLine = true,
        $debug = false
    ) {
        $this->stylesheetTagRenderer->getFormatter()->setDebug($debug);

        $this->assertSame($expected, $this->stylesheetTagRenderer->render($name, $stylesheets, $attributes, $newLine));
    }

    /**
     * @return mixed[][]
     */
    public function renderProvider()
    {
        return [
            // Debug disabled
            ['<style type="test/css">name{}</style>', 'name'],
            ['<style type="test/css">name{foo:bar;}</style>', 'name', ['foo' => 'bar']],
            ['<style type="test/css" foo="bar">name{}</style>', 'name', [], ['foo' => 'bar']],
            ['<style type="test/css">name{}</style>', 'name', [], [], false],
            ['<style type="test/css" baz="bat">name{foo:bar;}</style>', 'name', ['foo' => 'bar'], ['baz' => 'bat'], false],

            // Debug enabled
            ['<style type="test/css">'.PHP_EOL.'    name {}'.PHP_EOL.'</style>'.PHP_EOL, 'name', [], [], true, true],
            ['<style type="test/css">'.PHP_EOL.'    name {'.PHP_EOL.'        foo: bar;'.PHP_EOL.'    }'.PHP_EOL.'</style>'.PHP_EOL, 'name', ['foo' => 'bar'], [], true, true],
            ['<style type="test/css" foo="bar">'.PHP_EOL.'    name {}'.PHP_EOL.'</style>'.PHP_EOL, 'name', [], ['foo' => 'bar'], true, true],
            ['<style type="test/css">'.PHP_EOL.'    name {}'.PHP_EOL.'</style>', 'name', [], [], false, true],
            ['<style type="test/css" baz="bat">'.PHP_EOL.'    name {'.PHP_EOL.'        foo: bar;'.PHP_EOL.'    }'.PHP_EOL.'</style>', 'name', ['foo' => 'bar'], ['baz' => 'bat'], false, true],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StylesheetRenderer
     */
    private function createStylesheetRendererMock()
    {
        return $this->createMock(StylesheetRenderer::class);
    }
}
