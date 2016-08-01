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
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerClustererRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClustererRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MarkerClustererRenderer
     */
    private $markerClustererRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
            'marker_cluster=new MarkerClusterer(map,markers,{"foo":"bar"})',
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
     * @return \PHPUnit_Framework_MockObject_MockObject|RequirementRenderer
     */
    private function createRequirementRendererMock()
    {
        return $this->createMock(RequirementRenderer::class);
    }
}
