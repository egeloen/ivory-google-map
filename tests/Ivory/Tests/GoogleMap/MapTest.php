<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;

/**
 * Map test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Map */
    protected $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->map = new Map();
    }

    /**
     * Set up the map bound.
     */
    protected function setUpBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->any())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->map->setBound($bound);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->map);
    }

    public function testDefaultState()
    {
        $this->assertSame('map_canvas', $this->map->getHtmlContainerId());
        $this->assertFalse($this->map->isAsync());
        $this->assertFalse($this->map->isAutoZoom());

        $this->assertSame($this->map->getCenter()->getLatitude(), 0);
        $this->assertSame($this->map->getCenter()->getLongitude(), 0);
        $this->assertTrue($this->map->getCenter()->isNoWrap());

        $this->assertNull($this->map->getBound()->getNorthEast());
        $this->assertNull($this->map->getBound()->getSouthWest());
        $this->assertEmpty($this->map->getBound()->getExtends());

        $this->assertSame(array('mapTypeId' => 'roadmap','zoom' => 3), $this->map->getMapOptions());
        $this->assertSame(array('width' => '300px', 'height' => '300px'), $this->map->getStylesheetOptions());

        $this->assertFalse($this->map->hasMapTypeControl());
        $this->assertFalse($this->map->hasOverviewMapControl());
        $this->assertFalse($this->map->hasPanControl());
        $this->assertFalse($this->map->hasRotateControl());
        $this->assertFalse($this->map->hasScaleControl());
        $this->assertFalse($this->map->hasStreetViewControl());
        $this->assertFalse($this->map->hasZoomControl());

        $this->assertInstanceOf('Ivory\GoogleMap\Events\EventManager', $this->map->getEventManager());

        $this->assertEmpty($this->map->getMarkers());
        $this->assertEmpty($this->map->getInfoWindows());
        $this->assertEmpty($this->map->getPolylines());
        $this->assertEmpty($this->map->getPolygons());
        $this->assertEmpty($this->map->getEncodedPolylines());
        $this->assertEmpty($this->map->getRectangles());
        $this->assertEmpty($this->map->getCircles());
        $this->assertEmpty($this->map->getGroundOverlays());

        $this->assertEmpty($this->map->getKMLLayers());

        $this->assertFalse($this->map->hasLibraries());
        $this->assertSame('en', $this->map->getLanguage());
    }

    public function testHtmlContainerIdWithValidValue()
    {
        $this->map->setHtmlContainerId('html_container_id');

        $this->assertSame('html_container_id', $this->map->getHtmlContainerId());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The html container id of a map must be a string value.
     */
    public function testHtmlContainerWithInvalidValue()
    {
        $this->map->setHtmlContainerId(true);
    }

    public function testAsyncWithValidValue()
    {
        $this->map->setAsync(true);

        $this->assertTrue($this->map->isAsync());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The asynchronous load of a map must be a boolean value.
     */
    public function testAsyncWithInvalidValue()
    {
        $this->map->setAsync('foo');
    }

    public function testAutoZoomWithValidValue()
    {
        $this->map->setAutoZoom(true);

        $this->assertTrue($this->map->isAutoZoom());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The auto zoom of a map must be a boolean value.
     */
    public function testAutoZoomWithInvalidValue()
    {
        $this->map->setAutoZoom('foo');
    }

    public function testCenterWithCoordinate()
    {
        $coordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->map->setCenter($coordinate);

        $this->assertSame($coordinate, $this->map->getCenter());
    }

    public function testCenterWithLatitueAndLongitude()
    {
        $this->map->setCenter(1, 2, false);

        $this->assertEquals(1, $this->map->getCenter()->getLatitude());
        $this->assertEquals(2, $this->map->getCenter()->getLongitude());
        $this->assertFalse($this->map->getCenter()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The center setter arguments is invalid.
     * The available prototypes are :
     * - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     * - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testCenterWithInvalidValue()
    {
        $this->map->setCenter('foo');
    }

    public function testBoundWithBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->map->setBound($bound);

        $this->assertSame($bound, $this->map->getBound());
    }

    public function testBoundWithCoordinates()
    {
        $southWestCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEastCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->map->setBound($southWestCoordinate, $northEastCoordinate);

        $this->assertSame($southWestCoordinate, $this->map->getBound()->getSouthWest());
        $this->assertSame($northEastCoordinate, $this->map->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $this->map->setBound(1, 2, 3, 4, true, false);

        $this->assertSame(1, $this->map->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $this->map->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->map->getBound()->getSouthWest()->isNoWrap());

        $this->assertEquals(3, $this->map->getBound()->getNorthEast()->getLatitude());
        $this->assertEquals(4, $this->map->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->map->getBound()->getNorthEast()->isNoWrap());
    }

    public function testBoundWithNullValue()
    {
        $this->map->setBound(1, 2, 3, 4);
        $this->map->setBound(null);

        $this->assertNull($this->map->getBound()->getSouthWest());
        $this->assertNull($this->map->getBound()->getNorthEast());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The bound setter arguments is invalid.
     * The available prototypes are :
     * - function setBound(Ivory\GoogleMap\Base\Bound $bound)
     * - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     * - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     */
    public function testBoundWithInvalidValue()
    {
        $this->map->setBound('foo');
    }

    public function testHasMapOptionWithValidValue()
    {
        $this->assertTrue($this->map->hasMapOption('zoom'));
        $this->assertFalse($this->map->hasMapOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The map option property of a map must be a string value.
     */
    public function testHasMapOptionWithInvalidValue()
    {
        $this->map->hasMapOption(true);
    }

    public function testSetMapOptionsWithValidValue()
    {
        $this->map->setMapOptions(array('foo' => 'bar'));

        $this->assertSame('bar', $this->map->getMapOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testSetMapOptionWithInvalidValue()
    {
        $this->map->setMapOption(true, false);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testGetMapOptionWithInvalidValue()
    {
        $this->map->getMapOption('foo');
    }

    public function testRemoveMapOptionWithValidValue()
    {
        $this->map->removeMapOption('zoom');

        $this->assertFalse($this->map->hasMapOption('zoom'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The map option "foo" does not exist.
     */
    public function testRemoveMapOptionWithInvalidValue()
    {
        $this->map->removeMapOption('foo');
    }

    public function testHasStylesheetOptionWithValidValue()
    {
        $this->assertTrue($this->map->hasStylesheetOption('width'));
        $this->assertFalse($this->map->hasStylesheetOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The stylesheet option property of a map must be a string value.
     */
    public function testHasStylesheetOptionWithInvalidValue()
    {
        $this->map->hasStylesheetOption(true);
    }

    public function testSetStylesheetOptionsWithValidValue()
    {
        $this->map->setStylesheetOptions(array('foo' => 'bar'));

        $this->assertSame('bar', $this->map->getStylesheetOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testSetStylesheetOptionWithInvalidValue()
    {
        $this->map->setStylesheetOption(true, false);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testGetStylesheetOptionWithInvalidValue()
    {
        $this->map->getStylesheetOption('foo');
    }

    public function testRemoveStylesheetOptionWithValidValue()
    {
        $this->map->removeStylesheetOption('width');

        $this->assertFalse($this->map->hasStylesheetOption('width'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The stylesheet option "foo" does not exist.
     */
    public function testRemoveStylesheetOptionWithInvalidValue()
    {
        $this->map->removeStylesheetOption('foo');
    }

    public function testMapTypeControlWithMapTypeControl()
    {
        $mapTypeControl = $this->getMock('Ivory\GoogleMap\Controls\MapTypeControl');
        $this->map->setMapTypeControl($mapTypeControl);

        $this->assertSame($mapTypeControl, $this->map->getMapTypeControl());
        $this->assertTrue($this->map->getMapOption('mapTypeControl'));
    }

    public function testMapTypeControlWithMapTypeControlParameters()
    {
        $mapTypeIds = array(MapTypeId::TERRAIN);
        $controlPosition = ControlPosition::BOTTOM_CENTER;
        $mapTypeControlStyle = MapTypeControlStyle::HORIZONTAL_BAR;

        $this->map->setMapTypeControl($mapTypeIds, $controlPosition, $mapTypeControlStyle);

        $this->assertSame($mapTypeIds, $this->map->getMapTypeControl()->getMapTypeIds());
        $this->assertSame($controlPosition, $this->map->getMapTypeControl()->getControlPosition());
        $this->assertSame($mapTypeControlStyle, $this->map->getMapTypeControl()->getMapTypeControlStyle());

        $this->assertTrue($this->map->getMapOption('mapTypeControl'));
    }

    public function testMapTypeControlWithNullValue()
    {
        $this->map->setMapTypeControl($this->getMock('Ivory\GoogleMap\Controls\MapTypeControl'));
        $this->map->setMapTypeControl(null);

        $this->assertNull($this->map->getMapTypeControl());
        $this->assertFalse($this->map->hasMapOption('mapTypeControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The map type control setter arguments is invalid.
     * The available prototypes are :
     * - function setMapTypeControl(Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)
     * - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)
     */
    public function testMapTypeControlWithInvalidValue()
    {
        $this->map->setMapTypeControl('foo');
    }

    public function testOverviewMapControlWithOverviewMapControl()
    {
        $overviewMapControl = $this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl');
        $this->map->setOverviewMapControl($overviewMapControl);

        $this->assertSame($overviewMapControl, $this->map->getOverviewMapControl());
        $this->assertTrue($this->map->getMapOption('overviewMapControl'));
    }

    public function testOverviewMapControlWithOverviewMapControlParameters()
    {
        $this->map->setOverviewMapControl(true);

        $this->assertTrue($this->map->getOverviewMapControl()->isOpened());
        $this->assertTrue($this->map->getMapOption('overviewMapControl'));
    }

    public function testOverviewMapControlWithNullValue()
    {
        $this->map->setOverviewMapControl($this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl'));
        $this->map->setOverviewMapControl(null);

        $this->assertNull($this->map->getOverviewMapControl());
        $this->assertFalse($this->map->hasMapOption('overviewMapControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The overview map control setter arguments is invalid.
     * The available prototypes are :
     * - function setOverviewMapControl(Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)
     * - function setOverviewMapControl(boolean $opened)
     */
    public function testOverviewMapControlWithInvalidValue()
    {
        $this->map->setOverviewMapControl('foo');
    }

    public function testPanControlWithPanControl()
    {
        $panControl = $this->getMock('Ivory\GoogleMap\Controls\PanControl');
        $this->map->setPanControl($panControl);

        $this->assertSame($panControl, $this->map->getPanControl());
        $this->assertTrue($this->map->getMapOption('panControl'));
    }

    public function testPanControlWithPanControlParameters()
    {
        $this->map->setPanControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->map->getPanControl()->getControlPosition());
        $this->assertTrue($this->map->getMapOption('panControl'));
    }

    public function testPanControlWithNullValue()
    {
        $this->map->setPanControl($this->getMock('Ivory\GoogleMap\Controls\PanControl'));
        $this->map->setPanControl(null);

        $this->assertNull($this->map->getPanControl());
        $this->assertFalse($this->map->hasMapOption('panControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The pan control setter arguments is invalid.
     * The available prototypes are :
     * - function setPanControl(Ivory\GoogleMap\Controls\PanControl $panControl = null)
     * - function setPanControl(string $controlPosition)
     */
    public function testPanControlWithInvalidValue()
    {
        $this->map->setPanControl(true);
    }

    public function testRotateControlWithRotateControl()
    {
        $rotateControl = $this->getMock('Ivory\GoogleMap\Controls\RotateControl');
        $this->map->setRotateControl($rotateControl);

        $this->assertSame($rotateControl, $this->map->getRotateControl());
        $this->assertTrue($this->map->getMapOption('rotateControl'));
    }

    public function testRotateControlWithRotateControlParameters()
    {
        $this->map->setRotateControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->map->getRotateControl()->getControlPosition());
        $this->assertTrue($this->map->getMapOption('rotateControl'));
    }

    public function testRotateControlWithNullValue()
    {
        $this->map->setRotateControl($this->getMock('Ivory\GoogleMap\Controls\RotateControl'));
        $this->map->setRotateControl(null);

        $this->assertNull($this->map->getRotateControl());
        $this->assertFalse($this->map->hasMapOption('rotateControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The rotate control setter arguments is invalid.
     * The available prototypes are :
     * - function setRotateControl(Ivory\GoogleMap\Controls\RotateControl $rotateControl = null)
     * - function setRotateControl(string $controlPosition)
     */
    public function testRotateControlWithInvalidValue()
    {
        $this->map->setRotateControl(true);
    }

    public function testScaleControlWithScaleControl()
    {
        $scaleControl = $this->getMock('Ivory\GoogleMap\Controls\ScaleControl');
        $this->map->setScaleControl($scaleControl);

        $this->assertSame($scaleControl, $this->map->getScaleControl());
        $this->assertTrue($this->map->getMapOption('scaleControl'));
    }

    public function testScaleControlWithScaleControlParameters()
    {
        $controlPosition = ControlPosition::BOTTOM_CENTER;
        $scaleControlStyle = ScaleControlStyle::DEFAULT_;

        $this->map->setScaleControl($controlPosition, $scaleControlStyle);

        $this->assertSame($controlPosition, $this->map->getScaleControl()->getControlPosition());
        $this->assertSame($scaleControlStyle, $this->map->getScaleControl()->getScaleControlStyle());

        $this->assertTrue($this->map->getMapOption('scaleControl'));
    }

    public function testScaleControlWithNullValue()
    {
        $this->map->setScaleControl($this->getMock('Ivory\GoogleMap\Controls\ScaleControl'));
        $this->map->setScaleControl(null);

        $this->assertNull($this->map->getScaleControl());
        $this->assertFalse($this->map->hasMapOption('scaleControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The scale control setter arguments is invalid.
     * The available prototypes are :
     * - function setScaleControl(Ivory\GoogleMap\Controls\ScaleControl $scaleControl = null)
     * - function setScaleControl(string $controlPosition, string $scaleControlStyle)
     */
    public function testScaleControlWithInvalidValue()
    {
        $this->map->setScaleControl(true);
    }

    public function testStreetViewControlWithStreetViewControl()
    {
        $streetViewControl = $this->getMock('Ivory\GoogleMap\Controls\StreetViewControl');
        $this->map->setStreetViewControl($streetViewControl);

        $this->assertSame($streetViewControl, $this->map->getStreetViewControl());
        $this->assertTrue($this->map->getMapOption('streetViewControl'));
    }

    public function testStreetViewControlWithStreetViewControlParameters()
    {
        $this->map->setStreetViewControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->map->getStreetViewControl()->getControlPosition());
        $this->assertTrue($this->map->getMapOption('streetViewControl'));
    }

    public function testStreetViewControlWithNullValue()
    {
        $this->map->setStreetViewControl($this->getMock('Ivory\GoogleMap\Controls\StreetViewControl'));
        $this->map->setStreetViewControl(null);

        $this->assertNull($this->map->getStreetViewControl());
        $this->assertFalse($this->map->hasMapOption('streetViewControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The street view control setter arguments is invalid.
     * The available prototypes are :
     * - function setStreetViewControl(Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl = null)
     * - function setStreetViewControl(string $controlPosition)
     */
    public function testStreetViewControlWithInvalidValue()
    {
        $this->map->setStreetViewControl(true);
    }

    public function testZoomControlWithZoomControl()
    {
        $zoomControl = $this->getMock('Ivory\GoogleMap\Controls\ZoomControl');
        $this->map->setZoomControl($zoomControl);

        $this->assertSame($zoomControl, $this->map->getZoomControl());
        $this->assertTrue($this->map->getMapOption('zoomControl'));
    }

    public function testZoomControlWithZoomControlParameters()
    {
        $controlPosition = ControlPosition::BOTTOM_CENTER;
        $zoomControlStyle = ZoomControlStyle::LARGE;

        $this->map->setZoomControl($controlPosition, $zoomControlStyle);

        $this->assertSame($controlPosition, $this->map->getZoomControl()->getControlPosition());
        $this->assertSame($zoomControlStyle, $this->map->getZoomControl()->getZoomControlStyle());
        $this->assertTrue($this->map->getMapOption('zoomControl'));
    }

    public function testZoomControlWithNullValue()
    {
        $this->map->setZoomControl($this->getMock('Ivory\GoogleMap\Controls\ZoomControl'));
        $this->map->setZoomControl(null);

        $this->assertNull($this->map->getZoomControl());
        $this->assertFalse($this->map->hasMapOption('zoomControl'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The zoom control setter arguments is invalid.
     * The available prototypes are :
     * - function setZoomControl(Ivory\GoogleMap\Controls\ZoomControl $zoomControl = null)
     * - function setZoomControl(string $controlPosition, string $zoomControlStyle)
     */
    public function testZoomControlWithInvalidValue()
    {
        $this->map->setZoomControl(true);
    }

    public function testEventManager()
    {
        $eventManager = $this->getMock('Ivory\GoogleMap\Events\EventManager');
        $this->map->setEventManager($eventManager);

        $this->assertSame($eventManager, $this->map->getEventManager());
    }

    public function testMarkerWithAutoZoom()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($marker));

        $this->map->addMarker($marker);

        $this->assertSame(array($marker), $this->map->getMarkers());
    }

    public function testMarkerWithoutAutoZoom()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addMarker($marker);

        $this->assertSame(array($marker), $this->map->getMarkers());
    }

    public function testInfoWindowWithAutoZoom()
    {
        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($infoWindow));

        $this->map->addInfoWindow($infoWindow);

        $this->assertSame(array($infoWindow), $this->map->getInfoWindows());
    }

    public function testInfoWindowWithoutAutoZoom()
    {
        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addInfoWindow($infoWindow);

        $this->assertSame(array($infoWindow), $this->map->getInfoWindows());
    }

    public function testPolylineWithAutoZoom()
    {
        $polyline = $this->getMock('Ivory\GoogleMap\Overlays\Polyline');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($polyline));

        $this->map->addPolyline($polyline);

        $this->assertSame(array($polyline), $this->map->getPolylines());
    }

    public function testPolylineWithoutAutoZoom()
    {
        $polyline = $this->getMock('Ivory\GoogleMap\Overlays\Polyline');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addPolyline($polyline);

        $this->assertSame(array($polyline), $this->map->getPolylines());
    }

    public function testEncodedPolylineWithAutoZoom()
    {
        $encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($encodedPolyline));

        $this->map->addEncodedPolyline($encodedPolyline);

        $this->assertSame(array($encodedPolyline), $this->map->getEncodedPolylines());
    }

    public function testEncodedPolylineWithoutAutoZoom()
    {
        $encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addEncodedPolyline($encodedPolyline);

        $this->assertSame(array($encodedPolyline), $this->map->getEncodedPolylines());
    }

    public function testPolygonWithAutoZoom()
    {
        $polygon = $this->getMock('Ivory\GoogleMap\Overlays\Polygon');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($polygon));

        $this->map->addPolygon($polygon);

        $this->assertSame(array($polygon), $this->map->getPolygons());
    }

    public function testPolygonWithoutAutoZoom()
    {
        $polygon = $this->getMock('Ivory\GoogleMap\Overlays\Polygon');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addPolygon($polygon);

        $this->assertSame(array($polygon), $this->map->getPolygons());
    }

    public function testRectangleWithAutoZoom()
    {
        $rectangle = $this->getMock('Ivory\GoogleMap\Overlays\Rectangle');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($rectangle));

        $this->map->addRectangle($rectangle);

        $this->assertSame(array($rectangle), $this->map->getRectangles());
    }

    public function testRectangleWithoutAutoZoom()
    {
        $rectangle = $this->getMock('Ivory\GoogleMap\Overlays\Rectangle');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addRectangle($rectangle);

        $this->assertSame(array($rectangle), $this->map->getRectangles());
    }

    public function testCircleWithAutoZoom()
    {
        $circle = $this->getMock('Ivory\GoogleMap\Overlays\Circle');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($circle));

        $this->map->addCircle($circle);

        $this->assertSame(array($circle), $this->map->getCircles());
    }

    public function testCircleWithoutAutoZoom()
    {
        $circle = $this->getMock('Ivory\GoogleMap\Overlays\Circle');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addCircle($circle);

        $this->assertSame(array($circle), $this->map->getCircles());
    }

    public function testGroundOverlayWithAutoZoom()
    {
        $groundOverlay = $this->getMock('Ivory\GoogleMap\Overlays\GroundOverlay');
        $this->map->setAutoZoom(true);

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($groundOverlay));

        $this->map->addGroundOverlay($groundOverlay);

        $this->assertSame(array($groundOverlay), $this->map->getGroundOverlays());
    }

    public function testGroundOverlayWithoutAutoZoom()
    {
        $groundOverlay = $this->getMock('Ivory\GoogleMap\Overlays\GroundOverlay');

        $this->setUpBound();
        $this->map->getBound()
            ->expects($this->never())
            ->method('extend');

        $this->map->addGroundOverlay($groundOverlay);

        $this->assertSame(array($groundOverlay), $this->map->getGroundOverlays());
    }

    public function testKmlLayer()
    {
        $kmlLayer = $this->getMock('Ivory\GoogleMap\Layers\KMLLayer');
        $this->map->addKMLLayer($kmlLayer);

        $this->assertSame(array($kmlLayer), $this->map->getKMLLayers());
    }

    public function testLibraries()
    {
        $this->map->setLibraries(array('foo'));

        $this->assertTrue($this->map->hasLibraries());
        $this->assertSame(array('foo'), $this->map->getLibraries());
    }

    public function testLanguage()
    {
        $this->map->setLanguage('fr');

        $this->assertSame('fr', $this->map->getLanguage());
    }
}
