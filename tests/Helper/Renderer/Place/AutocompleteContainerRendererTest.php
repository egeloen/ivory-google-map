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
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteContainerRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AutocompleteContainerRenderer
     */
    private $autocompleteContainerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteContainerRenderer = new AutocompleteContainerRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->autocompleteContainerRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            '{"base":{"coordinates":[],"bounds":[]},"autocomplete":null,"events":{"dom_events":[],"dom_events_once":[],"events":[],"events_once":[]}}',
            $this->autocompleteContainerRenderer->render()
        );
    }
}
