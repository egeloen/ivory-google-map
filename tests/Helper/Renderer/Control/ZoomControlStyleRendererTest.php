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

use Ivory\GoogleMap\Control\ZoomControlStyle;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlStyleRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ZoomControlStyleRenderer
     */
    private $zoomControlStyleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlStyleRenderer = new ZoomControlStyleRenderer(new Formatter());
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.ZoomControlStyle.LARGE',
            $this->zoomControlStyleRenderer->render(ZoomControlStyle::LARGE)
        );
    }
}
