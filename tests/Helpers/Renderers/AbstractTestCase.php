<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase as TestCase;

/**
 * Renderer test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts an animation renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer $animationRenderer The animation renderer.
     */
    protected function assertAnimationRendererInstance($animationRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer', $animationRenderer);
    }

    /**
     * Asserts an encoding renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer $encodingRenderer The encoding renderer.
     */
    protected function assertEncodingRendererInstance($encodingRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer', $encodingRenderer);
    }

    /**
     * Asserts a json renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer $jsonRenderer The json renderer.
     */
    protected function assertJsonRendererInstance($jsonRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer', $jsonRenderer);
    }

    /**
     * Asserts a map type control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer $mapTypeControlRenderer The map type control renderer.
     */
    protected function assertMapTypeControlRendererInstance($mapTypeControlRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer',
            $mapTypeControlRenderer
        );
    }

    /**
     * Asserts a map type control style renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer $mapTypeControlStyleRenderer The map type control style renderer.
     */
    protected function assertMapTypeControlStyleRendererInstance($mapTypeControlStyleRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer',
            $mapTypeControlStyleRenderer
        );
    }

    /**
     * Asserts an overview map control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer $overviewMapControlRenderer The overview map control renderer.
     */
    protected function assertOverviewMapControlRendererInstance($overviewMapControlRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer',
            $overviewMapControlRenderer
        );
    }

    /**
     * Asserts a pan control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer $panControlRenderer The pan control renderer.
     */
    protected function assertPanControlRendererInstance($panControlRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer', $panControlRenderer);
    }

    /**
     * Asserts a rotate control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer $rotateControlRenderer The rotate control renderer.
     */
    protected function assertRotateControlRendererInstance($rotateControlRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer',
            $rotateControlRenderer
        );
    }

    /**
     * Asserts a scale control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer $scaleControlRenderer The scale control renderer.
     */
    protected function assertScaleControlRendererInstance($scaleControlRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer',
            $scaleControlRenderer
        );
    }

    /**
     * Asserts a scale control style renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer $scaleControlStyleRenderer The scale control style renderer.
     */
    protected function assertScaleControlStyleRendererInstance($scaleControlStyleRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer',
            $scaleControlStyleRenderer
        );
    }

    /**
     * Asserts a street view control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer $streetViewControlRenderer The street view control renderer.
     */
    protected function assertStreetViewControlRendererInstance($streetViewControlRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer',
            $streetViewControlRenderer
        );
    }

    /**
     * Asserts a zoom control renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer $zoomControlRenderer The zoom control renderer.
     */
    protected function assertZoomControlRendererInstance($zoomControlRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer', $zoomControlRenderer);
    }

    /**
     * Asserts a zoom control style renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer $zoomControlStyleRenderer The zoom control style renderer.
     */
    protected function assertZoomControlStyleRendererInstance($zoomControlStyleRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer',
            $zoomControlStyleRenderer
        );
    }

    /**
     * Creates a json renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer|\PHPUnit_Framework_MockObject_MockObjectThe json renderer mock.
     */
    protected function createJsonRendererMock()
    {
        return $this->createJsonRendererMockBuilder()->getMockForAbstractClass();
    }

    /**
     * Creates a json renderer mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The json renderer mock builder.
     */
    protected function createJsonRendererMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer');
    }
}
