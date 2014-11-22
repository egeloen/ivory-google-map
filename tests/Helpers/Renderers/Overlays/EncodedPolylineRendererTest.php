<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Encoded polyline renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer */
    private $encodedPolylineRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineRenderer = new EncodedPolylineRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodedPolylineRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->encodedPolylineRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->encodedPolylineRenderer->getJsonBuilder());
        $this->assertEncodingRendererInstance($this->encodedPolylineRenderer->getEncodingRenderer());
    }

    public function testInitialState()
    {
        $this->encodedPolylineRenderer = new EncodedPolylineRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $encodingRenderer = $this->createEncodingRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->encodedPolylineRenderer->getJsonBuilder());
        $this->assertSame($encodingRenderer, $this->encodedPolylineRenderer->getEncodingRenderer());
    }

    public function testSetEncodingRenderer()
    {
        $this->encodedPolylineRenderer->setEncodingRenderer($encodingRenderer = $this->createEncodingRendererMock());

        $this->assertSame($encodingRenderer, $this->encodedPolylineRenderer->getEncodingRenderer());
    }

    public function testRender()
    {
        $this->assertSame(
            'new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("value"),"foo":"bar"})',
            $this->encodedPolylineRenderer->render($this->createEncodedPolylineMock(), $this->createMapMock())
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createEncodedPolylineMock()
    {
        $encodedPolyline = parent::createEncodedPolylineMock();
        $encodedPolyline
            ->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('value'));

        $encodedPolyline
            ->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('foo' => 'bar')));

        return $encodedPolyline;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        return $map;
    }
}
