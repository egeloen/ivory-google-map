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
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Geometry\EncodingRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolylineRenderer
     */
    private $encodedPolylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineRenderer = new EncodedPolylineRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new EncodingRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->encodedPolylineRenderer);
    }

    public function testEncodingRenderer()
    {
        $this->encodedPolylineRenderer->setEncodingRenderer($encodingRenderer = $this->createEncodingRendererMock());

        $this->assertSame($encodingRenderer, $this->encodedPolylineRenderer->getEncodingRenderer());
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $encodedPolyline = new EncodedPolyline('value', ['foo' => 'bar']);
        $encodedPolyline->setVariable('encoded_polyline');

        $this->assertSame(
            'encoded_polyline=new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("value"),"foo":"bar"})',
            $this->encodedPolylineRenderer->render($encodedPolyline, $map)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EncodingRenderer
     */
    private function createEncodingRendererMock()
    {
        return $this->createMock(EncodingRenderer::class);
    }
}
