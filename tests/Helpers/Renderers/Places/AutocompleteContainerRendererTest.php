<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Places;

use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Autocomplete container renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer */
    private $containerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->containerRenderer = new AutocompleteContainerRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->containerRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->containerRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            '{"base":{"coordinates":[],"bounds":[]},"autocomplete":null}',
            $this->containerRenderer->render()
        );
    }
}
