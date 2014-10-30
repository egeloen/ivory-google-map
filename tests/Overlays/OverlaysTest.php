<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Overlays;

/**
 * Overlays test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlaysTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Overlays */
    private $overlays;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overlays = new Overlays();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overlays);
    }

    public function testDefaultState()
    {
        $this->assertMarkerClusterInstance($this->overlays->getMarkerCluster());
        $this->assertNoCircles();
        $this->assertNoEncodedPolylines();
        $this->assertNoGroundOverlays();
        $this->assertNoInfoWindows();
        $this->assertNoPolygons();
        $this->assertNoPolylines();
        $this->assertNoRectangles();
        $this->assertNoExtendables();
        $this->assertFalse($this->overlays->isAutoZoom());
    }

    public function testSetMarkerClusterWithoutAutoZoom()
    {
        $this->overlays->setMarkerCluster($this->createMarkerClusterMock($markers = array($this->createMarkerMock())));

        $this->assertMarkers($markers);
        $this->assertNoExtendables();
    }

    public function testSetMarkerClusterWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setMarkerCluster($this->createMarkerClusterMock($markers = array($this->createMarkerMock())));

        $this->assertMarkers($markers);
        $this->assertExtendables($markers);
    }

    public function testSetMarkersWithoutAutoZoom()
    {
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));

        $this->assertMarkers($markers);
        $this->assertNoExtendables();
    }

    public function testSetMarkersWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));

        $this->assertMarkers($markers);
        $this->assertExtendables($markers);
    }

    public function testAddMarkersWithoutAutoZoom()
    {
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));
        $this->overlays->addMarkers($newMarkers = array($this->createMarkerMock()));

        $this->assertMarkers(array_merge($markers, $newMarkers));
        $this->assertNoExtendables();
    }

    public function testAddMarkersWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));
        $this->overlays->addMarkers($newMarkers = array($this->createMarkerMock()));

        $this->assertMarkers($expected = array_merge($markers, $newMarkers));
        $this->assertExtendables($expected);
    }

    public function testRemoveMarkersWithoutAutoZoom()
    {
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));
        $this->overlays->removeMarkers($markers);

        $this->assertNoMarkers();
        $this->assertNoExtendables();
    }

    public function testRemoveMarkersWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setMarkers($markers = array($this->createMarkerMock()));
        $this->overlays->removeMarkers($markers);

        $this->assertNoMarkers();
        $this->assertNoExtendables();
    }

    public function testResetMarkersWithoutAutoZoom()
    {
        $this->overlays->setMarkers(array($this->createMarkerMock()));
        $this->overlays->resetMarkers();

        $this->assertNoMarkers();
        $this->assertNoExtendables();
    }

    public function testResetMarkersWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setMarkers(array($this->createMarkerMock()));
        $this->overlays->resetMarkers();

        $this->assertNoMarkers();
        $this->assertNoExtendables();
    }

    public function testAddMarkerWithoutAutoZoom()
    {
        $this->overlays->addMarker($marker = $this->createMarkerMock());

        $this->assertMarker($marker);
        $this->assertNoExtendable($marker);
    }

    public function testAddMarkerWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addMarker($marker = $this->createMarkerMock());

        $this->assertMarker($marker);
        $this->assertExtendable($marker);
    }

    public function testAddMarkerUnicity()
    {
        $this->overlays->resetMarkers();
        $this->overlays->addMarker($marker = $this->createMarkerMock());
        $this->overlays->addMarker($marker);

        $this->assertMarkers(array($marker));
    }

    public function testRemoveMarkerWithoutAutoZoom()
    {
        $this->overlays->addMarker($marker = $this->createMarkerMock());
        $this->overlays->removeMarker($marker);

        $this->assertNoMarker($marker);
        $this->assertNoExtendable($marker);
    }

    public function testRemoveMarkerWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addMarker($marker = $this->createMarkerMock());
        $this->overlays->removeMarker($marker);

        $this->assertNoMarker($marker);
        $this->assertNoExtendable($marker);
    }

    public function testSetCirclesWithoutAutoZoom()
    {
        $this->overlays->setCircles($circles = array($this->createCircleMock()));

        $this->assertCircles($circles);
        $this->assertNoExtendables();
    }

    public function testSetCirclesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setCircles($circles = array($this->createCircleMock()));

        $this->assertCircles($circles);
        $this->assertExtendables($circles);
    }

    public function testAddCirclesWithoutAutoZoom()
    {
        $this->overlays->setCircles($circles = array($this->createCircleMock()));
        $this->overlays->addCircles($newCircles = array($this->createCircleMock()));

        $this->assertCircles(array_merge($circles, $newCircles));
        $this->assertNoExtendables();
    }

    public function testAddCirclesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setCircles($circles = array($this->createCircleMock()));
        $this->overlays->addCircles($newCircles = array($this->createCircleMock()));

        $this->assertCircles($expected = array_merge($circles, $newCircles));
        $this->assertExtendables($expected);
    }

    public function testRemoveCirclesWithoutAutoZoom()
    {
        $this->overlays->setCircles($circles = array($this->createCircleMock()));
        $this->overlays->removeCircles($circles);

        $this->assertNoCircles();
        $this->assertNoExtendables();
    }

    public function testRemoveCirclesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setCircles($circles = array($this->createCircleMock()));
        $this->overlays->removeCircles($circles);

        $this->assertNoCircles();
        $this->assertNoExtendables();
    }

    public function testResetCirclesWithoutAutoZoom()
    {
        $this->overlays->setCircles(array($this->createCircleMock()));
        $this->overlays->resetCircles();

        $this->assertNoCircles();
        $this->assertNoExtendables();
    }

    public function testResetCirclesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setCircles(array($this->createCircleMock()));
        $this->overlays->resetCircles();

        $this->assertNoCircles();
        $this->assertNoExtendables();
    }

    public function testAddCircleWithoutAutoZoom()
    {
        $this->overlays->addCircle($circle = $this->createCircleMock());

        $this->assertCircle($circle);
        $this->assertNoExtendable($circle);
    }

    public function testAddCircleWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addCircle($circle = $this->createCircleMock());

        $this->assertCircle($circle);
        $this->assertExtendable($circle);
    }

    public function testAddCircleUnicity()
    {
        $this->overlays->resetCircles();
        $this->overlays->addCircle($circle = $this->createCircleMock());
        $this->overlays->addCircle($circle);

        $this->assertCircles(array($circle));
    }

    public function testRemoveCircleWithoutAutoZoom()
    {
        $this->overlays->addCircle($circle = $this->createCircleMock());
        $this->overlays->removeCircle($circle);

        $this->assertNoCircle($circle);
        $this->assertNoExtendable($circle);
    }

    public function testRemoveCircleWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addCircle($circle = $this->createCircleMock());
        $this->overlays->removeCircle($circle);

        $this->assertNoCircle($circle);
        $this->assertNoExtendable($circle);
    }

    public function testSetEncodedPolylinesWithoutAutoZoom()
    {
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));

        $this->assertEncodedPolylines($encodedPolylines);
        $this->assertNoExtendables();
    }

    public function testSetEncodedPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));

        $this->assertEncodedPolylines($encodedPolylines);
        $this->assertExtendables($encodedPolylines);
    }

    public function testAddEncodedPolylinesWithoutAutoZoom()
    {
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));
        $this->overlays->addEncodedPolylines($newEncodedPolylines = array($this->createEncodedPolylineMock()));

        $this->assertEncodedPolylines(array_merge($encodedPolylines, $newEncodedPolylines));
        $this->assertNoExtendables();
    }

    public function testAddEncodedPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));
        $this->overlays->addEncodedPolylines($newEncodedPolylines = array($this->createEncodedPolylineMock()));

        $this->assertEncodedPolylines($expected = array_merge($encodedPolylines, $newEncodedPolylines));
        $this->assertExtendables($expected);
    }

    public function testRemoveEncodedPolylinesWithoutAutoZoom()
    {
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));
        $this->overlays->removeEncocodedPolylines($encodedPolylines);

        $this->assertNoEncodedPolylines();
        $this->assertNoExtendables();
    }

    public function testRemoveEncodedPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setEncodedPolylines($encodedPolylines = array($this->createEncodedPolylineMock()));
        $this->overlays->removeEncocodedPolylines($encodedPolylines);

        $this->assertNoEncodedPolylines();
        $this->assertNoExtendables();
    }

    public function testResetEncodedPolylinesWithoutAutoZoom()
    {
        $this->overlays->setEncodedPolylines(array($this->createEncodedPolylineMock()));
        $this->overlays->resetEncodedPolylines();

        $this->assertNoEncodedPolylines();
        $this->assertNoExtendables();
    }

    public function testResetEncodedPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setEncodedPolylines(array($this->createEncodedPolylineMock()));
        $this->overlays->resetEncodedPolylines();

        $this->assertNoEncodedPolylines();
        $this->assertNoExtendables();
    }

    public function testAddEncodedPolylineWithoutAutoZoom()
    {
        $this->overlays->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());

        $this->assertEncodedPolyline($encodedPolyline);
        $this->assertNoExtendable($encodedPolyline);
    }

    public function testAddEncodedPolylineWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());

        $this->assertEncodedPolyline($encodedPolyline);
        $this->assertExtendable($encodedPolyline);
    }

    public function testAddEncodedPolylineUnicity()
    {
        $this->overlays->resetEncodedPolylines();
        $this->overlays->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());
        $this->overlays->addEncodedPolyline($encodedPolyline);

        $this->assertEncodedPolylines(array($encodedPolyline));
    }

    public function testRemoveEncodedPolylineWithoutAutoZoom()
    {
        $this->overlays->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());
        $this->overlays->removeEncodedPolyline($encodedPolyline);

        $this->assertNoEncodedPolyline($encodedPolyline);
        $this->assertNoExtendable($encodedPolyline);
    }

    public function testRemoveEncodedPolylineWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addEncodedPolyline($encodedPolyline = $this->createEncodedPolylineMock());
        $this->overlays->removeEncodedPolyline($encodedPolyline);

        $this->assertNoEncodedPolyline($encodedPolyline);
        $this->assertNoExtendable($encodedPolyline);
    }

    public function testSetGroundOverlaysWithoutAutoZoom()
    {
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));

        $this->assertGroundOverlays($groundOverlays);
        $this->assertNoExtendables();
    }

    public function testSetGroundOverlaysWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));

        $this->assertGroundOverlays($groundOverlays);
        $this->assertExtendables($groundOverlays);
    }

    public function testAddGroundOverlaysWithoutAutoZoom()
    {
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));
        $this->overlays->addGroundOverlays($newGroundOverlays = array($this->createGroundOverlayMock()));

        $this->assertGroundOverlays(array_merge($groundOverlays, $newGroundOverlays));
        $this->assertNoExtendables();
    }

    public function testAddGroundOverlaysWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));
        $this->overlays->addGroundOverlays($newGroundOverlays = array($this->createGroundOverlayMock()));

        $this->assertGroundOverlays($expected = array_merge($groundOverlays, $newGroundOverlays));
        $this->assertExtendables($expected);
    }

    public function testRemoveGroundOverlaysWithoutAutoZoom()
    {
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));
        $this->overlays->removeGroundOverlays($groundOverlays);

        $this->assertNoGroundOverlays();
        $this->assertNoExtendables();
    }

    public function testRemoveGroundOverlaysWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setGroundOverlays($groundOverlays = array($this->createGroundOverlayMock()));
        $this->overlays->removeGroundOverlays($groundOverlays);

        $this->assertNoGroundOverlays();
        $this->assertNoExtendables();
    }

    public function testResetGroundOverlaysWithoutAutoZoom()
    {
        $this->overlays->setGroundOverlays(array($this->createGroundOverlayMock()));
        $this->overlays->resetGroundOverlays();

        $this->assertNoGroundOverlays();
        $this->assertNoExtendables();
    }

    public function testResetGroundOverlaysWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setGroundOverlays(array($this->createGroundOverlayMock()));
        $this->overlays->resetGroundOverlays();

        $this->assertNoGroundOverlays();
        $this->assertNoExtendables();
    }

    public function testAddGroundOverlayWithoutAutoZoom()
    {
        $this->overlays->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());

        $this->assertGroundOverlay($groundOverlay);
        $this->assertNoExtendable($groundOverlay);
    }

    public function testAddGroundOverlayWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());

        $this->assertGroundOverlay($groundOverlay);
        $this->assertExtendable($groundOverlay);
    }

    public function testAddGroundOverlayUnicity()
    {
        $this->overlays->resetGroundOverlays();
        $this->overlays->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());
        $this->overlays->addGroundOverlay($groundOverlay);

        $this->assertGroundOverlays(array($groundOverlay));
    }

    public function testRemoveGroundOverlayWithoutAutoZoom()
    {
        $this->overlays->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());
        $this->overlays->removeGroundOverlay($groundOverlay);

        $this->assertNoGroundOverlay($groundOverlay);
        $this->assertNoExtendable($groundOverlay);
    }

    public function testRemoveGroundOverlayWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addGroundOverlay($groundOverlay = $this->createGroundOverlayMock());
        $this->overlays->removeGroundOverlay($groundOverlay);

        $this->assertNoGroundOverlay($groundOverlay);
        $this->assertNoExtendable($groundOverlay);
    }

    public function testSetInfoWindowsWithoutAutoZoom()
    {
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));

        $this->assertInfoWindows($infoWindows);
        $this->assertNoExtendables();
    }

    public function testSetInfoWindowsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));

        $this->assertInfoWindows($infoWindows);
        $this->assertExtendables($infoWindows);
    }

    public function testAddInfoWindowsWithoutAutoZoom()
    {
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));
        $this->overlays->addInfoWindows($newInfoWindows = array($this->createInfoWindowMock()));

        $this->assertInfoWindows(array_merge($infoWindows, $newInfoWindows));
        $this->assertNoExtendables();
    }

    public function testAddInfoWindowsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));
        $this->overlays->addInfoWindows($newInfoWindows = array($this->createInfoWindowMock()));

        $this->assertInfoWindows($expected = array_merge($infoWindows, $newInfoWindows));
        $this->assertExtendables($expected);
    }

    public function testRemoveInfoWindowsWithoutAutoZoom()
    {
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));
        $this->overlays->removeInfoWindows($infoWindows);

        $this->assertNoInfoWindows();
        $this->assertNoExtendables();
    }

    public function testRemoveInfoWindowsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setInfoWindows($infoWindows = array($this->createInfoWindowMock()));
        $this->overlays->removeInfoWindows($infoWindows);

        $this->assertNoInfoWindows();
        $this->assertNoExtendables();
    }

    public function testResetInfoWindowsWithoutAutoZoom()
    {
        $this->overlays->setInfoWindows(array($this->createInfoWindowMock()));
        $this->overlays->resetInfoWindows();

        $this->assertNoInfoWindows();
        $this->assertNoExtendables();
    }

    public function testResetInfoWindowsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setInfoWindows(array($this->createInfoWindowMock()));
        $this->overlays->resetInfoWindows();

        $this->assertNoInfoWindows();
        $this->assertNoExtendables();
    }

    public function testAddInfoWindowWithoutAutoZoom()
    {
        $this->overlays->addInfoWindow($infoWindow = $this->createInfoWindowMock());

        $this->assertInfoWindow($infoWindow);
        $this->assertNoExtendable($infoWindow);
    }

    public function testAddInfoWindowWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addInfoWindow($infoWindow = $this->createInfoWindowMock());

        $this->assertInfoWindow($infoWindow);
        $this->assertExtendable($infoWindow);
    }

    public function testAddInfoWindowUnicity()
    {
        $this->overlays->resetInfoWindows();
        $this->overlays->addInfoWindow($infoWindow = $this->createInfoWindowMock());
        $this->overlays->addInfoWindow($infoWindow);

        $this->assertInfoWindows(array($infoWindow));
    }

    public function testRemoveInfoWindowWithoutAutoZoom()
    {
        $this->overlays->addInfoWindow($infoWindow = $this->createInfoWindowMock());
        $this->overlays->removeInfoWindow($infoWindow);

        $this->assertNoInfoWindow($infoWindow);
        $this->assertNoExtendable($infoWindow);
    }

    public function testRemoveInfoWindowWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addInfoWindow($infoWindow = $this->createInfoWindowMock());
        $this->overlays->removeInfoWindow($infoWindow);

        $this->assertNoInfoWindow($infoWindow);
        $this->assertNoExtendable($infoWindow);
    }

    public function testSetPolygonsWithoutAutoZoom()
    {
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));

        $this->assertPolygons($polygons);
        $this->assertNoExtendables();
    }

    public function testSetPolygonsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));

        $this->assertPolygons($polygons);
        $this->assertExtendables($polygons);
    }

    public function testAddPolygonsWithoutAutoZoom()
    {
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));
        $this->overlays->addPolygons($newPolygons = array($this->createPolygonMock()));

        $this->assertPolygons(array_merge($polygons, $newPolygons));
        $this->assertNoExtendables();
    }

    public function testAddPolygonsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));
        $this->overlays->addPolygons($newPolygons = array($this->createPolygonMock()));

        $this->assertPolygons($expected = array_merge($polygons, $newPolygons));
        $this->assertExtendables($expected);
    }

    public function testRemovePolygonsWithoutAutoZoom()
    {
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));
        $this->overlays->removePolygons($polygons);

        $this->assertNoPolygons();
        $this->assertNoExtendables();
    }

    public function testRemovePolygonsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolygons($polygons = array($this->createPolygonMock()));
        $this->overlays->removePolygons($polygons);

        $this->assertNoPolygons();
        $this->assertNoExtendables();
    }

    public function testResetPolygonsWithoutAutoZoom()
    {
        $this->overlays->setPolygons(array($this->createPolygonMock()));
        $this->overlays->resetPolygons();

        $this->assertNoPolygons();
        $this->assertNoExtendables();
    }

    public function testResetPolygonsWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolygons(array($this->createPolygonMock()));
        $this->overlays->resetPolygons();

        $this->assertNoPolygons();
        $this->assertNoExtendables();
    }

    public function testAddPolygonWithoutAutoZoom()
    {
        $this->overlays->addPolygon($polygon = $this->createPolygonMock());

        $this->assertPolygon($polygon);
        $this->assertNoExtendable($polygon);
    }

    public function testAddPolygonWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addPolygon($polygon = $this->createPolygonMock());

        $this->assertPolygon($polygon);
        $this->assertExtendable($polygon);
    }

    public function testAddPolygonUnicity()
    {
        $this->overlays->resetPolygons();
        $this->overlays->addPolygon($polygon = $this->createPolygonMock());
        $this->overlays->addPolygon($polygon);

        $this->assertPolygons(array($polygon));
    }

    public function testRemovePolygonWithoutAutoZoom()
    {
        $this->overlays->addPolygon($polygon = $this->createPolygonMock());
        $this->overlays->removePolygon($polygon);

        $this->assertNoPolygon($polygon);
        $this->assertNoExtendable($polygon);
    }

    public function testRemovePolygonWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addPolygon($polygon = $this->createPolygonMock());
        $this->overlays->removePolygon($polygon);

        $this->assertNoPolygon($polygon);
        $this->assertNoExtendable($polygon);
    }

    public function testSetPolylinesWithoutAutoZoom()
    {
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));

        $this->assertPolylines($polylines);
        $this->assertNoExtendables();
    }

    public function testSetPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));

        $this->assertPolylines($polylines);
        $this->assertExtendables($polylines);
    }

    public function testAddPolylinesWithoutAutoZoom()
    {
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));
        $this->overlays->addPolylines($newPolylines = array($this->createPolylineMock()));

        $this->assertPolylines(array_merge($polylines, $newPolylines));
        $this->assertNoExtendables();
    }

    public function testAddPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));
        $this->overlays->addPolylines($newPolylines = array($this->createPolylineMock()));

        $this->assertPolylines($expected = array_merge($polylines, $newPolylines));
        $this->assertExtendables($expected);
    }

    public function testRemovePolylinesWithoutAutoZoom()
    {
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));
        $this->overlays->removePolylines($polylines);

        $this->assertNoPolylines();
        $this->assertNoExtendables();
    }

    public function testRemovePolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolylines($polylines = array($this->createPolylineMock()));
        $this->overlays->removePolylines($polylines);

        $this->assertNoPolylines();
        $this->assertNoExtendables();
    }

    public function testResetPolylinesWithoutAutoZoom()
    {
        $this->overlays->setPolylines(array($this->createPolylineMock()));
        $this->overlays->resetPolylines();

        $this->assertNoPolylines();
        $this->assertNoExtendables();
    }

    public function testResetPolylinesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setPolylines(array($this->createPolylineMock()));
        $this->overlays->resetPolylines();

        $this->assertNoPolylines();
        $this->assertNoExtendables();
    }

    public function testAddPolylineWithoutAutoZoom()
    {
        $this->overlays->addPolyline($polyline = $this->createPolylineMock());

        $this->assertPolyline($polyline);
        $this->assertNoExtendable($polyline);
    }

    public function testAddPolylineWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addPolyline($polyline = $this->createPolylineMock());

        $this->assertPolyline($polyline);
        $this->assertExtendable($polyline);
    }

    public function testAddPolylineUnicity()
    {
        $this->overlays->resetPolylines();
        $this->overlays->addPolyline($polyline = $this->createPolylineMock());
        $this->overlays->addPolyline($polyline);

        $this->assertPolylines(array($polyline));
    }

    public function testRemovePolylineWithoutAutoZoom()
    {
        $this->overlays->addPolyline($polyline = $this->createPolylineMock());
        $this->overlays->removePolyline($polyline);

        $this->assertNoPolyline($polyline);
        $this->assertNoExtendable($polyline);
    }

    public function testRemovePolylineWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addPolyline($polyline = $this->createPolylineMock());
        $this->overlays->removePolyline($polyline);

        $this->assertNoPolyline($polyline);
        $this->assertNoExtendable($polyline);
    }

    public function testSetRectanglesWithoutAutoZoom()
    {
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));

        $this->assertRectangles($rectangles);
        $this->assertNoExtendables();
    }

    public function testSetRectanglesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));

        $this->assertRectangles($rectangles);
        $this->assertExtendables($rectangles);
    }

    public function testAddRectanglesWithoutAutoZoom()
    {
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));
        $this->overlays->addRectangles($newRectangles = array($this->createRectangleMock()));

        $this->assertRectangles(array_merge($rectangles, $newRectangles));
        $this->assertNoExtendables();
    }

    public function testAddRectanglesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));
        $this->overlays->addRectangles($newRectangles = array($this->createRectangleMock()));

        $this->assertRectangles($expected = array_merge($rectangles, $newRectangles));
        $this->assertExtendables($expected);
    }

    public function testRemoveRectanglesWithoutAutoZoom()
    {
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));
        $this->overlays->removeRectangles($rectangles);

        $this->assertNoRectangles();
        $this->assertNoExtendables();
    }

    public function testRemoveRectanglesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setRectangles($rectangles = array($this->createRectangleMock()));
        $this->overlays->removeRectangles($rectangles);

        $this->assertNoRectangles();
        $this->assertNoExtendables();
    }

    public function testResetRectanglesWithoutAutoZoom()
    {
        $this->overlays->setRectangles(array($this->createRectangleMock()));
        $this->overlays->resetRectangles();

        $this->assertNoRectangles();
        $this->assertNoExtendables();
    }

    public function testResetRectanglesWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->setRectangles(array($this->createRectangleMock()));
        $this->overlays->resetRectangles();

        $this->assertNoRectangles();
        $this->assertNoExtendables();
    }

    public function testAddRectangleWithoutAutoZoom()
    {
        $this->overlays->addRectangle($rectangle = $this->createRectangleMock());

        $this->assertRectangle($rectangle);
        $this->assertNoExtendable($rectangle);
    }

    public function testAddRectangleWithoAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addRectangle($rectangle = $this->createRectangleMock());

        $this->assertRectangle($rectangle);
        $this->assertExtendable($rectangle);
    }

    public function testAddRectangleUnicity()
    {
        $this->overlays->resetRectangles();
        $this->overlays->addRectangle($rectangle = $this->createRectangleMock());
        $this->overlays->addRectangle($rectangle);

        $this->assertRectangles(array($rectangle));
    }

    public function testRemoveRectangleWithoutAutoZoom()
    {
        $this->overlays->addRectangle($rectangle = $this->createRectangleMock());
        $this->overlays->removeRectangle($rectangle);

        $this->assertNoRectangle($rectangle);
        $this->assertNoExtendable($rectangle);
    }

    public function testRemoveRectangleWithAutoZoom()
    {
        $this->overlays->setAutoZoom(true);
        $this->overlays->addRectangle($rectangle = $this->createRectangleMock());
        $this->overlays->removeRectangle($rectangle);

        $this->assertNoRectangle($rectangle);
        $this->assertNoExtendable($rectangle);
    }

    public function testSetExtends()
    {
        $this->overlays->setExtends($extends = array($this->createExtendableMock()));

        $this->assertExtendables($extends);
    }

    public function testAddExtends()
    {
        $this->overlays->setExtends($extends = array($this->createExtendableMock()));
        $this->overlays->addExtends($newExtends = array($this->createExtendableMock()));

        $this->assertExtendables(array_merge($extends, $newExtends));
    }

    public function testRemoveExtends()
    {
        $this->overlays->setExtends($extends = array($this->createExtendableMock()));
        $this->overlays->removeExtends($extends);

        $this->assertNoExtendables();
    }

    public function testResetExtends()
    {
        $this->overlays->setExtends(array($this->createExtendableMock()));
        $this->overlays->resetExtends();

        $this->assertNoExtendables();
    }

    public function testAddExtend()
    {
        $this->overlays->addExtend($extend = $this->createExtendableMock());

        $this->assertExtendable($extend);
    }

    public function testAddExtendUnicity()
    {
        $this->overlays->resetExtends();
        $this->overlays->addExtend($extend = $this->createExtendableMock());
        $this->overlays->addExtend($extend);

        $this->assertExtendables(array($extend));
    }

    public function testRemoveExtend()
    {
        $this->overlays->addExtend($extend = $this->createExtendableMock());
        $this->overlays->removeExtend($extend);

        $this->assertNoExtendable($extend);
    }

    public function testSetAutoZoom()
    {
        $this->overlays->setAutoZoom(true);

        $this->assertTrue($this->overlays->isAutoZoom());
    }

    /**
     * Creates a marker cluster mock.
     *
     * @param array $markers The markers.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster|\PHPUnit_Framework_MockObject_MockObject The marker cluster mock.
     */
    protected function createMarkerClusterMock(array $markers = array())
    {
        $markerCluster = parent::createMarkerClusterMock();

        $markerCluster
            ->expects($this->any())
            ->method('hasMarkers')
            ->will($this->returnValue(!empty($markers)));

        $markerCluster
            ->expects($this->any())
            ->method('getMarkers')
            ->will($this->returnValue($markers));

        foreach ($markers as $marker) {
            $markerCluster
                ->expects($this->any())
                ->method('hasMarker')
                ->with($this->identicalTo($marker))
                ->will($this->returnValue(true));
        }

        return $markerCluster;
    }

    /**
     * Asserts there are markers.
     *
     * @param array $markers The markers.
     */
    private function assertMarkers($markers)
    {
        $this->assertInternalType('array', $markers);

        $this->assertTrue($this->overlays->hasMarkers());
        $this->assertSame($markers, $this->overlays->getMarkers());

        foreach ($markers as $marker) {
            $this->assertMarker($marker);
        }
    }

    /**
     * Asserts there is a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    private function assertMarker($marker)
    {
        $this->assertMarkerInstance($marker);
        $this->assertTrue($this->overlays->hasMarker($marker));
    }

    /**
     * Asserts there are circles.
     *
     * @param array $circles The circles.
     */
    private function assertCircles($circles)
    {
        $this->assertInternalType('array', $circles);

        $this->assertTrue($this->overlays->hasCircles());
        $this->assertSame($circles, $this->overlays->getCircles());

        foreach ($circles as $circle) {
            $this->assertCircle($circle);
        }
    }

    /**
     * Asserts there is a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     */
    private function assertCircle($circle)
    {
        $this->assertCircleInstance($circle);
        $this->assertTrue($this->overlays->hasCircle($circle));
    }

    /**
     * Asserts there are encoded polylines.
     *
     * @param array $encodedPolylines The encoded polylines.
     */
    private function assertEncodedPolylines($encodedPolylines)
    {
        $this->assertInternalType('array', $encodedPolylines);

        $this->assertTrue($this->overlays->hasEncodedPolylines());
        $this->assertSame($encodedPolylines, $this->overlays->getEncodedPolylines());
    }

    /**
     * Asserts there is an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    private function assertEncodedPolyline($encodedPolyline)
    {
        $this->assertEncodedPolylineInstance($encodedPolyline);
        $this->assertTrue($this->overlays->hasEncodedPolyline($encodedPolyline));
    }

    /**
     * Asserts there are ground overlays.
     *
     * @param array $groundOverlays The ground overlays.
     */
    private function assertGroundOverlays($groundOverlays)
    {
        $this->assertInternalType('array', $groundOverlays);

        $this->assertTrue($this->overlays->hasGroundOverlays());
        $this->assertSame($groundOverlays, $this->overlays->getGroundOverlays());

        foreach ($groundOverlays as $groundOverlay) {
            $this->assertGroundOverlay($groundOverlay);
        }
    }

    /**
     * Asserts there is a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     */
    private function assertGroundOverlay($groundOverlay)
    {
        $this->assertGroundOverlayInstance($groundOverlay);
        $this->assertTrue($this->overlays->hasGroundOverlay($groundOverlay));
    }

    /**
     * Asserts there are info windows.
     *
     * @param array $infoWindows The info windows.
     */
    private function assertInfoWindows($infoWindows)
    {
        $this->assertInternalType('array', $infoWindows);

        $this->assertTrue($this->overlays->hasInfoWindows());
        $this->assertSame($infoWindows, $this->overlays->getInfoWindows());

        foreach ($infoWindows as $infoWindow) {
            $this->assertInfoWindow($infoWindow);
        }
    }

    /**
     * Asserts there is an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    private function assertInfoWindow($infoWindow)
    {
        $this->assertInfoWindowInstance($infoWindow);
        $this->assertTrue($this->overlays->hasInfoWindow($infoWindow));
    }

    /**
     * Asserts there are polygons.
     *
     * @param array $polygons The polygons.
     */
    private function assertPolygons($polygons)
    {
        $this->assertInternalType('array', $polygons);

        $this->assertTrue($this->overlays->hasPolygons());
        $this->assertSame($polygons, $this->overlays->getPolygons());

        foreach ($polygons as $polygon) {
            $this->assertPolygon($polygon);
        }
    }

    /**
     * Asserts there is a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     */
    private function assertPolygon($polygon)
    {
        $this->assertPolygonInstance($polygon);
        $this->assertTrue($this->overlays->hasPolygon($polygon));
    }

    /**
     * Asserts there are polylines.
     *
     * @param array $polylines The polylines.
     */
    private function assertPolylines($polylines)
    {
        $this->assertInternalType('array', $polylines);

        $this->assertTrue($this->overlays->hasPolylines());
        $this->assertSame($polylines, $this->overlays->getPolylines());

        foreach ($polylines as $polyline) {
            $this->assertPolyline($polyline);
        }
    }

    /**
     * Asserts there is a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     */
    private function assertPolyline($polyline)
    {
        $this->assertPolylineInstance($polyline);
        $this->assertTrue($this->overlays->hasPolyline($polyline));
    }

    /**
     * Asserts there are rectangles.
     *
     * @param array $rectangles The rectangles.
     */
    private function assertRectangles($rectangles)
    {
        $this->assertInternalType('array', $rectangles);

        $this->assertTrue($this->overlays->hasRectangles());
        $this->assertSame($rectangles, $this->overlays->getRectangles());

        foreach ($rectangles as $rectangle) {
            $this->assertRectangle($rectangle);
        }
    }

    /**
     * Asserts there is a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle the rectangle.
     */
    private function assertRectangle($rectangle)
    {
        $this->assertRectangleInstance($rectangle);
        $this->assertTrue($this->overlays->hasRectangle($rectangle));
    }

    /**
     * Asserts there are extendables.
     *
     * @param array $extendables The extendables.
     */
    private function assertExtendables($extendables)
    {
        $this->assertInternalType('array', $extendables);

        $this->assertTrue($this->overlays->hasExtends());
        $this->assertSame($extendables, $this->overlays->getExtends());

        foreach ($extendables as $extendable) {
            $this->assertExtendable($extendable);
        }
    }

    /**
     * Asserts there is an extendable.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extendable The extendable.
     */
    private function assertExtendable($extendable)
    {
        $this->assertExtendableInstance($extendable);
        $this->assertTrue($this->overlays->hasExtend($extendable));
    }

    /**
     * Asserts there are no markers.
     */
    private function assertNoMarkers()
    {
        $this->assertFalse($this->overlays->hasMarkers());
        $this->assertEmpty($this->overlays->getMarkers());
    }

    /**
     * Asserts there is no marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    private function assertNoMarker($marker)
    {
        $this->assertMarkerInstance($marker);
        $this->assertFalse($this->overlays->hasMarker($marker));
    }

    /**
     * Asserts there are no circles.
     */
    private function assertNoCircles()
    {
        $this->assertFalse($this->overlays->hasCircles());
        $this->assertEmpty($this->overlays->getCircles());
    }

    /**
     * Asserts there is no circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     */
    private function assertNoCircle($circle)
    {
        $this->assertCircleInstance($circle);
        $this->assertFalse($this->overlays->hasCircle($circle));
    }

    /**
     * Asserts there are no encoded polylines.
     */
    private function assertNoEncodedPolylines()
    {
        $this->assertFalse($this->overlays->hasEncodedPolylines());
        $this->assertEmpty($this->overlays->getEncodedPolylines());
    }

    /**
     * Asserts there is no encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    private function assertNoEncodedPolyline($encodedPolyline)
    {
        $this->assertEncodedPolylineInstance($encodedPolyline);
        $this->assertFalse($this->overlays->hasEncodedPolyline($encodedPolyline));
    }

    /**
     * Asserts there are no ground overlays.
     */
    private function assertNoGroundOverlays()
    {
        $this->assertFalse($this->overlays->hasGroundOverlays());
        $this->assertEmpty($this->overlays->getGroundOverlays());
    }

    /**
     * Asserts there is no ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     */
    private function assertNoGroundOverlay($groundOverlay)
    {
        $this->assertGroundOverlayInstance($groundOverlay);
        $this->assertFalse($this->overlays->hasGroundOverlay($groundOverlay));
    }

    /**
     * Asserts there are no info windows.
     */
    private function assertNoInfoWindows()
    {
        $this->assertFalse($this->overlays->hasInfoWindows());
        $this->assertEmpty($this->overlays->getInfoWindows());
    }

    /**
     * Asserts there is no info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    private function assertNoInfoWindow($infoWindow)
    {
        $this->assertInfoWindowInstance($infoWindow);
        $this->assertFalse($this->overlays->hasInfoWindow($infoWindow));
    }

    /**
     * Asserts there are no polygons.
     */
    private function assertNoPolygons()
    {
        $this->assertFalse($this->overlays->hasPolygons());
        $this->assertEmpty($this->overlays->getPolygons());
    }

    /**
     * Asserts there is no polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     */
    private function assertNoPolygon($polygon)
    {
        $this->assertPolygonInstance($polygon);
        $this->assertFalse($this->overlays->hasPolygon($polygon));
    }

    /**
     * Asserts there are no polylines.
     */
    private function assertNoPolylines()
    {
        $this->assertFalse($this->overlays->hasPolylines());
        $this->assertEmpty($this->overlays->getPolylines());
    }

    /**
     * Asserts there is no polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     */
    private function assertNoPolyline($polyline)
    {
        $this->assertPolylineInstance($polyline);
        $this->assertFalse($this->overlays->hasPolyline($polyline));
    }

    /**
     * Asserts there are no rectangles.
     */
    private function assertNoRectangles()
    {
        $this->assertFalse($this->overlays->hasRectangles());
        $this->assertEmpty($this->overlays->getRectangles());
    }

    /**
     * Asserts there is no rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     */
    private function assertNoRectangle($rectangle)
    {
        $this->assertRectangleInstance($rectangle);
        $this->assertFalse($this->overlays->hasRectangle($rectangle));
    }

    /**
     * Asserts there are no extends.
     */
    private function assertNoExtendables()
    {
        $this->assertFalse($this->overlays->hasExtends());
        $this->assertEmpty($this->overlays->getExtends());
    }

    /**
     * Asserts there is no extendable.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extendable The extendable.
     */
    private function assertNoExtendable($extendable)
    {
        $this->assertExtendableInstance($extendable);
        $this->assertFalse($this->overlays->hasExtend($extendable));
    }
}
