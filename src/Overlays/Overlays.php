<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

/**
 * Overlays.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Overlays
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerCluster */
    private $markerCluster;

    /** @var array */
    private $circles = array();

    /** @var array */
    private $encodedPolylines = array();

    /** @var array */
    private $groundOverlays = array();

    /** @var array */
    private $infoWindows = array();

    /** @var array */
    private $polygons = array();

    /** @var array */
    private $polylines = array();

    /** @var array */
    private $rectangles = array();

    /** @var array */
    private $extends = array();

    /** @var boolean */
    private $autoZoom = false;

    /**
     * Creates an overlays.
     */
    public function __construct()
    {
        $this->setMarkerCluster(new MarkerCluster());
    }

    /**
     * Gets the marker cluster.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster The marker cluster.
     */
    public function getMarkerCluster()
    {
        return $this->markerCluster;
    }

    /**
     * Sets the marker cluster.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     */
    public function setMarkerCluster(MarkerCluster $markerCluster)
    {
        if ($this->markerCluster !== null) {
            $this->removeExtends($this->markerCluster->getMarkers());
        }

        $this->markerCluster = $markerCluster;
        $this->handleExtends($markerCluster->getMarkers());
    }

    /**
     * Resets the markers.
     */
    public function resetMarkers()
    {
        $this->removeExtends($this->markerCluster->getMarkers());
        $this->markerCluster->resetMarkers();
    }

    /**
     * Checks if there are markers.
     *
     * @return boolean TRUE if there are markers else FALSE.
     */
    public function hasMarkers()
    {
        return $this->markerCluster->hasMarkers();
    }

    /**
     * Gets the markers.
     *
     * @return array The markers.
     */
    public function getMarkers()
    {
        return $this->markerCluster->getMarkers();
    }

    /**
     * Sets the markers.
     *
     * @param array $markers The markers.
     */
    public function setMarkers(array $markers)
    {
        $this->resetMarkers();
        $this->addMarkers($markers);
    }

    /**
     * Adds the markers.
     *
     * @param array $markers The markers.
     */
    public function addMarkers(array $markers)
    {
        $this->markerCluster->addMarkers($markers);
        $this->handleExtends($markers);
    }

    /**
     * Removes the markers.
     *
     * @param array $markers The markers.
     */
    public function removeMarkers(array $markers)
    {
        $this->markerCluster->removeMarkers($markers);
        $this->removeExtends($markers);
    }

    /**
     * Checks if there is a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     *
     * @return boolean TRUE if there is the marker else FALSE.
     */
    public function hasMarker(Marker $marker)
    {
        return $this->markerCluster->hasMarker($marker);
    }

    /**
     * Adds a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    public function addMarker(Marker $marker)
    {
        $this->markerCluster->addMarker($marker);
        $this->handleExtend($marker);
    }

    /**
     * Removes a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    public function removeMarker(Marker $marker)
    {
        $this->markerCluster->removeMarker($marker);
        $this->removeExtend($marker);
    }

    /**
     * Resets the circles.
     */
    public function resetCircles()
    {
        $this->removeExtends($this->circles);
        $this->circles = array();
    }

    /**
     * Checks if there are circles.
     *
     * @return boolean TRUE if there are circles else FALSE.
     */
    public function hasCircles()
    {
        return !empty($this->circles);
    }

    /**
     * Gets the circles
     *
     * @return array The circles.
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * Sets the circles.
     *
     * @param array $circles The circles.
     */
    public function setCircles(array $circles)
    {
        $this->resetCircles();
        $this->addCircles($circles);
    }

    /**
     * Adds the circles.
     *
     * @param array $circles The circles.
     */
    public function addCircles(array $circles)
    {
        foreach ($circles as $circle) {
            $this->addCircle($circle);
        }
    }

    /**
     * Removes the circles.
     *
     * @param array $circles The circles.
     */
    public function removeCircles(array $circles)
    {
        foreach ($circles as $circle) {
            $this->removeCircle($circle);
        }
    }

    /**
     * Checks if there is a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     *
     * @return boolean TRUE if there is the circle else FALSE.
     */
    public function hasCircle(Circle $circle)
    {
        return in_array($circle, $this->circles, true);
    }

    /**
     * Adds a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     */
    public function addCircle(Circle $circle)
    {
        if (!$this->hasCircle($circle)) {
            $this->circles[] = $circle;
        }

        $this->handleExtend($circle);
    }

    /**
     * Removes a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     */
    public function removeCircle(Circle $circle)
    {
        unset($this->circles[array_search($circle, $this->circles, true)]);
        $this->removeExtend($circle);
    }

    /**
     * Resets the encoded polylines.
     */
    public function resetEncodedPolylines()
    {
        $this->removeExtends($this->encodedPolylines);
        $this->encodedPolylines = array();
    }

    /**
     * Checks if there are encoded polylines.
     *
     * @return boolean TRUE if there are encoded polylines else FALSE.
     */
    public function hasEncodedPolylines()
    {
        return !empty($this->encodedPolylines);
    }

    /**
     * Gets the encoded polylines.
     *
     * @return array The encoded polylines.
     */
    public function getEncodedPolylines()
    {
        return $this->encodedPolylines;
    }

    /**
     * Sets the encoded polylines.
     *
     * @param array $encodedPolylines The encoded polylines.
     */
    public function setEncodedPolylines(array $encodedPolylines)
    {
        $this->resetEncodedPolylines();
        $this->addEncodedPolylines($encodedPolylines);
    }

    /**
     * Adds the encoded polylines.
     *
     * @param array $encodedPolylines The encoded polylines.
     */
    public function addEncodedPolylines(array $encodedPolylines)
    {
        foreach ($encodedPolylines as $encodedPolyline) {
            $this->addEncodedPolyline($encodedPolyline);
        }
    }

    /**
     * Removes the encoded polylines.
     *
     * @param array $encodedPolylines The encoded polylines.
     */
    public function removeEncocodedPolylines(array $encodedPolylines)
    {
        foreach ($encodedPolylines as $encodedPolyline) {
            $this->removeEncodedPolyline($encodedPolyline);
        }
    }

    /**
     * Checks if there is an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     *
     * @return boolean TRUE if there is the encoded polyline else FALSE.
     */
    public function hasEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        return in_array($encodedPolyline, $this->encodedPolylines, true);
    }

    /**
     * Adds an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    public function addEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        if (!$this->hasEncodedPolyline($encodedPolyline)) {
            $this->encodedPolylines[] = $encodedPolyline;
        }

        $this->handleExtend($encodedPolyline);
    }

    /**
     * Removes an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    public function removeEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        unset($this->encodedPolylines[array_search($encodedPolyline, $this->encodedPolylines, true)]);
        $this->removeExtend($encodedPolyline);
    }

    /**
     * Resets the ground overlays.
     */
    public function resetGroundOverlays()
    {
        $this->removeExtends($this->groundOverlays);
        $this->groundOverlays = array();
    }

    /**
     * Checks if there are ground overlays.
     *
     * @return boolean TRUE if there are ground overlays else FALSE.
     */
    public function hasGroundOverlays()
    {
        return !empty($this->groundOverlays);
    }

    /**
     * Gets the ground overlays.
     *
     * @return array The ground overlays.
     */
    public function getGroundOverlays()
    {
        return $this->groundOverlays;
    }

    /**
     * Sets the ground overlays.
     *
     * @param array $groundOverlays The ground overlays.
     */
    public function setGroundOverlays(array $groundOverlays)
    {
        $this->resetGroundOverlays();
        $this->addGroundOverlays($groundOverlays);
    }

    /**
     * Adds the ground overlays.
     *
     * @param array $groundOverlays The ground overlays.
     */
    public function addGroundOverlays(array $groundOverlays)
    {
        foreach ($groundOverlays as $groundOverlay) {
            $this->addGroundOverlay($groundOverlay);
        }
    }

    /**
     * Removes the ground overlays.
     *
     * @param array $groundOverlays The ground overlays.
     */
    public function removeGroundOverlays(array $groundOverlays)
    {
        foreach ($groundOverlays as $groundOverlay) {
            $this->removeGroundOverlay($groundOverlay);
        }
    }

    /**
     * Checks if there is a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     *
     * @return boolean TRUE if there is the ground overlay else FALSE.
     */
    public function hasGroundOverlay(GroundOverlay $groundOverlay)
    {
        return in_array($groundOverlay, $this->groundOverlays, true);
    }

    /**
     * Adds a ground overlay.
     *
     * @param \Ivory\GoogleMapBundle\Model\Overlays\GroupOverlay $groundOverlay The ground overlay.
     */
    public function addGroundOverlay(GroundOverlay $groundOverlay)
    {
        if (!$this->hasGroundOverlay($groundOverlay)) {
            $this->groundOverlays[] = $groundOverlay;
        }

        $this->handleExtend($groundOverlay);
    }

    /**
     * Removes a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     */
    public function removeGroundOverlay(GroundOverlay $groundOverlay)
    {
        unset($this->groundOverlays[array_search($groundOverlay, $this->groundOverlays, true)]);
        $this->removeExtend($groundOverlay);
    }

    /**
     * Resets the info windows.
     */
    public function resetInfoWindows()
    {
        $this->removeExtends($this->infoWindows);
        $this->infoWindows = array();
    }

    /**
     * Checks if there are info windows.
     *
     * @return boolean TRUE if there are info windows else FALSE.
     */
    public function hasInfoWindows()
    {
        return !empty($this->infoWindows);
    }

    /**
     * Gets the info windows.
     *
     * @return array The info windows.
     */
    public function getInfoWindows()
    {
        return $this->infoWindows;
    }

    /**
     * Sets the info windows.
     *
     * @param array $infoWindows The info windows.
     */
    public function setInfoWindows(array $infoWindows)
    {
        $this->resetInfoWindows();
        $this->addInfoWindows($infoWindows);
    }

    /**
     * Adds the info windows.
     *
     * @param array $infoWindows The info windows.
     */
    public function addInfoWindows(array $infoWindows)
    {
        foreach ($infoWindows as $infoWindow) {
            $this->addInfoWindow($infoWindow);
        }
    }

    /**
     * Removes the info windows.
     *
     * @param array $infoWindows The info windows.
     */
    public function removeInfoWindows(array $infoWindows)
    {
        foreach ($infoWindows as $infoWindow) {
            $this->removeInfoWindow($infoWindow);
        }
    }

    /**
     * Checks if there is an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     *
     * @return boolean TRUE if there is the info window else FALSE.
     */
    public function hasInfoWindow(InfoWindow $infoWindow)
    {
        return in_array($infoWindow, $this->infoWindows, true);
    }

    /**
     * Adds an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    public function addInfoWindow(InfoWindow $infoWindow)
    {
        if (!$this->hasInfoWindow($infoWindow)) {
            $this->infoWindows[] = $infoWindow;
        }

        $this->handleExtend($infoWindow);
    }

    /**
     * Removes an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    public function removeInfoWindow(InfoWindow $infoWindow)
    {
        unset($this->infoWindows[array_search($infoWindow, $this->infoWindows, true)]);
        $this->removeExtend($infoWindow);
    }

    /**
     * Resets the polygons.
     */
    public function resetPolygons()
    {
        $this->removeExtends($this->polygons);
        $this->polygons = array();
    }

    /**
     * Checks if there are polygons.
     *
     * @return boolean TRUE if there are polygons else FALSE.
     */
    public function hasPolygons()
    {
        return !empty($this->polygons);
    }

    /**
     * Gets the polygons.
     *
     * @return array The polygons.
     */
    public function getPolygons()
    {
        return $this->polygons;
    }

    /**
     * Sets the polygons.
     *
     * @param array $polygons The polygons.
     */
    public function setPolygons(array $polygons)
    {
        $this->resetPolygons();
        $this->addPolygons($polygons);
    }

    /**
     * Adds the polygons.
     *
     * @param array $polygons The polygons.
     */
    public function addPolygons(array $polygons)
    {
        foreach ($polygons as $polygon) {
            $this->addPolygon($polygon);
        }
    }

    /**
     * Removes the polygons.
     *
     * @param array $polygons The polygons.
     */
    public function removePolygons(array $polygons)
    {
        foreach ($polygons as $polygon) {
            $this->removePolygon($polygon);
        }
    }

    /**
     * Checks if there is a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     *
     * @return boolean TRUE if there is the polygon else FALSE.
     */
    public function hasPolygon(Polygon $polygon)
    {
        return in_array($polygon, $this->polygons, true);
    }

    /**
     * Adds a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     */
    public function addPolygon(Polygon $polygon)
    {
        if (!$this->hasPolygon($polygon)) {
            $this->polygons[] = $polygon;
        }

        $this->handleExtend($polygon);
    }

    /**
     * Removes a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     */
    public function removePolygon(Polygon $polygon)
    {
        unset($this->polygons[array_search($polygon, $this->polygons, true)]);
        $this->removeExtend($polygon);
    }

    /**
     * Resets the polylines.
     */
    public function resetPolylines()
    {
        $this->removeExtends($this->polylines);
        $this->polylines = array();
    }

    /**
     * Checks if there are polylines.
     *
     * @return boolean TRUE if there are polylines else FALSE.
     */
    public function hasPolylines()
    {
        return !empty($this->polylines);
    }

    /**
     * Gets the polylines.
     *
     * @return array The polylines.
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * Sets the polylines.
     *
     * @param array $polylines The polylines.
     */
    public function setPolylines(array $polylines)
    {
        $this->resetPolylines();
        $this->addPolylines($polylines);
    }

    /**
     * Adds the polylines.
     *
     * @param array $polylines The polylines.
     */
    public function addPolylines(array $polylines)
    {
        foreach ($polylines as $polyline) {
            $this->addPolyline($polyline);
        }
    }

    /**
     * Removes the polylines.
     *
     * @param array $polylines The polylines.
     */
    public function removePolylines(array $polylines)
    {
        foreach ($polylines as $polyline) {
            $this->removePolyline($polyline);
        }
    }

    /**
     * Checks if there is a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     *
     * @return boolean TRUE if there is the polyline else FALSE.
     */
    public function hasPolyline(Polyline $polyline)
    {
        return in_array($polyline, $this->polylines, true);
    }

    /**
     * Adds a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline The polyline.
     */
    public function addPolyline(Polyline $polyline)
    {
        if (!$this->hasPolyline($polyline)) {
            $this->polylines[] = $polyline;
        }

        $this->handleExtend($polyline);
    }

    /**
     * Removes a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     */
    public function removePolyline(Polyline $polyline)
    {
        unset($this->polylines[array_search($polyline, $this->polylines, true)]);
        $this->removeExtend($polyline);
    }

    /**
     * Resets the rectangles.
     */
    public function resetRectangles()
    {
        $this->removeExtends($this->rectangles);
        $this->rectangles = array();
    }

    /**
     * Checks if there are rectangles.
     *
     * @return boolean TRUE if there are rectangles else FALSE.
     */
    public function hasRectangles()
    {
        return !empty($this->rectangles);
    }

    /**
     * Gets the rectangles.
     *
     * @return array The rectangles.
     */
    public function getRectangles()
    {
        return $this->rectangles;
    }

    /**
     * Sets the rectangles.
     *
     * @param array $rectangles The rectangles.
     */
    public function setRectangles(array $rectangles)
    {
        $this->resetRectangles();
        $this->addRectangles($rectangles);
    }

    /**
     * Adds the rectangles.
     *
     * @param array $rectangles The rectangles.
     */
    public function addRectangles(array $rectangles)
    {
        foreach ($rectangles as $rectangle) {
            $this->addRectangle($rectangle);
        }
    }

    /**
     * Removes the rectangles.
     *
     * @param array $rectangles The rectangles.
     */
    public function removeRectangles(array $rectangles)
    {
        foreach ($rectangles as $rectangle) {
            $this->removeRectangle($rectangle);
        }
    }

    /**
     * Checks if there is a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     *
     * @return boolean TRUE if there is the rectangle else FALSE.
     */
    public function hasRectangle(Rectangle $rectangle)
    {
        return in_array($rectangle, $this->rectangles, true);
    }

    /**
     * Adds a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     */
    public function addRectangle(Rectangle $rectangle)
    {
        if (!$this->hasRectangle($rectangle)) {
            $this->rectangles[] = $rectangle;
        }

        $this->handleExtend($rectangle);
    }

    /**
     * Removes a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     */
    public function removeRectangle(Rectangle $rectangle)
    {
        unset($this->rectangles[array_search($rectangle, $this->rectangles, true)]);
        $this->removeExtend($rectangle);
    }

    /**
     * Resets the extends.
     */
    public function resetExtends()
    {
        $this->extends = array();
    }

    /**
     * Checks if there are extends.
     *
     * @return boolean TRUE if there are extends else FALSE.
     */
    public function hasExtends()
    {
        return !empty($this->extends);
    }

    /**
     * Gets the extends.
     *
     * @return array The extends.
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets the extends.
     *
     * @param array $extends The extends.
     */
    public function setExtends(array $extends)
    {
        $this->resetExtends();
        $this->addExtends($extends);
    }

    /**
     * Adds the extends.
     *
     * @param array $extends The extends.
     */
    public function addExtends(array $extends)
    {
        foreach ($extends as $extend) {
            $this->addExtend($extend);
        }
    }

    /**
     * Removes the extends.
     *
     * @param array $extends The extends.
     */
    public function removeExtends(array $extends)
    {
        foreach ($extends as $extend) {
            $this->removeExtend($extend);
        }
    }

    /**
     * Checks if there is the extend.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The extend.
     *
     * @return boolean TRUE if there is the extend else FALSE.
     */
    public function hasExtend(ExtendableInterface $extend)
    {
        return in_array($extend, $this->extends, true);
    }

    /**
     * Adds an extend.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The extend.
     */
    public function addExtend(ExtendableInterface $extend)
    {
        if (!$this->hasExtend($extend)) {
            $this->extends[] = $extend;
        }
    }

    /**
     * Removes an extend.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The extend.
     */
    public function removeExtend(ExtendableInterface $extend)
    {
        unset($this->extends[array_search($extend, $this->extends, true)]);
    }

    /**
     * Check if it zooms automatically on the overlays.
     *
     * @return boolean TRUE if it zooms automatically on the overlays else FALSE.
     */
    public function isAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * Sets if it zooms automatically on the overlays.
     *
     * @param boolean $autoZoom TRUE if it zooms automatically on the overlays else FALSE.
     */
    public function setAutoZoom($autoZoom)
    {
        $this->autoZoom = $autoZoom;
    }

    /**
     * Handles the extends.
     *
     * @param array $extends The extends.
     */
    private function handleExtends(array $extends)
    {
        foreach ($extends as $extend) {
            $this->handleExtend($extend);
        }
    }

    /**
     * Handles an extend.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The extend.
     */
    private function handleExtend(ExtendableInterface $extend)
    {
        if ($this->autoZoom) {
            $this->addExtend($extend);
        }
    }
}
