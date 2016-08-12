<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlayManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OverlayManager
     */
    private $overlayManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private $map;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = $this->createBoundMock();
        $this->map = $this->createMapMock($this->bound);

        $this->overlayManager = new OverlayManager();
        $this->overlayManager->setMap($this->map);
    }

    public function testDefaultState()
    {
        $this->overlayManager = new OverlayManager();

        $this->assertFalse($this->overlayManager->hasMap());
        $this->assertNull($this->overlayManager->getMap());
        $this->assertInstanceOf(MarkerCluster::class, $this->overlayManager->getMarkerCluster());
        $this->assertFalse($this->overlayManager->hasMarkers());
        $this->assertEmpty($this->overlayManager->getMarkers());
    }

    public function testMap()
    {
        $map = $this->createMapMock();
        $map
            ->expects($this->once())
            ->method('getOverlayManager')
            ->will($this->returnValue(null));

        $map
            ->expects($this->once())
            ->method('setOverlayManager')
            ->with($this->identicalTo($this->overlayManager));

        $this->overlayManager->setMap($map);

        $this->assertTrue($this->overlayManager->hasMap());
        $this->assertSame($map, $this->overlayManager->getMap());
    }

    public function testMarkerCluster()
    {
        $this->overlayManager->setMarkerCluster($markerCluster = $this->createMarkerClusterMock());

        $this->assertSame($markerCluster, $this->overlayManager->getMarkerCluster());
    }

    public function testHasMarkers()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('hasMarkers')
            ->will($this->returnValue(true));

        $this->overlayManager->setMarkerCluster($markerCluster);

        $this->assertTrue($this->overlayManager->hasMarkers());
    }

    public function testGetMarkers()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('getMarkers')
            ->will($this->returnValue($markers = [$this->createMarkerMock()]));

        $this->overlayManager->setMarkerCluster($markerCluster);

        $this->assertSame($markers, $this->overlayManager->getMarkers());
    }

    public function testSetMarkers()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('setMarkers')
            ->with($this->identicalTo($markers = [$this->createMarkerMock()]));

        $this->overlayManager->setMarkerCluster($markerCluster);
        $this->overlayManager->setMarkers($markers);
    }

    public function testAddMarkers()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('addMarkers')
            ->with($this->identicalTo($markers = [$this->createMarkerMock()]));

        $this->overlayManager->setMarkerCluster($markerCluster);
        $this->overlayManager->addMarkers($markers);
    }

    public function testHasMarker()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('hasMarker')
            ->with($this->identicalTo($marker = $this->createMarkerMock()))
            ->will($this->returnValue(true));

        $this->overlayManager->setMarkerCluster($markerCluster);

        $this->assertTrue($this->overlayManager->hasMarker($marker));
    }

    public function testAddMarker()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('addMarker')
            ->with($this->identicalTo($marker = $this->createMarkerMock()));

        $this->overlayManager->setMarkerCluster($markerCluster);
        $this->overlayManager->addMarker($marker);
    }

    public function testRemoveMarker()
    {
        $markerCluster = $this->createMarkerClusterMock();
        $markerCluster
            ->expects($this->once())
            ->method('removeMarker')
            ->with($this->identicalTo($marker = $this->createMarkerMock()));

        $this->overlayManager->setMarkerCluster($markerCluster);
        $this->overlayManager->removeMarker($marker);
    }

    public function testSetInfoWindows()
    {
        $this->overlayManager->setInfoWindows($infoWindows = [$infoWindow = $this->createInfoWindowMock()]);
        $this->overlayManager->setInfoWindows($infoWindows);

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertTrue($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertSame($infoWindows, $this->overlayManager->getInfoWindows());
    }

    public function testSetInfoWindowsWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($infoWindow = $this->createInfoWindowMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($infoWindow));

        $this->overlayManager->setInfoWindows($infoWindows = [$infoWindow]);
        $this->overlayManager->setInfoWindows($infoWindows);

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertTrue($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertSame($infoWindows, $this->overlayManager->getInfoWindows());
    }

    public function testAddInfoWindows()
    {
        $this->overlayManager->setInfoWindows($firstInfoWindows = [$this->createInfoWindowMock()]);
        $this->overlayManager->addInfoWindows($secondInfoWindows = [$this->createInfoWindowMock()]);

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertSame(array_merge($firstInfoWindows, $secondInfoWindows), $this->overlayManager->getInfoWindows());
    }

    public function testAddInfoWindowsWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstInfoWindow = $this->createInfoWindowMock()],
                [$secondInfoWindow = $this->createInfoWindowMock()]
            );

        $this->overlayManager->setInfoWindows($firstInfoWindows = [$firstInfoWindow]);
        $this->overlayManager->addInfoWindows($secondInfoWindows = [$secondInfoWindow]);

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertSame(array_merge($firstInfoWindows, $secondInfoWindows), $this->overlayManager->getInfoWindows());
    }

    public function testAddInfoWindow()
    {
        $this->overlayManager->addInfoWindow($infoWindow = $this->createInfoWindowMock());

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertTrue($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertSame([$infoWindow], $this->overlayManager->getInfoWindows());
    }

    public function testAddInfoWindowWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($infoWindow = $this->createInfoWindowMock()));

        $this->overlayManager->addInfoWindow($infoWindow);

        $this->assertTrue($this->overlayManager->hasInfoWindows());
        $this->assertTrue($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertSame([$infoWindow], $this->overlayManager->getInfoWindows());
    }

    public function testRemoveInfoWindow()
    {
        $this->overlayManager->addInfoWindow($infoWindow = $this->createInfoWindowMock());
        $this->overlayManager->removeInfoWindow($infoWindow);

        $this->assertFalse($this->overlayManager->hasInfoWindows());
        $this->assertFalse($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertEmpty($this->overlayManager->getInfoWindows());
    }

    public function testRemoveInfoWindowWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($infoWindow = $this->createInfoWindowMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($infoWindow));

        $this->overlayManager->addInfoWindow($infoWindow);
        $this->overlayManager->removeInfoWindow($infoWindow);

        $this->assertFalse($this->overlayManager->hasInfoWindows());
        $this->assertFalse($this->overlayManager->hasInfoWindow($infoWindow));
        $this->assertEmpty($this->overlayManager->getInfoWindows());
    }

    public function testSetPolylines()
    {
        $this->overlayManager->setPolylines($polylines = [$polyline = $this->createPolylineMock()]);
        $this->overlayManager->setPolylines($polylines);

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertTrue($this->overlayManager->hasPolyline($polyline));
        $this->assertSame($polylines, $this->overlayManager->getPolylines());
    }

    public function testSetPolylinesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($polyline = $this->createPolylineMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($polyline));

        $this->overlayManager->setPolylines($polylines = [$polyline]);
        $this->overlayManager->setPolylines($polylines);

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertTrue($this->overlayManager->hasPolyline($polyline));
        $this->assertSame($polylines, $this->overlayManager->getPolylines());
    }

    public function testAddPolylines()
    {
        $this->overlayManager->setPolylines($firstPolylines = [$this->createPolylineMock()]);
        $this->overlayManager->addPolylines($secondPolylines = [$this->createPolylineMock()]);

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertSame(array_merge($firstPolylines, $secondPolylines), $this->overlayManager->getPolylines());
    }

    public function testAddPolylinesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstPolyline = $this->createPolylineMock()],
                [$secondPolyline = $this->createPolylineMock()]
            );

        $this->overlayManager->setPolylines($firstPolylines = [$firstPolyline]);
        $this->overlayManager->addPolylines($secondPolylines = [$secondPolyline]);

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertSame(array_merge($firstPolylines, $secondPolylines), $this->overlayManager->getPolylines());
    }

    public function testAddPolyline()
    {
        $this->overlayManager->addPolyline($polyline = $this->createPolylineMock());

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertTrue($this->overlayManager->hasPolyline($polyline));
        $this->assertSame([$polyline], $this->overlayManager->getPolylines());
    }

    public function testAddPolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($polyline = $this->createPolylineMock()));

        $this->overlayManager->addPolyline($polyline);

        $this->assertTrue($this->overlayManager->hasPolylines());
        $this->assertTrue($this->overlayManager->hasPolyline($polyline));
        $this->assertSame([$polyline], $this->overlayManager->getPolylines());
    }

    public function testRemovePolyline()
    {
        $this->overlayManager->addPolyline($polyline = $this->createPolylineMock());
        $this->overlayManager->removePolyline($polyline);

        $this->assertFalse($this->overlayManager->hasPolylines());
        $this->assertFalse($this->overlayManager->hasPolyline($polyline));
        $this->assertEmpty($this->overlayManager->getPolylines());
    }

    public function testRemovePolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($polyline = $this->createPolylineMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($polyline));

        $this->overlayManager->addPolyline($polyline);
        $this->overlayManager->removePolyline($polyline);

        $this->assertFalse($this->overlayManager->hasPolylines());
        $this->assertFalse($this->overlayManager->hasPolyline($polyline));
        $this->assertEmpty($this->overlayManager->getPolylines());
    }

    public function testSetEncodedPolylines()
    {
        $encodedPolylines = [$encodedPolyline = $this->createEncodedPolylineMock()];

        $this->overlayManager->setEncodedPolylines($encodedPolylines);
        $this->overlayManager->setEncodedPolylines($encodedPolylines);

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertTrue($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertSame($encodedPolylines, $this->overlayManager->getEncodedPolylines());
    }

    public function testSetEncodedPolylinesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($encodedPolyline = $this->createEncodedPolylineMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($encodedPolyline));

        $this->overlayManager->setEncodedPolylines($encodedPolylines = [$encodedPolyline]);
        $this->overlayManager->setEncodedPolylines($encodedPolylines);

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertTrue($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertSame($encodedPolylines, $this->overlayManager->getEncodedPolylines());
    }

    public function testAddEncodedPolylines()
    {
        $this->overlayManager->setEncodedPolylines($firstEncodedPolylines = [$this->createEncodedPolylineMock()]);
        $this->overlayManager->addEncodedPolylines($secondEncodedPolylines = [$this->createEncodedPolylineMock()]);

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertSame(
            array_merge($firstEncodedPolylines, $secondEncodedPolylines),
            $this->overlayManager->getEncodedPolylines()
        );
    }

    public function testAddEncodedPolylinesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstEncodedPolyline = $this->createEncodedPolylineMock()],
                [$secondEncodedPolyline = $this->createEncodedPolylineMock()]
            );

        $this->overlayManager->setEncodedPolylines($firstEncodedPolylines = [$firstEncodedPolyline]);
        $this->overlayManager->addEncodedPolylines($secondEncodedPolylines = [$secondEncodedPolyline]);

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertSame(
            array_merge($firstEncodedPolylines, $secondEncodedPolylines),
            $this->overlayManager->getEncodedPolylines()
        );
    }

    public function testAddEncodedPolyline()
    {
        $this->overlayManager->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertTrue($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertSame([$encodedPolyline], $this->overlayManager->getEncodedPolylines());
    }

    public function testAddEncodedPolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($encodedPolyline = $this->createEncodedPolylineMock()));

        $this->overlayManager->addEncodedPolyline($encodedPolyline);

        $this->assertTrue($this->overlayManager->hasEncodedPolylines());
        $this->assertTrue($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertSame([$encodedPolyline], $this->overlayManager->getEncodedPolylines());
    }

    public function testRemoveEncodedPolyline()
    {
        $this->overlayManager->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());
        $this->overlayManager->removeEncodedPolyline($encodedPolyline);

        $this->assertFalse($this->overlayManager->hasEncodedPolylines());
        $this->assertFalse($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertEmpty($this->overlayManager->getEncodedPolylines());
    }

    public function testRemoveEncodedPolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($encodedPolyline = $this->createEncodedPolylineMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($encodedPolyline));

        $this->overlayManager->addEncodedPolyline($encodedPolyline);
        $this->overlayManager->removeEncodedPolyline($encodedPolyline);

        $this->assertFalse($this->overlayManager->hasEncodedPolylines());
        $this->assertFalse($this->overlayManager->hasEncodedPolyline($encodedPolyline));
        $this->assertEmpty($this->overlayManager->getEncodedPolylines());
    }

    public function testSetPolygons()
    {
        $this->overlayManager->setPolygons($polygons = [$polygon = $this->createPolygonMock()]);
        $this->overlayManager->setPolygons($polygons);

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertTrue($this->overlayManager->hasPolygon($polygon));
        $this->assertSame($polygons, $this->overlayManager->getPolygons());
    }

    public function testSetPolygonsWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($polygon = $this->createPolygonMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($polygon));

        $this->overlayManager->setPolygons($polygons = [$polygon]);
        $this->overlayManager->setPolygons($polygons);

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertTrue($this->overlayManager->hasPolygon($polygon));
        $this->assertSame($polygons, $this->overlayManager->getPolygons());
    }

    public function testAddPolygons()
    {
        $this->overlayManager->setPolygons($firstPolygons = [$this->createPolygonMock()]);
        $this->overlayManager->addPolygons($secondPolygons = [$this->createPolygonMock()]);

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertSame(array_merge($firstPolygons, $secondPolygons), $this->overlayManager->getPolygons());
    }

    public function testAddPolygonsWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstPolygon = $this->createPolygonMock()],
                [$secondPolygon = $this->createPolygonMock()]
            );

        $this->overlayManager->setPolygons($firstPolygons = [$firstPolygon]);
        $this->overlayManager->addPolygons($secondPolygons = [$secondPolygon]);

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertSame(array_merge($firstPolygons, $secondPolygons), $this->overlayManager->getPolygons());
    }

    public function testAddPolygon()
    {
        $this->overlayManager->addPolygon($polygon = $this->createPolygonMock());

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertTrue($this->overlayManager->hasPolygon($polygon));
        $this->assertSame([$polygon], $this->overlayManager->getPolygons());
    }

    public function testAddPolygonWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($polygon = $this->createPolygonMock()));

        $this->overlayManager->addPolygon($polygon);

        $this->assertTrue($this->overlayManager->hasPolygons());
        $this->assertTrue($this->overlayManager->hasPolygon($polygon));
        $this->assertSame([$polygon], $this->overlayManager->getPolygons());
    }

    public function testRemovePolygon()
    {
        $this->overlayManager->addPolygon($polygon = $this->createPolygonMock());
        $this->overlayManager->removePolygon($polygon);

        $this->assertFalse($this->overlayManager->hasPolygons());
        $this->assertFalse($this->overlayManager->hasPolygon($polygon));
        $this->assertEmpty($this->overlayManager->getPolygons());
    }

    public function testRemovePolygonWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($polygon = $this->createPolygonMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($polygon));

        $this->overlayManager->addPolygon($polygon);
        $this->overlayManager->removePolygon($polygon);

        $this->assertFalse($this->overlayManager->hasPolygons());
        $this->assertFalse($this->overlayManager->hasPolygon($polygon));
        $this->assertEmpty($this->overlayManager->getPolygons());
    }

    public function testSetRectangles()
    {
        $this->overlayManager->setRectangles($rectangles = [$rectangle = $this->createRectangleMock()]);
        $this->overlayManager->setRectangles($rectangles);

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertTrue($this->overlayManager->hasRectangle($rectangle));
        $this->assertSame($rectangles, $this->overlayManager->getRectangles());
    }

    public function testSetRectanglesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($rectangle = $this->createRectangleMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($rectangle));

        $this->overlayManager->setRectangles($rectangles = [$rectangle]);
        $this->overlayManager->setRectangles($rectangles);

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertTrue($this->overlayManager->hasRectangle($rectangle));
        $this->assertSame($rectangles, $this->overlayManager->getRectangles());
    }

    public function testAddRectangles()
    {
        $this->overlayManager->setRectangles($firstRectangles = [$this->createRectangleMock()]);
        $this->overlayManager->addRectangles($secondRectangles = [$this->createRectangleMock()]);

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertSame(array_merge($firstRectangles, $secondRectangles), $this->overlayManager->getRectangles());
    }

    public function testAddRectanglesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstRectangle = $this->createRectangleMock()],
                [$secondRectangle = $this->createRectangleMock()]
            );

        $this->overlayManager->setRectangles($firstRectangles = [$firstRectangle]);
        $this->overlayManager->addRectangles($secondRectangles = [$secondRectangle]);

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertSame(array_merge($firstRectangles, $secondRectangles), $this->overlayManager->getRectangles());
    }

    public function testAddRectangle()
    {
        $this->overlayManager->addRectangle($rectangle = $this->createRectangleMock());

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertTrue($this->overlayManager->hasRectangle($rectangle));
        $this->assertSame([$rectangle], $this->overlayManager->getRectangles());
    }

    public function testAddRectangleWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($rectangle = $this->createRectangleMock()));

        $this->overlayManager->addRectangle($rectangle);

        $this->assertTrue($this->overlayManager->hasRectangles());
        $this->assertTrue($this->overlayManager->hasRectangle($rectangle));
        $this->assertSame([$rectangle], $this->overlayManager->getRectangles());
    }

    public function testRemoveRectangle()
    {
        $this->overlayManager->addRectangle($rectangle = $this->createRectangleMock());
        $this->overlayManager->removeRectangle($rectangle);

        $this->assertFalse($this->overlayManager->hasRectangles());
        $this->assertFalse($this->overlayManager->hasRectangle($rectangle));
        $this->assertEmpty($this->overlayManager->getRectangles());
    }

    public function testRemoveRectangleWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($rectangle = $this->createRectangleMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($rectangle));

        $this->overlayManager->addRectangle($rectangle);
        $this->overlayManager->removeRectangle($rectangle);

        $this->assertFalse($this->overlayManager->hasRectangles());
        $this->assertFalse($this->overlayManager->hasRectangle($rectangle));
        $this->assertEmpty($this->overlayManager->getRectangles());
    }

    public function testSetCircles()
    {
        $this->overlayManager->setCircles($circles = [$circle = $this->createCircleMock()]);
        $this->overlayManager->setCircles($circles);

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertTrue($this->overlayManager->hasCircle($circle));
        $this->assertSame($circles, $this->overlayManager->getCircles());
    }

    public function testSetCirclesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($circle = $this->createCircleMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($circle));

        $this->overlayManager->setCircles($circles = [$circle]);
        $this->overlayManager->setCircles($circles);

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertTrue($this->overlayManager->hasCircle($circle));
        $this->assertSame($circles, $this->overlayManager->getCircles());
    }

    public function testAddCircles()
    {
        $this->overlayManager->setCircles($firstCircles = [$this->createCircleMock()]);
        $this->overlayManager->addCircles($secondCircles = [$this->createCircleMock()]);

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertSame(array_merge($firstCircles, $secondCircles), $this->overlayManager->getCircles());
    }

    public function testAddCirclesWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstCircle = $this->createCircleMock()],
                [$secondCircle = $this->createCircleMock()]
            );

        $this->overlayManager->setCircles($firstCircles = [$firstCircle]);
        $this->overlayManager->addCircles($secondCircles = [$secondCircle]);

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertSame(array_merge($firstCircles, $secondCircles), $this->overlayManager->getCircles());
    }

    public function testAddCircle()
    {
        $this->overlayManager->addCircle($circle = $this->createCircleMock());

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertTrue($this->overlayManager->hasCircle($circle));
        $this->assertSame([$circle], $this->overlayManager->getCircles());
    }

    public function testAddCircleWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($circle = $this->createCircleMock()));

        $this->overlayManager->addCircle($circle);

        $this->assertTrue($this->overlayManager->hasCircles());
        $this->assertTrue($this->overlayManager->hasCircle($circle));
        $this->assertSame([$circle], $this->overlayManager->getCircles());
    }

    public function testRemoveCircle()
    {
        $this->overlayManager->addCircle($circle = $this->createCircleMock());
        $this->overlayManager->removeCircle($circle);

        $this->assertFalse($this->overlayManager->hasCircles());
        $this->assertFalse($this->overlayManager->hasCircle($circle));
        $this->assertEmpty($this->overlayManager->getCircles());
    }

    public function testRemoveCircleWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($circle = $this->createCircleMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($circle));

        $this->overlayManager->addCircle($circle);
        $this->overlayManager->removeCircle($circle);

        $this->assertFalse($this->overlayManager->hasCircles());
        $this->assertFalse($this->overlayManager->hasCircle($circle));
        $this->assertEmpty($this->overlayManager->getCircles());
    }

    public function testSetGroundOverlays()
    {
        $this->overlayManager->setGroundOverlays($groundOverlays = [$groundOverlay = $this->createGroundOverlayMock()]);
        $this->overlayManager->setGroundOverlays($groundOverlays);

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertTrue($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertSame($groundOverlays, $this->overlayManager->getGroundOverlays());
    }

    public function testSetGroundOverlaysWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(3))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->with($this->identicalTo($groundOverlay = $this->createGroundOverlayMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($groundOverlay));

        $this->overlayManager->setGroundOverlays($groundOverlays = [$groundOverlay]);
        $this->overlayManager->setGroundOverlays($groundOverlays);

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertTrue($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertSame($groundOverlays, $this->overlayManager->getGroundOverlays());
    }

    public function testAddGroundOverlays()
    {
        $this->overlayManager->setGroundOverlays($firstGroundOverlays = [$this->createGroundOverlayMock()]);
        $this->overlayManager->addGroundOverlays($secondGroundOverlays = [$this->createGroundOverlayMock()]);

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertSame(
            array_merge($firstGroundOverlays, $secondGroundOverlays),
            $this->overlayManager->getGroundOverlays()
        );
    }

    public function testAddGroundOverlaysWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->exactly(2))
            ->method('addExtendable')
            ->withConsecutive(
                [$firstGroundOverlay = $this->createGroundOverlayMock()],
                [$secondGroundOverlay = $this->createGroundOverlayMock()]
            );

        $this->overlayManager->setGroundOverlays($firstGroundOverlays = [$firstGroundOverlay]);
        $this->overlayManager->addGroundOverlays($secondGroundOverlays = [$secondGroundOverlay]);

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertSame(
            array_merge($firstGroundOverlays, $secondGroundOverlays),
            $this->overlayManager->getGroundOverlays()
        );
    }

    public function testAddGroundOverlay()
    {
        $this->overlayManager->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertTrue($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertSame([$groundOverlay], $this->overlayManager->getGroundOverlays());
    }

    public function testAddGroundOverlayWithAutoZoom()
    {
        $this->map
            ->expects($this->once())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($groundOverlay = $this->createGroundOverlayMock()));

        $this->overlayManager->addGroundOverlay($groundOverlay);

        $this->assertTrue($this->overlayManager->hasGroundOverlays());
        $this->assertTrue($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertSame([$groundOverlay], $this->overlayManager->getGroundOverlays());
    }

    public function testRemoveGroundOverlay()
    {
        $this->overlayManager->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());
        $this->overlayManager->removeGroundOverlay($groundOverlay);

        $this->assertFalse($this->overlayManager->hasGroundOverlays());
        $this->assertFalse($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertEmpty($this->overlayManager->getGroundOverlays());
    }

    public function testRemoveGroundOverlayWithAutoZoom()
    {
        $this->map
            ->expects($this->exactly(2))
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $this->bound
            ->expects($this->once())
            ->method('addExtendable')
            ->with($this->identicalTo($groundOverlay = $this->createGroundOverlayMock()));

        $this->bound
            ->expects($this->once())
            ->method('removeExtendable')
            ->with($this->identicalTo($groundOverlay));

        $this->overlayManager->addGroundOverlay($groundOverlay);
        $this->overlayManager->removeGroundOverlay($groundOverlay);

        $this->assertFalse($this->overlayManager->hasGroundOverlays());
        $this->assertFalse($this->overlayManager->hasGroundOverlay($groundOverlay));
        $this->assertEmpty($this->overlayManager->getGroundOverlays());
    }

    /**
     * @param Bound|null $bound
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock(Bound $bound = null)
    {
        $map = $this->createMock(Map::class);
        $map
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound ?: $this->createBoundMock()));

        return $map;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCluster
     */
    private function createMarkerClusterMock()
    {
        return $this->createMock(MarkerCluster::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Marker
     */
    private function createMarkerMock()
    {
        return $this->createMock(Marker::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|InfoWindow
     */
    private function createInfoWindowMock()
    {
        return $this->createMock(InfoWindow::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Polyline
     */
    private function createPolylineMock()
    {
        return $this->createMock(Polyline::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EncodedPolyline
     */
    private function createEncodedPolylineMock()
    {
        return $this->createMock(EncodedPolyline::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Polygon
     */
    private function createPolygonMock()
    {
        return $this->createMock(Polygon::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Rectangle
     */
    private function createRectangleMock()
    {
        return $this->createMock(Rectangle::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Circle
     */
    private function createCircleMock()
    {
        return $this->createMock(Circle::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GroundOverlay
     */
    private function createGroundOverlayMock()
    {
        return $this->createMock(GroundOverlay::class);
    }
}
