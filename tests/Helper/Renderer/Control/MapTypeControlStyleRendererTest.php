<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\MapTypeControlStyle;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlStyleRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapTypeControlStyleRenderer
     */
    private $mapTypeControlStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlStyleRenderer = new MapTypeControlStyleRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->mapTypeControlStyleRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.MapTypeControlStyle.DROPDOWN_MENU',
            $this->mapTypeControlStyleRenderer->render(MapTypeControlStyle::DROPDOWN_MENU)
        );
    }
}
