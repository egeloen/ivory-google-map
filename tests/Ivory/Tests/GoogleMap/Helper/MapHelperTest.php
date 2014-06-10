<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Events\Event;
use Ivory\GoogleMap\Helper\Extension\InfoBoxExtensionHelper;
use Ivory\GoogleMap\Helper\Overlays\InfoBoxHelper;
use Ivory\GoogleMap\Layers\KMLLayer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Overlays\Rectangle;
use Ivory\GoogleMap\Helper\MapHelper;

/**
 * Map helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\MapHelper */
    protected $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapHelper = new MapHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Base\CoordinateHelper',
            $this->mapHelper->getCoordinateHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Base\BoundHelper',
            $this->mapHelper->getBoundHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Base\PointHelper',
            $this->mapHelper->getPointHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Base\SizeHelper',
            $this->mapHelper->getSizeHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\MapTypeIdHelper',
            $this->mapHelper->getMapTypeIdHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper',
            $this->mapHelper->getMapTypeControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper',
            $this->mapHelper->getOverviewMapControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\PanControlHelper',
            $this->mapHelper->getPanControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\RotateControlHelper',
            $this->mapHelper->getRotateControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\ScaleControlHelper',
            $this->mapHelper->getScaleControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper',
            $this->mapHelper->getStreetViewControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Controls\ZoomControlHelper',
            $this->mapHelper->getZoomControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper',
            $this->mapHelper->getMarkerClusterHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper',
            $this->mapHelper->getMarkerImageHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper',
            $this->mapHelper->getMarkerShapeHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper',
            $this->mapHelper->getInfoWindowHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\PolylineHelper',
            $this->mapHelper->getPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper',
            $this->mapHelper->getEncodedPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\PolygonHelper',
            $this->mapHelper->getPolygonHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\RectangleHelper',
            $this->mapHelper->getRectangleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\CircleHelper',
            $this->mapHelper->getCircleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper',
            $this->mapHelper->getGroundOverlayHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Layers\KMLLayerHelper',
            $this->mapHelper->getKmlLayerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Events\EventManagerHelper',
            $this->mapHelper->getEventManagerHelper()
        );

        $this->assertTrue($this->mapHelper->hasExtensionHelpers());
        $this->assertCount(1, $this->mapHelper->getExtensionHelpers());

        $this->assertTrue($this->mapHelper->hasExtensionHelper('core'));
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\Extension\CoreExtensionHelper',
            $this->mapHelper->getExtensionHelper('core')
        );
    }

    public function testInitialState()
    {
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\CoordinateHelper');
        $boundHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\BoundHelper');
        $pointHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\PointHelper');
        $sizeHelper = $this->getMock('Ivory\GoogleMap\Helper\Base\SizeHelper');
        $mapTypeIdHelper = $this->getMock('Ivory\GoogleMap\Helper\MapTypeIdHelper');
        $mapTypeControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper');
        $overviewMapControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper');
        $panControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\PanControlHelper');
        $rotateControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\RotateControlHelper');
        $scaleControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\ScaleControlHelper');
        $streetViewControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper');
        $zoomControlHelper = $this->getMock('Ivory\GoogleMap\Helper\Controls\ZoomControlHelper');
        $markerClusterHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface');
        $markerImageHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper');
        $markerShapeHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper');
        $infoWindowHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper');
        $polylineHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\PolylineHelper');
        $encodedPolylineHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper');
        $polygonHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\PolygonHelper');
        $rectangleHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\RectangleHelper');
        $circleHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\CircleHelper');
        $groundOverlayHelper = $this->getMock('Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper');
        $kmlLayerHelper = $this->getMock('Ivory\GoogleMap\Helper\Layers\KMLLayerHelper');
        $eventManagerHelper = $this->getMock('Ivory\GoogleMap\Helper\Events\EventManagerHelper');
        $extensionHelpers = array('foo' => $this->getMock('Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface'));

        $this->mapHelper = new MapHelper(
            $coordinateHelper,
            $boundHelper,
            $pointHelper,
            $sizeHelper,
            $mapTypeIdHelper,
            $mapTypeControlHelper,
            $overviewMapControlHelper,
            $panControlHelper,
            $rotateControlHelper,
            $scaleControlHelper,
            $streetViewControlHelper,
            $zoomControlHelper,
            $markerClusterHelper,
            $markerImageHelper,
            $markerShapeHelper,
            $infoWindowHelper,
            $polylineHelper,
            $encodedPolylineHelper,
            $polygonHelper,
            $rectangleHelper,
            $circleHelper,
            $groundOverlayHelper,
            $kmlLayerHelper,
            $eventManagerHelper,
            $extensionHelpers
        );

        $this->assertSame($coordinateHelper, $this->mapHelper->getCoordinateHelper());
        $this->assertSame($boundHelper, $this->mapHelper->getBoundHelper());
        $this->assertSame($pointHelper, $this->mapHelper->getPointHelper());
        $this->assertSame($sizeHelper, $this->mapHelper->getSizeHelper());
        $this->assertSame($mapTypeIdHelper, $this->mapHelper->getMapTypeIdHelper());
        $this->assertSame($mapTypeControlHelper, $this->mapHelper->getMapTypeControlHelper());
        $this->assertSame($overviewMapControlHelper, $this->mapHelper->getOverviewMapControlHelper());
        $this->assertSame($panControlHelper, $this->mapHelper->getPanControlHelper());
        $this->assertSame($rotateControlHelper, $this->mapHelper->getRotateControlHelper());
        $this->assertSame($scaleControlHelper, $this->mapHelper->getScaleControlHelper());
        $this->assertSame($streetViewControlHelper, $this->mapHelper->getStreetViewControlHelper());
        $this->assertSame($zoomControlHelper, $this->mapHelper->getZoomControlHelper());
        $this->assertSame($markerClusterHelper, $this->mapHelper->getMarkerClusterHelper());
        $this->assertSame($markerImageHelper, $this->mapHelper->getMarkerImageHelper());
        $this->assertSame($markerShapeHelper, $this->mapHelper->getMarkerShapeHelper());
        $this->assertSame($infoWindowHelper, $this->mapHelper->getInfoWindowHelper());
        $this->assertSame($polylineHelper, $this->mapHelper->getPolylineHelper());
        $this->assertSame($encodedPolylineHelper, $this->mapHelper->getEncodedPolylineHelper());
        $this->assertSame($polygonHelper, $this->mapHelper->getPolygonHelper());
        $this->assertSame($rectangleHelper, $this->mapHelper->getRectangleHelper());
        $this->assertSame($circleHelper, $this->mapHelper->getCircleHelper());
        $this->assertSame($groundOverlayHelper, $this->mapHelper->getGroundOverlayHelper());
        $this->assertSame($kmlLayerHelper, $this->mapHelper->getKmlLayerHelper());
        $this->assertSame($eventManagerHelper, $this->mapHelper->getEventManagerHelper());
        $this->assertSame($extensionHelpers, $this->mapHelper->getExtensionHelpers());
    }

    public function testRemoveExtensionHelperWithValidValue()
    {
        $extensionHelper = $this->getMock('Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface');
        $this->mapHelper->setExtensionHelper('foo', $extensionHelper);

        $this->assertTrue($this->mapHelper->hasExtensionHelper('foo'));

        $this->mapHelper->removeExtensionHelper('foo');

        $this->assertFalse($this->mapHelper->hasExtensionHelper('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The extension helper "foo" does not exist.
     */
    public function testRemoveExtensionHelperWithInvalidValue()
    {
        $this->mapHelper->removeExtensionHelper('foo');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The extension helper "foo" does not exist.
     */
    public function testGetExtensionHelperWithInvalidValue()
    {
        $this->mapHelper->getExtensionHelper('foo');
    }

    public function testRenderHtmlContainer()
    {
        $map = new Map();
        $map->setHtmlContainerId('html_container_id');

        $this->assertSame(
            '<div id="html_container_id" style="width:300px;height:300px;"></div>'.PHP_EOL,
            $this->mapHelper->renderHtmlContainer($map)
        );
    }

    public function testRenderStylesheets()
    {
        $map = new Map();
        $map->setHtmlContainerId('html_container_id');
        $map->setStylesheetOptions(array('width' => '200px','height' => '100px', 'option1' => 'value1'));

        $expected = <<<EOF
<style type="text/css">
#html_container_id{
width:200px;
height:100px;
option1:value1;
}
</style>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderStylesheets($map));
    }

    public function testRenderJsContainerInit()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $expected = 'map_container = {'.
            '"map":null,'.
            '"coordinates":{},'.
            '"bounds":{},'.
            '"points":{},'.
            '"sizes":{},'.
            '"circles":{},'.
            '"encoded_polylines":{},'.
            '"ground_overlays":{},'.
            '"polygons":{},'.
            '"polylines":{},'.
            '"rectangles":{},'.
            '"info_windows":{},'.
            '"marker_images":{},'.
            '"marker_shapes":{},'.
            '"markers":{},'.
            '"marker_cluster":null,'.
            '"kml_layers":{},'.
            '"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},'.
            '"closable_info_windows":{},'.
            '"functions":{'.
                '"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }'.
            '}};'.PHP_EOL;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerInit($map));
    }

    public function testRenderJsContainerBounds()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getBound()->setJavascriptVariable('map_bound');

        $map->addGroundOverlay($groundOverlay = new GroundOverlay());
        $groundOverlay->getBound()->setJavascriptVariable('ground_overlay_bound');
        $groundOverlay->getBound()->getSouthWest()->setJavascriptVariable('ground_overlay_coordinate_south_west');
        $groundOverlay->getBound()->getNorthEast()->setJavascriptVariable('ground_overlay_coordinate_north_east');

        $map->addRectangle($rectangle = new Rectangle());
        $rectangle->getBound()->setJavascriptVariable('rectangle_bound');
        $rectangle->getBound()->getSouthWest()->setJavascriptVariable('rectangle_coordinate_south_west');
        $rectangle->getBound()->getNorthEast()->setJavascriptVariable('rectangle_coordinate_north_east');

        $map->setAutoZoom(true);

        $expected = <<<EOF
