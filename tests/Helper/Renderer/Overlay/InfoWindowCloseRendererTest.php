<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowCloseRenderer;
use Ivory\GoogleMap\Overlay\InfoWindow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoWindowCloseRenderer
     */
    private $infoWindowCloseRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowCloseRenderer = new InfoWindowCloseRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->infoWindowCloseRenderer);
    }

    public function testRender()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame('info_window.close()', $this->infoWindowCloseRenderer->render($infoWindow));
    }
}
