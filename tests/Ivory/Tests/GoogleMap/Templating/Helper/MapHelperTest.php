<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper;

use Ivory\GoogleMap\Base\Bound,
    Ivory\GoogleMap\Base\Coordinate,
    Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\Layers\KMLLayer,
    Ivory\GoogleMap\Map,
    Ivory\GoogleMap\MapTypeId,
    Ivory\GoogleMap\Overlays\Circle,
    Ivory\GoogleMap\Overlays\EncodedPolyline,
    Ivory\GoogleMap\Overlays\GroundOverlay,
    Ivory\GoogleMap\Overlays\InfoWindow,
    Ivory\GoogleMap\Overlays\Marker,
    Ivory\GoogleMap\Overlays\Polygon,
    Ivory\GoogleMap\Overlays\Polyline,
    Ivory\GoogleMap\Overlays\Rectangle,
    Ivory\GoogleMap\Templating\Helper\MapHelper;

/**
 * Map helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\MapHelper */
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
            'Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper',
            $this->mapHelper->getCoordinateHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\BoundHelper',
            $this->mapHelper->getBoundHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper',
            $this->mapHelper->getMapTypeIdHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper',
            $this->mapHelper->getMapTypeControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper',
            $this->mapHelper->getOverviewMapControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper',
            $this->mapHelper->getPanControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper',
            $this->mapHelper->getRotateControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper',
            $this->mapHelper->getScaleControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper',
            $this->mapHelper->getStreetViewControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper',
            $this->mapHelper->getZoomControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper',
            $this->mapHelper->getMarkerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper',
            $this->mapHelper->getInfoWindowHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper',
            $this->mapHelper->getPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper',
            $this->mapHelper->getEncodedPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper',
            $this->mapHelper->getPolygonHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper',
            $this->mapHelper->getRectangleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper',
            $this->mapHelper->getCircleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper',
            $this->mapHelper->getGroundOverlayHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper',
            $this->mapHelper->getKmlLayerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper',
            $this->mapHelper->getEventManagerHelper()
        );
    }

    public function testInitialState()
    {
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper');
        $boundHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\BoundHelper');
        $mapTypeIdHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper');
        $mapTypeControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper');
        $overviewMapControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper');
        $panControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper');
        $rotateControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper');
        $scaleControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper');
        $streetViewControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper');
        $zoomControlHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper');
        $markerHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper');
        $infoWindowHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper');
        $polylineHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper');
        $encodedPolylineHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper');
        $polygonHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper');
        $rectangleHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper');
        $circleHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper');
        $groundOverlayHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper');
        $kmlLayerHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper');
        $eventManagerHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper');

        $this->mapHelper = new MapHelper(
            $coordinateHelper,
            $boundHelper,
            $mapTypeIdHelper,
            $mapTypeControlHelper,
            $overviewMapControlHelper,
            $panControlHelper,
            $rotateControlHelper,
            $scaleControlHelper,
            $streetViewControlHelper,
            $zoomControlHelper,
            $markerHelper,
            $infoWindowHelper,
            $polylineHelper,
            $encodedPolylineHelper,
            $polygonHelper,
            $rectangleHelper,
            $circleHelper,
            $groundOverlayHelper,
            $kmlLayerHelper,
            $eventManagerHelper
        );

        $this->assertSame($coordinateHelper, $this->mapHelper->getCoordinateHelper());
        $this->assertSame($boundHelper, $this->mapHelper->getBoundHelper());
        $this->assertSame($mapTypeIdHelper, $this->mapHelper->getMapTypeIdHelper());
        $this->assertSame($mapTypeControlHelper, $this->mapHelper->getMapTypeControlHelper());
        $this->assertSame($overviewMapControlHelper, $this->mapHelper->getOverviewMapControlHelper());
        $this->assertSame($panControlHelper, $this->mapHelper->getPanControlHelper());
        $this->assertSame($rotateControlHelper, $this->mapHelper->getRotateControlHelper());
        $this->assertSame($scaleControlHelper, $this->mapHelper->getScaleControlHelper());
        $this->assertSame($streetViewControlHelper, $this->mapHelper->getStreetViewControlHelper());
        $this->assertSame($zoomControlHelper, $this->mapHelper->getZoomControlHelper());
        $this->assertSame($markerHelper, $this->mapHelper->getMarkerHelper());
        $this->assertSame($infoWindowHelper, $this->mapHelper->getInfoWindowHelper());
        $this->assertSame($polylineHelper, $this->mapHelper->getPolylineHelper());
        $this->assertSame($encodedPolylineHelper, $this->mapHelper->getEncodedPolylineHelper());
        $this->assertSame($polygonHelper, $this->mapHelper->getPolygonHelper());
        $this->assertSame($rectangleHelper, $this->mapHelper->getRectangleHelper());
        $this->assertSame($circleHelper, $this->mapHelper->getCircleHelper());
        $this->assertSame($groundOverlayHelper, $this->mapHelper->getGroundOverlayHelper());
        $this->assertSame($kmlLayerHelper, $this->mapHelper->getKmlLayerHelper());
        $this->assertSame($eventManagerHelper, $this->mapHelper->getEventManagerHelper());
    }

    public function testRenderContainer()
    {
        $map = new Map();
        $map->setHtmlContainerId('html_container_id');

        $this->assertSame(
            '<div id="html_container_id" style="width:300px;height:300px;"></div>'.PHP_EOL,
            $this->mapHelper->renderContainer($map)
        );
    }

    public function testRenderStylesheets()
    {
        $map = new Map();
        $map->setHtmlContainerId('html_container_id');
        $map->setStylesheetOptions(array(
            'width'   => '200px',
            'height'  => '100px',
            'option1' => 'value1'
        ));

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

    public function testRenderJavascriptsWithOneSimpleMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMultipleSimpleMaps()
    {
        $map1 = new Map();
        $map1->setJavascriptVariable('map1');
        $map1->setHtmlContainerId('map_canvas_1');

        $map2 = new Map();
        $map2->setJavascriptVariable('map2');
        $map2->setHtmlContainerId('map_canvas_2');

        $map1Expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map1 = new google.maps.Map(document.getElementById("map_canvas_1"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map1.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $map2Expected = <<<EOF
<script type="text/javascript">
var map2 = new google.maps.Map(document.getElementById("map_canvas_2"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map2.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($map1Expected, $this->mapHelper->renderJavascripts($map1));
        $this->assertSame($map2Expected, $this->mapHelper->renderJavascripts($map2));
    }

    public function testRenderJavascriptsWithAsyncMap()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setAsync(true);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?callback=load_ivory_google_map&amp;language=en&amp;sensor=false"></script>
<script type="text/javascript">
function load_ivory_google_map() {
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(new google.maps.LatLng(0, 0, true));
}
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMapCenter()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setCenter(new Coordinate(1, 2, true));

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(new google.maps.LatLng(1, 2, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMapBound()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setAutoZoom(true);
        $map->setBound(new Bound(new Coordinate(-1, -2, true), new Coordinate(1, 2, true)));
        $map->getBound()->setJavascriptVariable('mapBound');

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP});
var mapBound = new google.maps.LatLngBounds(new google.maps.LatLng(-1, -2, true), new google.maps.LatLng(1, 2, true));
map.fitBounds(mapBound);
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithEnabledMapControls()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $map->setMapTypeControl(
            array(MapTypeId::TERRAIN),
            ControlPosition::BOTTOM_CENTER,
            MapTypeControlStyle::HORIZONTAL_BAR
        );

        // FIXME Add all map controls...

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"mapTypeControl":true,"mapTypeControlOptions":{"mapTypeIds":[google.maps.MapTypeId.TERRAIN],"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.MapTypeControlStyle.HORIZONTAL_BAR},"zoom":3});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithDisabledMapControls()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');
        $map->setMapOption('mapTypeControl', false);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"mapTypeControl":false,"zoom":3});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMarker()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');
        $map->addMarker($marker);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var marker = new google.maps.Marker({"map":map,"position":new google.maps.LatLng(0, 0, true)});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderjavascriptsWithInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $infoWindow->setPosition(1, 2, true);

        $map->addInfoWindow($infoWindow);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var infoWindow = new google.maps.InfoWindow({"position":new google.maps.LatLng(1, 2, true),"content":"<p>Default content<\/p>"});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderjavascriptsWithOpenInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $infoWindow->setPosition(1, 2, true);
        $infoWindow->setOpen(true);

        $map->addInfoWindow($infoWindow);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var infoWindow = new google.maps.InfoWindow({"position":new google.maps.LatLng(1, 2, true),"content":"<p>Default content<\/p>"});
infoWindow.open(map);
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMarkerAndInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');
        $map->addMarker($marker);

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $marker->setInfoWindow($infoWindow);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var marker = new google.maps.Marker({"map":map,"position":new google.maps.LatLng(0, 0, true)});
var infoWindow = new google.maps.InfoWindow({"content":"<p>Default content<\/p>"});
map.setCenter(new google.maps.LatLng(0, 0, true));
var marker_info_window_event = google.maps.event.addListener(marker, "click", function () {infoWindow.open(map, marker);});
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithMarkerAndClosableInfoWindow()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $marker = new Marker();
        $marker->setJavascriptVariable('marker');
        $map->addMarker($marker);

        $markerInfoWindow = new InfoWindow();
        $markerInfoWindow->setJavascriptVariable('markerInfoWindow');
        $markerInfoWindow->setAutoClose(true);
        $marker->setInfoWindow($markerInfoWindow);

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $infoWindow->setPosition(1, 2, true);
        $infoWindow->setAutoClose(true);
        $map->addInfoWindow($infoWindow);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var marker = new google.maps.Marker({"map":map,"position":new google.maps.LatLng(0, 0, true)});
var markerInfoWindow = new google.maps.InfoWindow({"content":"<p>Default content<\/p>"});
var infoWindow = new google.maps.InfoWindow({"position":new google.maps.LatLng(1, 2, true),"content":"<p>Default content<\/p>"});
map.setCenter(new google.maps.LatLng(0, 0, true));
var closable_info_windows = Array(infoWindow, markerInfoWindow);
var marker_info_window_event = google.maps.event.addListener(marker, "click", function () {
    for (var info_window in closable_info_windows) {
        closable_info_windows[info_window].close();
    }
    markerInfoWindow.open(map, marker);
});
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithPolyline()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $polyline = new Polyline();
        $polyline->addCoordinate(1, 2);
        $polyline->addCoordinate(3, 4);
        $polyline->setJavascriptVariable('polyline');

        $map->addPolyline($polyline);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var polyline = new google.maps.Polyline({"map":map,"path":[new google.maps.LatLng(1, 2, true),new google.maps.LatLng(3, 4, true)]});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithEncodedPolyline()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $encodedPolyline = new EncodedPolyline('foo');
        $encodedPolyline->setJavascriptVariable('encodedPolyline');

        $map->addEncodedPolyline($encodedPolyline);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?libraries=geometry&amp;language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var encodedPolyline = new google.maps.Polyline({"map":map,"path":google.maps.geometry.encoding.decodePath("foo")});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithPolygon()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $polygon = new Polygon();
        $polygon->setJavascriptVariable('polygon');
        $polygon->addCoordinate(1, 2);
        $polygon->addCoordinate(3, 4);

        $map->addPolygon($polygon);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var polygon = new google.maps.Polygon({"map":map,"paths":[new google.maps.LatLng(1, 2, true),new google.maps.LatLng(3, 4, true)]});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithRectangle()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $rectangle = new Rectangle();
        $rectangle->setJavascriptVariable('rectangle');
        $rectangle->getBound()->setJavascriptVariable('rectangleBound');

        $map->addRectangle($rectangle);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var rectangleBound = new google.maps.LatLngBounds(new google.maps.LatLng(-1, -1, true), new google.maps.LatLng(1, 1, true));
var rectangle = new google.maps.Rectangle({"map":map,"bounds":rectangleBound});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithCircle()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $circle = new Circle();
        $circle->setJavascriptVariable('circle');

        $map->addCircle($circle);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var circle = new google.maps.Circle({"map":map,"center":new google.maps.LatLng(0, 0, true),"radius":1});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithGroundOverlay()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $groundOverlay = new GroundOverlay('url');
        $groundOverlay->setJavascriptVariable('groundOverlay');
        $groundOverlay->getBound()->setJavascriptVariable('groundOverlayBound');

        $map->addGroundOverlay($groundOverlay);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
var groundOverlayBound = new google.maps.LatLngBounds(new google.maps.LatLng(-1, -1, true), new google.maps.LatLng(1, 1, true));
var groundOverlay = new google.maps.GroundOverlay("url", groundOverlayBound, {"map":map});
map.setCenter(new google.maps.LatLng(0, 0, true));
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }

    public function testRenderJavascriptsWithKmlLayer()
    {
        $map = new Map();
        $map->setJavascriptVariable('map');

        $kmlLayer = new KMLLayer('url');
        $kmlLayer->setJavascriptVariable('kmlLayer');

        $map->addKMLLayer($kmlLayer);

        $expected = <<<EOF
<script type="text/javascript" src="//maps.google.com/maps/api/js?language=en&amp;sensor=false"></script>
<script type="text/javascript">
var map = new google.maps.Map(document.getElementById("map_canvas"), {"mapTypeId":google.maps.MapTypeId.ROADMAP,"zoom":3});
map.setCenter(new google.maps.LatLng(0, 0, true));
var kmlLayer = new google.maps.KmlLayer("url", {"map":map});
</script>

EOF;

        $this->assertSame($expected, $this->mapHelper->renderJavascripts($map));
    }
}