map_container.bounds.map_bound = map_bound = new google.maps.LatLngBounds();
map_container.bounds.ground_overlay_bound = ground_overlay_bound = new google.maps.LatLngBounds(ground_overlay_coordinate_south_west, ground_overlay_coordinate_north_east);
map_container.bounds.rectangle_bound = rectangle_bound = new google.maps.LatLngBounds(rectangle_coordinate_south_west, rectangle_coordinate_north_east);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerBounds($map));
    }

    public function testRenderJsContainerCoordinates()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getCenter()->setJavascriptVariable('map_center');

        $map->addRectangle($rectangle = new Rectangle());
        $rectangle->getBound()->getSouthWest()->setJavascriptVariable('rectangle_south_west');
        $rectangle->getBound()->getNorthEast()->setJavascriptVariable('rectangle_north_east');

        $map->addCircle($circle = new Circle());
        $circle->getCenter()->setJavascriptVariable('circle_center');

        $map->addInfoWindow($infoWindow = new InfoWindow());
        $infoWindow->setPosition(1, 2, true);
        $infoWindow->getPosition()->setJavascriptVariable('info_window_position');

        $map->addMarker($marker = new Marker());
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $map->addPolygon($polygon = new Polygon());
        $polygon->addCoordinate(1.1, 2.1);
        $polygon->addCoordinate(3.1, 4.2);

        foreach ($polygon->getCoordinates() as $index => $polygonCoordinate) {
            $polygonCoordinate->setJavascriptVariable('polygon_coordinate_'.$index);
        }

        $map->addPolyline($polyline = new Polyline());
        $polyline->addCoordinate(1.2, 2.6);
        $polyline->addCoordinate(3.2, 4.9);

        foreach ($polyline->getCoordinates() as $index => $polyline) {
            $polyline->setJavascriptVariable('polyline_coordinate_'.$index);
        }

        $expected = <<<EOF
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.rectangle_south_west = rectangle_south_west = new google.maps.LatLng(-1, -1, true);
map_container.coordinates.rectangle_north_east = rectangle_north_east = new google.maps.LatLng(1, 1, true);
map_container.coordinates.circle_center = circle_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.info_window_position = info_window_position = new google.maps.LatLng(1, 2, true);
map_container.coordinates.marker_position = marker_position = new google.maps.LatLng(0, 0, true);
map_container.coordinates.polygon_coordinate_0 = polygon_coordinate_0 = new google.maps.LatLng(1.1, 2.1, true);
map_container.coordinates.polygon_coordinate_1 = polygon_coordinate_1 = new google.maps.LatLng(3.1, 4.2, true);
map_container.coordinates.polyline_coordinate_0 = polyline_coordinate_0 = new google.maps.LatLng(1.2, 2.6, true);
map_container.coordinates.polyline_coordinate_1 = polyline_coordinate_1 = new google.maps.LatLng(3.2, 4.9, true);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerCoordinates($map));
    }

    public function testRenderJsContainerPoints()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());

        $marker->setIcon('url');

        $marker->getIcon()->setAnchor(1, 2);
        $marker->getIcon()->getAnchor()->setJavascriptVariable('marker_icon_anchor');

        $marker->getIcon()->setOrigin(1, 2);
        $marker->getIcon()->getOrigin()->setJavascriptVariable('marker_icon_origin');

        $marker->setShadow('url');

        $marker->getShadow()->setAnchor(1, 2);
        $marker->getShadow()->getAnchor()->setJavascriptVariable('marker_shadow_anchor');

        $marker->getShadow()->setOrigin(1, 2);
        $marker->getShadow()->getOrigin()->setJavascriptVariable('marker_shadow_origin');

        $expected = <<<EOF
