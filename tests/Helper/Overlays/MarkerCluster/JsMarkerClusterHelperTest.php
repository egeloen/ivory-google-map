<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\JsMarkerClusterHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Javscript marker cluster helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsMarkerClusterHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\JsMarkerClusterHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = new JsMarkerClusterHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->helper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\MarkerCluster\DefaultMarkerClusterHelper',
            $this->helper
        );
    }

    public function testRenderWithoutOptions()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getMarkerCluster()->setJavascriptVariable('marker_cluster');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $expected = <<<EOF
marker_cluster = new MarkerClusterer(map, map_container.functions.to_array(map_container.markers), []);

EOF;

        $this->assertSame($expected, $this->helper->render($map->getMarkerCluster(), $map));
    }

    public function testRenderWithOptions()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getMarkerCluster()->setJavascriptVariable('marker_cluster');
        $map->getMarkerCluster()->setOption('foo', 'bar');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $expected = <<<EOF
marker_cluster = new MarkerClusterer(map, map_container.functions.to_array(map_container.markers), {"foo":"bar"});

EOF;

        $this->assertSame($expected, $this->helper->render($map->getMarkerCluster(), $map));
    }

    public function testRenderLibraries()
    {
        $map = new Map();

        $expected = <<<EOF
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js"></script>

EOF;

        $this->assertSame($expected, $this->helper->renderLibraries($map->getMarkerCluster(), $map));
    }

    public function testRenderMarkers()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $expected = <<<EOF
map_container.markers.marker = marker = new google.maps.Marker({"position":marker_position});

EOF;

        $this->assertSame($expected, $this->helper->renderMarkers($map->getMarkerCluster(), $map));
    }
}
