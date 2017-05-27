<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlayManager
{
    /**
     * @var Map|null
     */
    private $map;

    /**
     * @var MarkerCluster
     */
    private $markerCluster;

    /**
     * @var InfoWindow[]
     */
    private $infoWindows = [];

    /**
     * @var Polyline[]
     */
    private $polylines = [];

    /**
     * @var EncodedPolyline[]
     */
    private $encodedPolylines = [];

    /**
     * @var Polygon[]
     */
    private $polygons = [];

    /**
     * @var Rectangle[]
     */
    private $rectangles = [];

    /**
     * @var Circle[]
     */
    private $circles = [];

    /**
     * @var GroundOverlay[]
     */
    private $groundOverlays = [];

    public function __construct()
    {
        $this->setMarkerCluster(new MarkerCluster());
    }

    /**
     * @return bool
     */
    public function hasMap()
    {
        return $this->map !== null;
    }

    /**
     * @return Map|null
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param Map $map
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        if ($map->getOverlayManager() !== $this) {
            $map->setOverlayManager($this);
        }
    }

    /**
     * @return MarkerCluster
     */
    public function getMarkerCluster()
    {
        return $this->markerCluster;
    }

    /**
     * @param MarkerCluster $markerCluster
     */
    public function setMarkerCluster(MarkerCluster $markerCluster)
    {
        $this->markerCluster = $markerCluster;

        if ($markerCluster->getOverlayManager() !== $this) {
            $markerCluster->setOverlayManager($this);
        }
    }

    /**
     * @return bool
     */
    public function hasMarkers()
    {
        return $this->markerCluster->hasMarkers();
    }

    /**
     * @return Marker[]
     */
    public function getMarkers()
    {
        return $this->markerCluster->getMarkers();
    }

    /**
     * @param Marker[] $markers
     */
    public function setMarkers(array $markers)
    {
        $this->markerCluster->setMarkers($markers);
    }

    /**
     * @param Marker[] $markers
     */
    public function addMarkers(array $markers)
    {
        $this->markerCluster->addMarkers($markers);
    }

    /**
     * @param Marker $marker
     *
     * @return bool
     */
    public function hasMarker(Marker $marker)
    {
        return $this->markerCluster->hasMarker($marker);
    }

    /**
     * @param Marker $marker
     */
    public function addMarker(Marker $marker)
    {
        $this->markerCluster->addMarker($marker);
    }

    /**
     * @param Marker $marker
     */
    public function removeMarker(Marker $marker)
    {
        $this->markerCluster->removeMarker($marker);
    }

    /**
     * @return bool
     */
    public function hasInfoWindows()
    {
        return !empty($this->infoWindows);
    }

    /**
     * @return InfoWindow[]
     */
    public function getInfoWindows()
    {
        return $this->infoWindows;
    }

    /**
     * @param InfoWindow[] $infoWindows
     */
    public function setInfoWindows(array $infoWindows)
    {
        foreach ($this->infoWindows as $infoWindow) {
            $this->removeInfoWindow($infoWindow);
        }

        $this->addInfoWindows($infoWindows);
    }

    /**
     * @param InfoWindow[] $infoWindows
     */
    public function addInfoWindows(array $infoWindows)
    {
        foreach ($infoWindows as $infoWindow) {
            $this->addInfoWindow($infoWindow);
        }
    }

    /**
     * @param InfoWindow $infoWindow
     *
     * @return bool
     */
    public function hasInfoWindow(InfoWindow $infoWindow)
    {
        return in_array($infoWindow, $this->infoWindows, true);
    }

    /**
     * @param InfoWindow $infoWindow
     */
    public function addInfoWindow(InfoWindow $infoWindow)
    {
        if (!$this->hasInfoWindow($infoWindow)) {
            $this->infoWindows[] = $infoWindow;
        }

        $this->addExtendable($infoWindow);
    }

    /**
     * @param InfoWindow $infoWindow
     */
    public function removeInfoWindow(InfoWindow $infoWindow)
    {
        unset($this->infoWindows[array_search($infoWindow, $this->infoWindows, true)]);
        $this->infoWindows = empty($this->infoWindows) ? [] : array_values($this->infoWindows);
        $this->removeExtendable($infoWindow);
    }

    /**
     * @return bool
     */
    public function hasPolylines()
    {
        return !empty($this->polylines);
    }

    /**
     * @return Polyline[]
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * @param Polyline[] $polylines
     */
    public function setPolylines(array $polylines)
    {
        foreach ($this->polylines as $polyline) {
            $this->removePolyline($polyline);
        }

        $this->addPolylines($polylines);
    }

    /**
     * @param Polyline[] $polylines
     */
    public function addPolylines(array $polylines)
    {
        foreach ($polylines as $polyline) {
            $this->addPolyline($polyline);
        }
    }

    /**
     * @param Polyline $polyline
     *
     * @return bool
     */
    public function hasPolyline(Polyline $polyline)
    {
        return in_array($polyline, $this->polylines, true);
    }

    /**
     * @param Polyline $polyline
     */
    public function addPolyline(Polyline $polyline)
    {
        if (!$this->hasPolyline($polyline)) {
            $this->polylines[] = $polyline;
        }

        $this->addExtendable($polyline);
    }

    /**
     * @param Polyline $polyline
     */
    public function removePolyline(Polyline $polyline)
    {
        unset($this->polylines[array_search($polyline, $this->polylines, true)]);
        $this->polylines = empty($this->polylines) ? [] : array_values($this->polylines);
        $this->removeExtendable($polyline);
    }

    /**
     * @return bool
     */
    public function hasEncodedPolylines()
    {
        return !empty($this->encodedPolylines);
    }

    /**
     * @return EncodedPolyline[]
     */
    public function getEncodedPolylines()
    {
        return $this->encodedPolylines;
    }

    /**
     * @param EncodedPolyline[] $encodedPolylines
     */
    public function setEncodedPolylines(array $encodedPolylines)
    {
        foreach ($this->encodedPolylines as $encodedPolyline) {
            $this->removeEncodedPolyline($encodedPolyline);
        }

        $this->addEncodedPolylines($encodedPolylines);
    }

    /**
     * @param EncodedPolyline[] $encodedPolylines
     */
    public function addEncodedPolylines(array $encodedPolylines)
    {
        foreach ($encodedPolylines as $encodedPolyline) {
            $this->addEncodedPolyline($encodedPolyline);
        }
    }

    /**
     * @param EncodedPolyline $encodedPolyline
     *
     * @return bool
     */
    public function hasEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        return in_array($encodedPolyline, $this->encodedPolylines, true);
    }

    /**
     * @param EncodedPolyline $encodedPolyline
     */
    public function addEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        if (!$this->hasEncodedPolyline($encodedPolyline)) {
            $this->encodedPolylines[] = $encodedPolyline;
        }

        $this->addExtendable($encodedPolyline);
    }

    /**
     * @param EncodedPolyline $encodedPolyline
     */
    public function removeEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        unset($this->encodedPolylines[array_search($encodedPolyline, $this->encodedPolylines, true)]);
        $this->encodedPolylines = empty($this->encodedPolylines) ? [] : array_values($this->encodedPolylines);
        $this->removeExtendable($encodedPolyline);
    }

    /**
     * @return bool
     */
    public function hasPolygons()
    {
        return !empty($this->polygons);
    }

    /**
     * @return Polygon[]
     */
    public function getPolygons()
    {
        return $this->polygons;
    }

    /**
     * @param Polygon[] $polygons
     */
    public function setPolygons(array $polygons)
    {
        foreach ($this->polygons as $polygon) {
            $this->removePolygon($polygon);
        }

        $this->addPolygons($polygons);
    }

    /**
     * @param Polygon[] $polygons
     */
    public function addPolygons(array $polygons)
    {
        foreach ($polygons as $polygon) {
            $this->addPolygon($polygon);
        }
    }

    /**
     * @param Polygon $polygon
     *
     * @return bool
     */
    public function hasPolygon(Polygon $polygon)
    {
        return in_array($polygon, $this->polygons, true);
    }

    /**
     * @param Polygon $polygon
     */
    public function addPolygon(Polygon $polygon)
    {
        if (!$this->hasPolygon($polygon)) {
            $this->polygons[] = $polygon;
        }

        $this->addExtendable($polygon);
    }

    /**
     * @param Polygon $polygon
     */
    public function removePolygon(Polygon $polygon)
    {
        unset($this->polygons[array_search($polygon, $this->polygons, true)]);
        $this->polygons = empty($this->polygons) ? [] : array_values($this->polygons);
        $this->removeExtendable($polygon);
    }

    /**
     * @return bool
     */
    public function hasRectangles()
    {
        return !empty($this->rectangles);
    }

    /**
     * @return Rectangle[]
     */
    public function getRectangles()
    {
        return $this->rectangles;
    }

    /**
     * @param Rectangle[] $rectangles
     */
    public function setRectangles(array $rectangles)
    {
        foreach ($this->rectangles as $rectangle) {
            $this->removeRectangle($rectangle);
        }

        $this->addRectangles($rectangles);
    }

    /**
     * @param Rectangle[] $rectangles
     */
    public function addRectangles(array $rectangles)
    {
        foreach ($rectangles as $rectangle) {
            $this->addRectangle($rectangle);
        }
    }

    /**
     * @param Rectangle $rectangle
     *
     * @return bool
     */
    public function hasRectangle(Rectangle $rectangle)
    {
        return in_array($rectangle, $this->rectangles, true);
    }

    /**
     * @param Rectangle $rectangle
     */
    public function addRectangle(Rectangle $rectangle)
    {
        if (!$this->hasRectangle($rectangle)) {
            $this->rectangles[] = $rectangle;
        }

        $this->addExtendable($rectangle);
    }

    /**
     * @param Rectangle $rectangle
     */
    public function removeRectangle(Rectangle $rectangle)
    {
        unset($this->rectangles[array_search($rectangle, $this->rectangles, true)]);
        $this->rectangles = empty($this->rectangles) ? [] : array_values($this->rectangles);
        $this->removeExtendable($rectangle);
    }

    /**
     * @return bool
     */
    public function hasCircles()
    {
        return !empty($this->circles);
    }

    /**
     * @return Circle[]
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * @param Circle[] $circles
     */
    public function setCircles(array $circles)
    {
        foreach ($this->circles as $circle) {
            $this->removeCircle($circle);
        }

        $this->addCircles($circles);
    }

    /**
     * @param Circle[] $circles
     */
    public function addCircles(array $circles)
    {
        foreach ($circles as $circle) {
            $this->addCircle($circle);
        }
    }

    /**
     * @param Circle $circle
     *
     * @return bool
     */
    public function hasCircle(Circle $circle)
    {
        return in_array($circle, $this->circles, true);
    }

    /**
     * @param Circle $circle
     */
    public function addCircle(Circle $circle)
    {
        if (!$this->hasCircle($circle)) {
            $this->circles[] = $circle;
        }

        $this->addExtendable($circle);
    }

    /**
     * @param Circle $circle
     */
    public function removeCircle(Circle $circle)
    {
        unset($this->circles[array_search($circle, $this->circles, true)]);
        $this->circles = empty($this->circles) ? [] : array_values($this->circles);
        $this->removeExtendable($circle);
    }

    /**
     * @return bool
     */
    public function hasGroundOverlays()
    {
        return !empty($this->groundOverlays);
    }

    /**
     * @return GroundOverlay[]
     */
    public function getGroundOverlays()
    {
        return $this->groundOverlays;
    }

    /**
     * @param GroundOverlay[] $groundOverlays
     */
    public function setGroundOverlays(array $groundOverlays)
    {
        foreach ($this->groundOverlays as $groundOverlay) {
            $this->removeGroundOverlay($groundOverlay);
        }

        $this->addGroundOverlays($groundOverlays);
    }

    /**
     * @param GroundOverlay[] $groundOverlays
     */
    public function addGroundOverlays(array $groundOverlays)
    {
        foreach ($groundOverlays as $groundOverlay) {
            $this->addGroundOverlay($groundOverlay);
        }
    }

    /**
     * @param GroundOverlay $groundOverlay
     *
     * @return bool
     */
    public function hasGroundOverlay(GroundOverlay $groundOverlay)
    {
        return in_array($groundOverlay, $this->groundOverlays, true);
    }

    /**
     * @param GroundOverlay $groundOverlay
     */
    public function addGroundOverlay(GroundOverlay $groundOverlay)
    {
        if (!$this->hasGroundOverlay($groundOverlay)) {
            $this->groundOverlays[] = $groundOverlay;
        }

        $this->addExtendable($groundOverlay);
    }

    /**
     * @param GroundOverlay $groundOverlay
     */
    public function removeGroundOverlay(GroundOverlay $groundOverlay)
    {
        unset($this->groundOverlays[array_search($groundOverlay, $this->groundOverlays, true)]);
        $this->groundOverlays = empty($this->groundOverlays) ? [] : array_values($this->groundOverlays);
        $this->removeExtendable($groundOverlay);
    }

    /**
     * @param ExtendableInterface $extendable
     */
    private function addExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->addExtendable($extendable);
        }
    }

    /**
     * @param ExtendableInterface $extendable
     */
    private function removeExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    /**
     * @return bool
     */
    private function isAutoZoom()
    {
        return $this->hasMap() && $this->getMap()->isAutoZoom();
    }
}
