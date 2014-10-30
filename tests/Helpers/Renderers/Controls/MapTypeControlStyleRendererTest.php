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

use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Map type control style renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer */
    private $mapTypeControlStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlStyleRenderer = new MapTypeControlStyleRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlStyleRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, $mapTypeControlStyle)
    {
        $this->assertSame($expected, $this->mapTypeControlStyleRenderer->render($mapTypeControlStyle));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.maps.MapTypeControlStyle.DEFAULT', MapTypeControlStyle::DEFAULT_),
            array('google.maps.MapTypeControlStyle.DROPDOWN_MENU', MapTypeControlStyle::DROPDOWN_MENU),
            array('google.maps.MapTypeControlStyle.HORIZONTAL_BAR', MapTypeControlStyle::HORIZONTAL_BAR),
        );
    }
}