map_container.points.marker_icon_anchor = marker_icon_anchor = new google.maps.Point(1, 2);
map_container.points.marker_icon_origin = marker_icon_origin = new google.maps.Point(1, 2);
map_container.points.marker_shadow_anchor = marker_shadow_anchor = new google.maps.Point(1, 2);
map_container.points.marker_shadow_origin = marker_shadow_origin = new google.maps.Point(1, 2);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerPoints($map));
    }

    public function testRenderJsContainerSizes()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addInfoWindow($mapInfoWindow = new InfoWindow());
        $mapInfoWindow->setPixelOffset(1, 2);
        $mapInfoWindow->getPixelOffset()->setJavascriptVariable('map_info_winfow_pixel_offset');

        $map->addMarker($marker = new Marker());

        $marker->setInfoWindow($markerInfoWindow = new InfoWindow());
        $markerInfoWindow->setPixelOffset(1, 2);
        $markerInfoWindow->getPixelOffset()->setJavascriptVariable('marker_info_window_pixel_offset');

        $marker->setIcon('url');

        $marker->getIcon()->setSize(1, 2);
        $marker->getIcon()->getSize()->setJavascriptVariable('marker_icon_size');

        $marker->getIcon()->setScaledSize(1, 2);
        $marker->getIcon()->getScaledSize()->setJavascriptVariable('marker_icon_scaled_size');

        $marker->setShadow('url');

        $marker->getShadow()->setSize(1, 2);
        $marker->getShadow()->getSize()->setJavascriptVariable('marker_shadow_size');

        $marker->getShadow()->setScaledSize(1, 2);
        $marker->getShadow()->getScaledSize()->setJavascriptVariable('marker_shadow_scaled_size');

        $expected = <<<EOF
