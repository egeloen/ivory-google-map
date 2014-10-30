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

use Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer;

/**
 * Map container renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer */
    private $mapContainerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapContainerRenderer = new MapContainerRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapContainerRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->mapContainerRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, array $functions = array())
    {
        $this->assertSame(
            $expected,
            $this->mapContainerRenderer->render($functions)
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('{"base":{"coordinates":[],"bounds":[],"points":[],"sizes":[]},"map":null,"overlays":{"circles":[],"encoded_polylines":[],"ground_overlays":[],"polygons":[],"polylines":[],"rectangles":[],"info_windows":[],"info_boxes":[],"icons":[],"marker_shapes":[],"markers":[],"marker_cluster":null},"layers":{"kml_layers":[]},"events":{"dom_events":[],"dom_events_once":[],"events":[],"events_once":[]}}'),
            array(
                '{"base":{"coordinates":[],"bounds":[],"points":[],"sizes":[]},"map":null,"overlays":{"circles":[],"encoded_polylines":[],"ground_overlays":[],"polygons":[],"polylines":[],"rectangles":[],"info_windows":[],"info_boxes":[],"icons":[],"marker_shapes":[],"markers":[],"marker_cluster":null},"layers":{"kml_layers":[]},"events":{"dom_events":[],"dom_events_once":[],"events":[],"events_once":[]},"functions":{"foo":function(){return "foo";},"bar":function (){return "bar";}}}',
                array('[foo]' => 'function(){return "foo";}', '[bar]' => 'function (){return "bar";}'),
            ),
        );
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
