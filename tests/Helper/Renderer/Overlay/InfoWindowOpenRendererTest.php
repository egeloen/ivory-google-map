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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoWindowOpenRenderer
     */
    private $infoWindowOpenRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowOpenRenderer = new InfoWindowOpenRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->infoWindowOpenRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $marker = new Marker(new Coordinate());
        $marker->setVariable('marker');

        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame(
            'info_window.open(map,marker)',
            $this->infoWindowOpenRenderer->render($infoWindow, $map, $marker)
        );
    }

    public function testRenderWithoutMarker()
    {
        $map = new Map();
        $map->setVariable('map');

        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame(
            'info_window.open(map)',
            $this->infoWindowOpenRenderer->render($infoWindow, $map)
        );
    }
}
