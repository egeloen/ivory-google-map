<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

use Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer;

/**
 * Loader renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer */
    private $loaderRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->loaderRenderer = new LoaderRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->loaderRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, array $libraries = array(), $callback = null, $sensor = false)
    {
        $this->assertSame($expected, $this->loaderRenderer->render('fr', $libraries, $callback, $sensor));
    }

    public function testRenderSource()
    {
        $this->assertSame(
            '//www.google.com/jsapi?callback=callback',
            $this->loaderRenderer->renderSource('callback')
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.load("maps","3",{"other_params":"language=fr&sensor=false"})'),
            array(
                'google.load("maps","3",{"other_params":"libraries=library&language=fr&sensor=false"})',
                array('library'),
            ),
            array(
                'google.load("maps","3",{"other_params":"language=fr&sensor=false","callback":callback})',
                array(),
                'callback',
            ),
            array('google.load("maps","3",{"other_params":"language=fr&sensor=true"})', array(), null, true),
            array(
                'google.load("maps","3",{"other_params":"libraries=library&language=fr&sensor=true","callback":callback})',
                array('library'),
                'callback',
                true,
            ),
        );
    }
}