map_container.sizes.map_info_winfow_pixel_offset = map_info_winfow_pixel_offset = new google.maps.Size(1, 2);
map_container.sizes.marker_info_window_pixel_offset = marker_info_window_pixel_offset = new google.maps.Size(1, 2);
map_container.sizes.marker_icon_size = marker_icon_size = new google.maps.Size(1, 2);
map_container.sizes.marker_icon_scaled_size = marker_icon_scaled_size = new google.maps.Size(1, 2);
map_container.sizes.marker_shadow_size = marker_shadow_size = new google.maps.Size(1, 2);
map_container.sizes.marker_shadow_scaled_size = marker_shadow_scaled_size = new google.maps.Size(1, 2);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerSizes($map));
    }

    public function testRenderMapCenter()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getCenter()->setJavascriptVariable('map_center');

        $this->assertSame('map.setCenter(map_center);'.PHP_EOL, $this->mapHelper->renderMapCenter($map));
    }

    public function testRenderMapBound()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getBound()->setJavascriptVariable('map_bound');

        $this->assertSame('map.fitBounds(map_bound);'.PHP_EOL, $this->mapHelper->renderMapBound($map));
    }

    public function testRenderMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $expected = <<<EOF
map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});

EOF;
        $this->assertSame($expected, $this->mapHelper->renderMap($map));
    }

    public function testRenderMapWithEnabledMapControls()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->setMapTypeControl(
            array(MapTypeId::TERRAIN),
            ControlPosition::BOTTOM_CENTER,
            MapTypeControlStyle::HORIZONTAL_BAR
        );

        // FIXME Add all map controls...

        $expected = 'map = new google.maps.Map('.
            'document.getElementById("map_canvas"), '.
            '{'.
            '"mapTypeId":google.maps.MapTypeId.ROADMAP,'.
            '"mapTypeControl":true,'.
            '"mapTypeControlOptions":'.
            '{'.
            '"mapTypeIds":[google.maps.MapTypeId.TERRAIN],'.
            '"position":google.maps.ControlPosition.BOTTOM_CENTER,'.
            '"style":google.maps.MapTypeControlStyle.HORIZONTAL_BAR'.
            '},'.
            '"zoom":3'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->mapHelper->renderMap($map));
    }

    public function testRenderMapWithDisabledMapControls()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setMapOption('mapTypeControl', false);

        $expected = 'map = new google.maps.Map('.
            'document.getElementById("map_canvas"), '.
            '{"mapTypeId":google.maps.MapTypeId.ROADMAP,"mapTypeControl":false,"zoom":3}'.
            ');'.PHP_EOL;

        $this->assertSame($expected, $this->mapHelper->renderMap($map));
    }

    public function testRenderJsContainerMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerMap($map));
    }

    public function testRenderJsContainerCircles()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addCircle($circle = new Circle());
        $circle->setJavascriptVariable('circle');
        $circle->getCenter()->setJavascriptVariable('circle_center');

        $expected = <<<EOF
