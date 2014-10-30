<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Zoom control style renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer */
    private $zoomControlStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlStyleRenderer = new ZoomControlStyleRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlStyleRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, $zoomControlStyle)
    {
        $this->assertSame($expected, $this->zoomControlStyleRenderer->render($zoomControlStyle));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.maps.ZoomControlStyle.DEFAULT', ZoomControlStyle::DEFAULT_),
            array('google.maps.ZoomControlStyle.LARGE', ZoomControlStyle::LARGE),
            array('google.maps.ZoomControlStyle.SMALL', ZoomControlStyle::SMALL),
        );
    }
}
