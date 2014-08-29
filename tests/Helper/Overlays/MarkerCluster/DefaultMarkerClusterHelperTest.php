<?php

/*
/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\DefaultMarkerClusterHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Default marker cluster helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultMarkerClusterHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\DefaultMarkerClusterHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = new DefaultMarkerClusterHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function setDown()
    {
        unset($this->helper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper', $this->helper->getInfoWindowHelper());
    }

    public function testInitialState()
    {
        $markerHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\MarkerHelper');
        $infoWindowHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper');

        $this->helper = new DefaultMarkerClusterHelper($markerHelper, $infoWindowHelper);

        $this->assertSame($markerHelper, $this->helper->getMarkerHelper());
        $this->assertSame($infoWindowHelper, $this->helper->getInfoWindowHelper());
    }

    public function testRender()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $markerCluster = $this->getMock('Ivory\GoogleMap\Overlays\MarkerCluster');

        $this->assertNull($this->helper->render($markerCluster, $map));
    }

    public function testRenderLibraires()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $markerCluster = $this->getMock('Ivory\GoogleMap\Overlays\MarkerCluster');

        $this->assertNull($this->helper->renderLibraries($markerCluster, $map));
    }

    public function testRenderMarkersWithoutAutoOpenInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $expected = <<<EOF
map_container.markers.marker = marker = new google.maps.Marker({"position":marker_position,"map":map});

EOF;

        $this->assertSame($expected, $this->helper->renderMarkers($map->getMarkerCluster(), $map));
    }

    public function testRenderMarkersWithAutoOpenInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $marker->setInfoWindow($infoWindow = new InfoWindow());
        $infoWindow->setJavascriptVariable('marker_info_window');
        $infoWindow->setAutoOpen(true);

        $this->helper->renderMarkers($map->getMarkerCluster(), $map);

        $this->assertNotEmpty($map->getEventManager()->getEvents());
    }
}