map_container.circles.circle = circle = new google.maps.Circle({"map":map,"center":circle_center,"radius":1});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerCircles($map));
    }

    public function testRenderJsContainerEncodedPolylines()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addEncodedPolyline($encodedPolyline = new EncodedPolyline('foo'));
        $encodedPolyline->setJavascriptVariable('encoded_polyline');

        $expected = <<<EOF
map_container.encoded_polylines.encoded_polyline = encoded_polyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo")});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerEncodedPolylines($map));
    }

    public function testRenderJsContainerGroundOverlays()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addGroundOverlay($groundOverlay = new GroundOverlay('url'));
        $groundOverlay->setJavascriptVariable('ground_overlay');
        $groundOverlay->getBound()->setJavascriptVariable('ground_overlay_bound');

        $expected = <<<EOF
map_container.ground_overlays.ground_overlay = ground_overlay = new google.maps.GroundOverlay("url", ground_overlay_bound, {"map":map});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerGroundOverlays($map));
    }

    public function testRenderJsContainerPolygons()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addPolygon($polygon = new Polygon());
        $polygon->setJavascriptVariable('polygon');

        $expected = <<<EOF
map_container.polygons.polygon = polygon = new google.maps.Polygon({"map":map,"paths":[]});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerPolygons($map));
    }

    public function testRenderJsContainerPolylines()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addPolyline($polyline = new Polyline());
        $polyline->setJavascriptVariable('polyline');

        $expected = <<<EOF
map_container.polylines.polyline = polyline = new google.maps.Polyline({"map":map,"path":[]});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerPolylines($map));
    }

    public function testRenderJsContainerRectangles()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addRectangle($rectangle = new Rectangle());
        $rectangle->setJavascriptVariable('rectangle');
        $rectangle->getBound()->setJavascriptVariable('rectangle_bound');

        $expected = <<<EOF
map_container.rectangles.rectangle = rectangle = new google.maps.Rectangle({"map":map,"bounds":rectangle_bound});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerRectangles($map));
    }

    public function testRenderJsContainerInfoWindowsWithoutClosableOnes()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addInfoWindow($mapInfoWindow = new InfoWindow());
        $mapInfoWindow->setJavascriptVariable('map_info_window');
        $mapInfoWindow->setPosition(1, 2, true);
        $mapInfoWindow->getPosition()->setJavascriptVariable('map_info_window_position');

        $map->addMarker($marker = new Marker());
        $marker->setInfoWindow($markerInfoWindow = new InfoWindow());
        $markerInfoWindow->setJavascriptVariable('marker_info_window');
        $markerInfoWindow->setPosition(1, 2, true);
        $markerInfoWindow->getPosition()->setJavascriptVariable('marker_info_window_position');

        $expected = <<<EOF
map_container.info_windows.map_info_window = map_info_window = new google.maps.InfoWindow({"position":map_info_window_position,"content":"<p>Default content<\/p>"});
map_container.info_windows.marker_info_window = marker_info_window = new google.maps.InfoWindow({"content":"<p>Default content<\/p>"});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerInfoWindows($map));
    }

    public function testRenderJsContainerInfoWindowsWithClosableOnes()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addInfoWindow($mapInfoWindow = new InfoWindow());
        $mapInfoWindow->setJavascriptVariable('map_info_window');
        $mapInfoWindow->setPosition(1, 2, true);
        $mapInfoWindow->getPosition()->setJavascriptVariable('map_info_window_position');

        $map->addMarker($marker = new Marker());
        $marker->setInfoWindow($markerInfoWindow = new InfoWindow());
        $markerInfoWindow->setJavascriptVariable('marker_info_window');
        $markerInfoWindow->setPosition(1, 2, true);
        $markerInfoWindow->getPosition()->setJavascriptVariable('marker_info_window_position');

        $mapInfoWindow->setAutoClose(true);
        $markerInfoWindow->setAutoClose(true);

        $expected = <<<EOF
map_container.info_windows.map_info_window = map_info_window = new google.maps.InfoWindow({"position":map_info_window_position,"content":"<p>Default content<\/p>"});
map_container.info_windows.marker_info_window = marker_info_window = new google.maps.InfoWindow({"content":"<p>Default content<\/p>"});
map_container.closable_info_windows.map_info_window = map_info_window;
map_container.closable_info_windows.marker_info_window = marker_info_window;

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerInfoWindows($map));
    }

    public function testRenderJsContainerMarkerImages()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());

        $marker->setIcon('url_icon');
        $marker->getIcon()->setJavascriptVariable('marker_icon');

        $marker->setShadow('shadow_url');
        $marker->getShadow()->setJavascriptVariable('marker_shadow');

        $expected = <<<EOF
