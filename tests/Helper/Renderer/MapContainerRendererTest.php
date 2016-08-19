<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapContainerRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapContainerRenderer
     */
    private $mapContainerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapContainerRenderer = new MapContainerRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->mapContainerRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            '{"base":{"coordinates":[],"bounds":[],"points":[],"sizes":[]},"map":null,"overlays":{"circles":[],"encoded_polylines":[],"ground_overlays":[],"polygons":[],"polylines":[],"rectangles":[],"info_windows":[],"info_boxes":[],"marker_images":[],"markers":[],"marker_cluster":null},"layers":{"heatmap_layers":[],"kml_layers":[]},"events":{"dom_events":[],"dom_events_once":[],"events":[],"events_once":[]},"functions":[]}',
            $this->mapContainerRenderer->render()
        );
    }

    public function testRenderWithDebug()
    {
        $this->mapContainerRenderer->getFormatter()->setDebug(true);

        $expected = <<<'EOF'
{
    "base": {
        "coordinates": [],
        "bounds": [],
        "points": [],
        "sizes": []
    },
    "map": null,
    "overlays": {
        "circles": [],
        "encoded_polylines": [],
        "ground_overlays": [],
        "polygons": [],
        "polylines": [],
        "rectangles": [],
        "info_windows": [],
        "info_boxes": [],
        "marker_images": [],
        "markers": [],
        "marker_cluster": null
    },
    "layers": {
        "heatmap_layers": [],
        "kml_layers": []
    },
    "events": {
        "dom_events": [],
        "dom_events_once": [],
        "events": [],
        "events_once": []
    },
    "functions": []
}
EOF;

        $this->assertSame($expected, $this->mapContainerRenderer->render());
    }
}
