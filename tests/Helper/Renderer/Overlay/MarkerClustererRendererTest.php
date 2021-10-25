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
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerClustererRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Validaide\Common\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClustererRendererTest extends TestCase
{
    /**
     * @var MarkerClustererRenderer
     */
    private $markerClustererRenderer;

    protected function setUp(): void
    {
        $this->markerClustererRenderer = new MarkerClustererRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new RequirementRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->markerClustererRenderer);
    }

    public function testRequirementRenderer()
    {
        $requirementRenderer = $this->createRequirementRendererMock();
        $this->markerClustererRenderer->setRequirementRenderer($requirementRenderer);

        $this->assertSame($requirementRenderer, $this->markerClustererRenderer->getRequirementRenderer());
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $markerCluster = new MarkerCluster();
        $markerCluster->setVariable('marker_cluster');
        $markerCluster->setOptions(['foo' => 'bar']);

        $this->assertSame(
            'marker_cluster=new MarkerClusterer(map,markers,{"foo":"bar","imagePath":"https:\/\/cdn.rawgit.com\/googlemaps\/js-marker-clusterer\/gh-pages\/images\/m"})',
            $this->markerClustererRenderer->render($markerCluster, $map, 'markers')
        );
    }

    public function testRenderSource()
    {
        $this->assertSame(
            'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/src/markerclusterer.js',
            $this->markerClustererRenderer->renderSource()
        );
    }

    public function testRenderRequirement()
    {
        $this->assertSame(
            'typeof MarkerClusterer!==typeof undefined',
            $this->markerClustererRenderer->renderRequirement()
        );
    }

    /**
     * @return MockObject|RequirementRenderer
     */
    private function createRequirementRendererMock()
    {
        return $this->createMock(RequirementRenderer::class);
    }
}