map_container.marker_images.marker_icon = marker_icon = new google.maps.MarkerImage("url_icon", null, null, null, null);
map_container.marker_images.marker_shadow = marker_shadow = new google.maps.MarkerImage("shadow_url", null, null, null, null);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerMarkerImages($map));
    }

    public function testRenderJsContainerMarkerShapes()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());
        $marker->setShape('poly', array(1, 1, 1, -1, -1, -1, -1, 1));
        $marker->getShape()->setJavascriptVariable('marker_shape');

        $expected = <<<EOF
map_container.marker_shapes.marker_shape = marker_shape = new google.maps.MarkerShape({"type":"poly","coords":[1,1,1,-1,-1,-1,-1,1]});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerMarkerShapes($map));
    }

    public function testRenderJsContainerMarkerCluster()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $expected = <<<EOF
map_container.markers.marker = marker = new google.maps.Marker({"position":marker_position,"map":map});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerMarkerCluster($map));
    }

    public function testRenderJsContainerKMLLayers()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->addKMLLayer($kmlLayer = new KMLLayer('url'));
        $kmlLayer->setJavascriptVariable('kml_layer');

        $expected = <<<EOF
map_container.kml_layers.kml_layer = kml_layer = new google.maps.KmlLayer("url", {"map":map});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerKMLLayers($map));
    }

    public function testRenderJsContainerEventManager()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $baseEvent = new Event('instance', 'click', 'function(){}', false);

        $map->getEventManager()->addDomEvent($domEvent = clone $baseEvent);
        $domEvent->setJavascriptVariable('dom_event');

        $map->getEventManager()->addDomEventOnce($domEventOnce = clone $baseEvent);
        $domEventOnce->setJavascriptVariable('dom_event_once');

        $map->getEventManager()->addEvent($event = clone $baseEvent);
        $event->setJavascriptVariable('event');

        $map->getEventManager()->addEventOnce($eventOnce = clone $baseEvent);
        $eventOnce->setJavascriptVariable('event_once');

        $expected = <<<EOF
