<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Extendable renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer */
    private $extendableRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->extendableRenderer = new ExtendableRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->extendableRenderer);
    }

    public function testRender()
    {
        $extend = $this->createExtendableMock();
        $extend
            ->expects($this->any())
            ->method('renderExtend')
            ->with($this->identicalTo($bound = $this->createBoundMock()))
            ->will($this->returnValue($render = 'render'));

        $this->assertSame($render, $this->extendableRenderer->render($extend, $bound));
    }
}
