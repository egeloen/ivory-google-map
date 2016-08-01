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
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AbstractInfoWindowRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowRendererInterface;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractInfoWindowRenderer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $infoWindowRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowRenderer = $this->createAbstractInfoWindowRendererMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->infoWindowRenderer);
        $this->assertInstanceOf(InfoWindowRendererInterface::class, $this->infoWindowRenderer);
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
            'info_window=new google.maps.class({"position":position,"pixelOffset":pixel_offset,"content":"content","foo":"bar"})',
            $this->infoWindowRenderer->render($infoWindow)
        );
    }

    public function testRenderWithoutPosition()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame(
            'info_window=new google.maps.class({"content":"content"})',
            $this->infoWindowRenderer->render($infoWindow, false)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractInfoWindowRenderer
     */
    private function createAbstractInfoWindowRendererMock()
    {
        $infoWindowRenderer = $this->getMockBuilder(AbstractInfoWindowRenderer::class)
            ->setConstructorArgs([new Formatter(), new JsonBuilder()])
            ->getMockForAbstractClass();

        $infoWindowRenderer
            ->expects($this->any())
            ->method('getClass')
            ->will($this->returnValue('class'));

        return $infoWindowRenderer;
    }
}