map_container.event_manager.dom_events.dom_event = dom_event = google.maps.event.addDomListener(instance, "click", function(){}, false);
map_container.event_manager.dom_events_once.dom_event_once = dom_event_once = google.maps.event.addDomListenerOnce(instance, "click", function(){}, false);
map_container.event_manager.events.event = event = google.maps.event.addListener(instance, "click", function(){});
map_container.event_manager.events_once.event_once = event_once = google.maps.event.addListenerOnce(instance, "click", function(){});

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainerEventManager($map));
    }

    public function testRenderJsContainerWithDefaultMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(map_center);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainer($map));
    }

    public function testRenderJsContainerWithComplexMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->setAutoZoom(true);
        $map->getBound()->setJavascriptVariable('map_bound');

        $map->addCircle($circle = new Circle());
        $circle->setJavascriptVariable('circle');
        $circle->getCenter()->setJavascriptVariable('circle_center');

        $map->addEncodedPolyline($encodedPolyline = new EncodedPolyline('foo'));
        $encodedPolyline->setJavascriptVariable('encoded_polyline');

        $map->addGroundOverlay($groundOverlay = new GroundOverlay('url'));
        $groundOverlay->setJavascriptVariable('ground_overlay');
        $groundOverlay->getBound()->setJavascriptVariable('ground_overlay_bound');
        $groundOverlay->getBound()->setSouthWest(1, 2, true);
        $groundOverlay->getBound()->getSouthWest()->setJavascriptVariable('ground_overlay_bound_south_west');
        $groundOverlay->getBound()->setNorthEast(3, 4, true);
        $groundOverlay->getBound()->getNorthEast()->setJavascriptVariable('ground_overlay_bound_north_east');

        $map->addPolygon($polygon = new Polygon());
        $polygon->setJavascriptVariable('polygon');

        $map->addPolyline($polyline = new Polyline());
        $polyline->setJavascriptVariable('polyline');

        $map->addRectangle($rectangle = new Rectangle());
        $rectangle->setJavascriptVariable('rectangle');
        $rectangle->getBound()->setJavascriptVariable('rectangle_bound');
        $rectangle->getBound()->setSouthWest(1, 2, true);
        $rectangle->getBound()->getSouthWest()->setJavascriptVariable('rectangle_bound_south_west');
        $rectangle->getBound()->setNorthEast(3, 4, true);
        $rectangle->getBound()->getNorthEast()->setJavascriptVariable('rectangle_bound_north_east');

        $map->addInfoWindow($mapInfoWindow = new InfoWindow());
        $mapInfoWindow->setJavascriptVariable('map_info_window');
        $mapInfoWindow->setPosition(1, 2, true);
        $mapInfoWindow->getPosition()->setJavascriptVariable('map_info_window_position');

        $map->addMarker($marker = new Marker());
        $marker->setJavascriptVariable('marker');
        $marker->getPosition()->setJavascriptVariable('marker_position');

        $marker->setInfoWindow($markerInfoWindow = new InfoWindow());
        $markerInfoWindow->setJavascriptVariable('marker_info_window');

        $marker->setIcon('url');
        $marker->getIcon()->setJavascriptVariable('marker_icon');

        $marker->setShadow('url');
        $marker->getShadow()->setJavascriptVariable('marker_shadow');

        $map->addKMLLayer($kmlLayer = new KMLLayer('url'));
        $kmlLayer->setJavascriptVariable('kml_layer');

        $map->getEventManager()->addEvent($event = new Event('instance', 'click', 'function(){}', false));
        $event->setJavascriptVariable('event');

        $expected = <<<EOF
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.ground_overlay_bound_south_west = ground_overlay_bound_south_west = new google.maps.LatLng(1, 2, true);
map_container.coordinates.ground_overlay_bound_north_east = ground_overlay_bound_north_east = new google.maps.LatLng(3, 4, true);
map_container.coordinates.rectangle_bound_south_west = rectangle_bound_south_west = new google.maps.LatLng(1, 2, true);
map_container.coordinates.rectangle_bound_north_east = rectangle_bound_north_east = new google.maps.LatLng(3, 4, true);
map_container.coordinates.circle_center = circle_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.map_info_window_position = map_info_window_position = new google.maps.LatLng(1, 2, true);
map_container.coordinates.marker_position = marker_position = new google.maps.LatLng(0, 0, true);
map_container.bounds.map_bound = map_bound = new google.maps.LatLngBounds();
map_container.bounds.ground_overlay_bound = ground_overlay_bound = new google.maps.LatLngBounds(ground_overlay_bound_south_west, ground_overlay_bound_north_east);
map_container.bounds.rectangle_bound = rectangle_bound = new google.maps.LatLngBounds(rectangle_bound_south_west, rectangle_bound_north_east);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP});
map_container.circles.circle = circle = new google.maps.Circle({"map":map,"center":circle_center,"radius":1});
map_container.encoded_polylines.encoded_polyline = encoded_polyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo")});
map_container.ground_overlays.ground_overlay = ground_overlay = new google.maps.GroundOverlay("url", ground_overlay_bound, {"map":map});
map_container.polygons.polygon = polygon = new google.maps.Polygon({"map":map,"paths":[]});
map_container.polylines.polyline = polyline = new google.maps.Polyline({"map":map,"path":[]});
map_container.rectangles.rectangle = rectangle = new google.maps.Rectangle({"map":map,"bounds":rectangle_bound});
map_container.info_windows.map_info_window = map_info_window = new google.maps.InfoWindow({"position":map_info_window_position,"content":"<p>Default content<\/p>"});
map_container.info_windows.marker_info_window = marker_info_window = new google.maps.InfoWindow({"content":"<p>Default content<\/p>"});
map_container.marker_images.marker_icon = marker_icon = new google.maps.MarkerImage("url", null, null, null, null);
map_container.marker_images.marker_shadow = marker_shadow = new google.maps.MarkerImage("url", null, null, null, null);
map_container.markers.marker = marker = new google.maps.Marker({"position":marker_position,"map":map,"icon":marker_icon,"shadow":marker_shadow});
map_container.kml_layers.kml_layer = kml_layer = new google.maps.KmlLayer("url", {"map":map});
map_container.event_manager.events.event = event = google.maps.event.addListener(instance, "click", function(){});
map_container.event_manager.events.marker_info_window_event = marker_info_window_event = google.maps.event.addListener(marker, "click", function () {
    for (var info_window in map_container.closable_info_windows) {
        map_container.closable_info_windows[info_window].close();
    }
    marker_info_window.open(map, marker);

});
map_bound.union(circle.getBounds());
encoded_polyline.getPath().forEach(function(element){map_bound.extend(element)});
map_bound.union(ground_overlay_bound);
polygon.getPath().forEach(function(element){map_bound.extend(element)});
polyline.getPath().forEach(function(element){map_bound.extend(element)});
map_bound.union(rectangle_bound);
map_bound.extend(map_info_window.getPosition());
map_bound.extend(marker.getPosition());
map.fitBounds(map_bound);

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJsContainer($map));
    }

    public function testRenderJavascripts()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithEncodedPolyline()
    {
        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setJavascriptVariable('encoded_polyline');

        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->addEncodedPolyline($encodedPolyline);

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"libraries=geometry&language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map_container.encoded_polylines.encoded_polyline = encoded_polyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo")});
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithLibraries()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setLibraries(array('places'));

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"libraries=places&language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithAsync()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setAsync(true);

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map() {
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(map_center);
}
</script>
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false","callback":load_ivory_google_map}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMapInfoWindowOpened()
    {
        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('info_window');
        $infoWindow->setPosition(1.1, 2.2, true);
        $infoWindow->getPosition()->setJavascriptVariable('info_window_position');
        $infoWindow->setContent('foo');
        $infoWindow->setAutoOpen(false);
        $infoWindow->setOpen(true);

        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getCenter()->setJavascriptVariable('map_center');
        $map->addInfoWindow($infoWindow);

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.info_window_position = info_window_position = new google.maps.LatLng(1.1, 2.2, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map_container.info_windows.info_window = info_window = new google.maps.InfoWindow({"position":info_window_position,"content":"foo"});
info_window.open(map);
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMarkerInfoWindowOpened()
    {
        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('info_window');
        $infoWindow->setContent('foo');
        $infoWindow->setAutoOpen(false);
        $infoWindow->setOpen(true);

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');
        $marker->setPosition(1.2, 2.1, true);
        $marker->getPosition()->setJavascriptVariable('marker_position');
        $marker->setInfoWindow($infoWindow);

        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getCenter()->setJavascriptVariable('map_center');
        $map->addMarker($marker);

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.marker_position = marker_position = new google.maps.LatLng(1.2, 2.1, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map_container.info_windows.info_window = info_window = new google.maps.InfoWindow({"content":"foo"});
map_container.markers.marker = marker = new google.maps.Marker({"position":marker_position,"map":map});
info_window.open(map, marker);
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMultipleMaps()
    {
        $map1 = new Map();
        $map1->setJavascriptVariable('map1');
        $map1->getCenter()->setJavascriptVariable('map1_center');

        $expected1 = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map1_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map1_container.coordinates.map1_center = map1_center = new google.maps.LatLng(0, 0, true);
map1_container.map = map1 = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map1.setCenter(map1_center);
</script>

EOF;

        $map2 = new Map();
        $map2->setJavascriptVariable('map2');
        $map2->getCenter()->setJavascriptVariable('map2_center');

        $expected2 = <<<EOF
<script type="text/javascript">
map2_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map2_container.coordinates.map2_center = map2_center = new google.maps.LatLng(0, 0, true);
map2_container.map = map2 = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map2.setCenter(map2_center);
</script>

EOF;

        $this->assertSame($expected1, $this->mapHelper->renderJavascripts($map1));
        $this->assertSame($expected2, $this->mapHelper->renderJavascripts($map2));
    }

    public function testRenderJavascriptsWithInfoBox()
    {
        $this->mapHelper->setInfoWindowHelper(new InfoBoxHelper());
        $this->mapHelper->setExtensionHelper('info_box', new InfoBoxExtensionHelper());

        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->getCenter()->setJavascriptVariable('map_center');

        $map->addInfoWindow($infoBox = new InfoWindow());
        $infoBox->setJavascriptVariable('map_info_box');
        $infoBox->setPosition(1, 2, true);
        $infoBox->getPosition()->setJavascriptVariable('map_info_box_position');

        $expected = <<<EOF
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript" src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.coordinates.map_info_box_position = map_info_box_position = new google.maps.LatLng(1, 2, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map_container.info_windows.map_info_box = map_info_box = new InfoBox({"position":map_info_box_position,"content":"<p>Default content<\/p>"});
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRender()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->getCenter()->setJavascriptVariable('map_center');

        $expected = <<<EOF
<div id="map_canvas" style="width:300px;height:300px;"></div>
<style type="text/css">
#map_canvas{
width:300px;
height:300px;
}
</style>
<script type="text/javascript">
function load_ivory_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_ivory_google_map_api"></script>
<script type="text/javascript">
map_container = {"map":null,"coordinates":{},"bounds":{},"points":{},"sizes":{},"circles":{},"encoded_polylines":{},"ground_overlays":{},"polygons":{},"polylines":{},"rectangles":{},"info_windows":{},"marker_images":{},"marker_shapes":{},"markers":{},"marker_cluster":null,"kml_layers":{},"event_manager":{"dom_events":{},"dom_events_once":{},"events":{},"events_once":{}},"closable_info_windows":{},"functions":{"to_array":function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }}};
map_container.coordinates.map_center = map_center = new google.maps.LatLng(0, 0, true);
map_container.map = map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(map_center);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->render($map));
    }
}
