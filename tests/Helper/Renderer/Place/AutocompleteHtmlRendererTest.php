<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Place;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteHtmlRenderer;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHtmlRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AutocompleteHtmlRenderer
     */
    private $autocompleteHtmlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteHtmlRenderer = new AutocompleteHtmlRenderer(
            $formatter = new Formatter(),
            new TagRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractTagRenderer::class, $this->autocompleteHtmlRenderer);
    }

    public function testRender()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setVariable('autocomplete');
        $autocomplete->setValue('value');

        $this->assertSame(
            '<input id="place_input" type="text" autocomplete="off" value="value"></input>',
            $this->autocompleteHtmlRenderer->render($autocomplete)
        );
    }

    public function testRenderWithoutOptions()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->setVariable('autocomplete');

        $this->assertSame(
            '<input id="place_input" type="text" autocomplete="off"></input>',
            $this->autocompleteHtmlRenderer->render($autocomplete)
        );
    }
}
