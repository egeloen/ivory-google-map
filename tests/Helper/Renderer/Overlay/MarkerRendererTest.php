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

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AnimationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRendererTest extends TestCase
{
    /**
     * @var MarkerRenderer
     */
    private $markerRenderer;

    protected function setUp(): void
    {
        $this->markerRenderer = new MarkerRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new AnimationRenderer($formatter)
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

    public function testRenderWithIcon()
    {
        $map = new Map();
        $map->setVariable('map');

        $position = new Coordinate();
        $position->setVariable('position');

        $icon = new Icon();
        $icon->setVariable('icon');

        $markerShape = new MarkerShape(MarkerShapeType::CIRCLE, [1.2, 2.3, 3.4]);
        $markerShape->setVariable('marker_shape');

        $marker = new Marker(
            $position,
            Animation::DROP,
            $icon,
            null,
            $markerShape,
            ['foo' => 'bar']
        );

        $marker->setVariable('marker');

        $this->assertSame(
            'marker=new google.maps.Marker({"position":position,"map":map,"animation":google.maps.Animation.DROP,"icon":icon,"shape":marker_shape,"foo":"bar"})',
            $this->markerRenderer->render($marker, $map)
        );
    }

    public function testRenderWithSymbol()
    {
        $map = new Map();
        $map->setVariable('map');

        $position = new Coordinate();
        $position->setVariable('position');

        $symbol = new Symbol(SymbolPath::CIRCLE);
        $symbol->setVariable('symbol');

        $markerShape = new MarkerShape(MarkerShapeType::CIRCLE, [1.2, 2.3, 3.4]);
        $markerShape->setVariable('marker_shape');

        $marker = new Marker(
            $position,
            Animation::DROP,
            null,
            $symbol,
            $markerShape,
            ['foo' => 'bar']
        );

        $marker->setVariable('marker');

        $this->assertSame(
            'marker=new google.maps.Marker({"position":position,"map":map,"animation":google.maps.Animation.DROP,"icon":symbol,"shape":marker_shape,"foo":"bar"})',
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
     * @return MockObject|AnimationRenderer
     */
    private function createAnimationRendererMock()
    {
        return $this->createMock(AnimationRenderer::class);
    }
}
