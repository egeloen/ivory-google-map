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
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AnimationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerShapeRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MarkerRenderer
     */
    private $markerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerRenderer = new MarkerRenderer(
            $formatter = new Formatter(),
            $jsonBuilder = new JsonBuilder(),
            new AnimationRenderer($formatter),
            new IconRenderer($formatter, $jsonBuilder),
            new MarkerShapeRenderer($formatter, $jsonBuilder)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->markerRenderer);
    }

    public function testAnimationRenderer()
    {
        $this->markerRenderer->setAnimationRenderer($animationRenderer = $this->createAnimationRendererMock());

        $this->assertSame($animationRenderer, $this->markerRenderer->getAnimationRenderer());
    }

    public function testIconRendererMock()
    {
        $this->markerRenderer->setIconRenderer($iconRenderer = $this->createIconRendererMock());

        $this->assertSame($iconRenderer, $this->markerRenderer->getIconRenderer());
    }

    public function testMarkerShapeRenderer()
    {
        $this->markerRenderer->setMarkerShapeRenderer($markerShapeRenderer = $this->createMarkerShapeRendererMock());

        $this->assertSame($markerShapeRenderer, $this->markerRenderer->getMarkerShapeRenderer());
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $position = new Coordinate();
        $position->setVariable('position');

        $marker = new Marker(
            $position,
            Animation::DROP,
            new Icon(),
            new MarkerShape(MarkerShapeType::CIRCLE, [1.2, 2.3, 3.4]),
            ['foo' => 'bar']
        );

        $marker->setVariable('marker');

        $this->assertSame(
            'marker=new google.maps.Marker({"position":position,"map":map,"animation":google.maps.Animation.DROP,"icon":{"url":"https:\/\/maps.gstatic.com\/mapfiles\/markers\/marker.png"},"shape":{"type":"circle","coords":[1.2,2.3,3.4]},"foo":"bar"})',
            $this->markerRenderer->render($marker, $map)
        );
    }

    public function testRenderWithoutOptions()
    {
        $position = new Coordinate();
        $position->setVariable('position');

        $marker = new Marker($position);
        $marker->setVariable('marker');

        $this->assertSame(
            'marker=new google.maps.Marker({"position":position})',
            $this->markerRenderer->render($marker)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AnimationRenderer
     */
    private function createAnimationRendererMock()
    {
        return $this->createMock(AnimationRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|IconRenderer
     */
    private function createIconRendererMock()
    {
        return $this->createMock(IconRenderer::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerShapeRenderer
     */
    private function createMarkerShapeRendererMock()
    {
        return $this->createMock(MarkerShapeRenderer::class);
    }
}
