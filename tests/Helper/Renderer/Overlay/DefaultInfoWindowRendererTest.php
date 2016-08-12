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
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AbstractInfoWindowRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\DefaultInfoWindowRenderer;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultInfoWindowRenderer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $defaultInfoWindowRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->defaultInfoWindowRenderer = new DefaultInfoWindowRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractInfoWindowRenderer::class, $this->defaultInfoWindowRenderer);
    }

    public function testRender()
    {
        $position = new Coordinate();
        $position->setVariable('position');

        $pixelOffset = new Size();
        $pixelOffset->setVariable('pixel_offset');

        $infoWindow = new InfoWindow('content', InfoWindowType::DEFAULT_, $position);
        $infoWindow->setVariable('info_window');
        $infoWindow->setPixelOffset($pixelOffset);
        $infoWindow->setOptions(['foo' => 'bar']);

        $this->assertSame(
            'info_window=new google.maps.InfoWindow({"position":position,"pixelOffset":pixel_offset,"content":"content","foo":"bar"})',
            $this->defaultInfoWindowRenderer->render($infoWindow)
        );
    }

    public function testRenderWithoutPosition()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame(
            'info_window=new google.maps.InfoWindow({"content":"content"})',
            $this->defaultInfoWindowRenderer->render($infoWindow, false)
        );
    }
}
