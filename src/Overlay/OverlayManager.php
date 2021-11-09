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
    private ?Map $map = null;

    private ?MarkerCluster $markerCluster = null;

    /**
     * @var InfoWindow[]
     */
    private array $infoWindows = [];

    /**
     * @var Polyline[]
     */
    private array $polylines = [];

    /**
     * @var EncodedPolyline[]
     */
    private array $encodedPolylines = [];

    /**
     * @var Polygon[]
     */
    private array $polygons = [];

    /**
     * @var Rectangle[]
     */
    private array $rectangles = [];

    /**
     * @var Circle[]
     */
    private array $circles = [];

    /**
     * @var GroundOverlay[]
     */
    private array $groundOverlays = [];

    public function __construct()
    {
        $this->setMarkerCluster(new MarkerCluster());
    }

    public function hasMap(): bool
    {
        return $this->map !== null;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(Map $map): void
    {
        $this->map = $map;

        if ($map->getOverlayManager() !== $this) {
            $map->setOverlayManager($this);
        }
    }

    public function getMarkerCluster(): ?MarkerCluster
    {
        return $this->markerCluster;
    }

    public function setMarkerCluster(MarkerCluster $markerCluster): void
    {
        $this->markerCluster = $markerCluster;

        if ($markerCluster->getOverlayManager() !== $this) {
            $markerCluster->setOverlayManager($this);
        }
    }

    public function hasMarkers(): bool
    {
        return $this->markerCluster->hasMarkers();
    }

    /**
     * @return Marker[]
     */
    public function getMarkers(): array
    {
        return $this->markerCluster->getMarkers();
    }

    /**
     * @param Marker[] $markers
     */
    public function setMarkers(array $markers): void
    {
        $this->markerCluster->setMarkers($markers);
    }

    /**
     * @param Marker[] $markers
     */
    public function addMarkers(array $markers): void
    {
        $this->markerCluster->addMarkers($markers);
    }

    public function hasMarker(Marker $marker): bool
    {
        return $this->markerCluster->hasMarker($marker);
    }

    public function addMarker(Marker $marker): void
    {
        $this->markerCluster->addMarker($marker);
    }

    public function removeMarker(Marker $marker): void
    {
        $this->markerCluster->removeMarker($marker);
    }

    public function hasInfoWindows(): bool
    {
        return !empty($this->infoWindows);
    }

    /**
     * @return InfoWindow[]
     */
    public function getInfoWindows(): array
    {
        return $this->infoWindows;
    }

    /**
     * @param InfoWindow[] $infoWindows
     */
    public function setInfoWindows(array $infoWindows): void
    {
        foreach ($this->infoWindows as $infoWindow) {
            $this->removeInfoWindow($infoWindow);
        }

        $this->addInfoWindows($infoWindows);
    }

    /**
     * @param InfoWindow[] $infoWindows
     */
    public function addInfoWindows(array $infoWindows): void
    {
        foreach ($infoWindows as $infoWindow) {
            $this->addInfoWindow($infoWindow);
        }
    }

    public function hasInfoWindow(InfoWindow $infoWindow): bool
    {
        return in_array($infoWindow, $this->infoWindows, true);
    }

    public function addInfoWindow(InfoWindow $infoWindow): void
    {
        if (!$this->hasInfoWindow($infoWindow)) {
            $this->infoWindows[] = $infoWindow;
        }

        $this->addExtendable($infoWindow);
    }

    public function removeInfoWindow(InfoWindow $infoWindow): void
    {
        unset($this->infoWindows[array_search($infoWindow, $this->infoWindows, true)]);
        $this->infoWindows = empty($this->infoWindows) ? [] : array_values($this->infoWindows);
        $this->removeExtendable($infoWindow);
    }

    public function hasPolylines(): bool
    {
        return !empty($this->polylines);
    }

    /**
     * @return Polyline[]
     */
    public function getPolylines(): array
    {
        return $this->polylines;
    }

    /**
     * @param Polyline[] $polylines
     */
    public function setPolylines(array $polylines): void
    {
        foreach ($this->polylines as $polyline) {
            $this->removePolyline($polyline);
        }

        $this->addPolylines($polylines);
    }

    /**
     * @param Polyline[] $polylines
     */
    public function addPolylines(array $polylines): void
    {
        foreach ($polylines as $polyline) {
            $this->addPolyline($polyline);
        }
    }

    public function hasPolyline(Polyline $polyline): bool
    {
        return in_array($polyline, $this->polylines, true);
    }

    public function addPolyline(Polyline $polyline): void
    {
        if (!$this->hasPolyline($polyline)) {
            $this->polylines[] = $polyline;
        }

        $this->addExtendable($polyline);
    }

    public function removePolyline(Polyline $polyline): void
    {
        unset($this->polylines[array_search($polyline, $this->polylines, true)]);
        $this->polylines = empty($this->polylines) ? [] : array_values($this->polylines);
        $this->removeExtendable($polyline);
    }

    public function hasEncodedPolylines(): bool
    {
        return !empty($this->encodedPolylines);
    }

    /**
     * @return EncodedPolyline[]
     */
    public function getEncodedPolylines(): array
    {
        return $this->encodedPolylines;
    }

    /**
     * @param EncodedPolyline[] $encodedPolylines
     */
    public function setEncodedPolylines(array $encodedPolylines): void
    {
        foreach ($this->encodedPolylines as $encodedPolyline) {
            $this->removeEncodedPolyline($encodedPolyline);
        }

        $this->addEncodedPolylines($encodedPolylines);
    }

    /**
     * @param EncodedPolyline[] $encodedPolylines
     */
    public function addEncodedPolylines(array $encodedPolylines): void
    {
        foreach ($encodedPolylines as $encodedPolyline) {
            $this->addEncodedPolyline($encodedPolyline);
        }
    }

    public function hasEncodedPolyline(EncodedPolyline $encodedPolyline): bool
    {
        return in_array($encodedPolyline, $this->encodedPolylines, true);
    }

    public function addEncodedPolyline(EncodedPolyline $encodedPolyline): void
    {
        if (!$this->hasEncodedPolyline($encodedPolyline)) {
            $this->encodedPolylines[] = $encodedPolyline;
        }

        $this->addExtendable($encodedPolyline);
    }

    public function removeEncodedPolyline(EncodedPolyline $encodedPolyline): void
    {
        unset($this->encodedPolylines[array_search($encodedPolyline, $this->encodedPolylines, true)]);
        $this->encodedPolylines = empty($this->encodedPolylines) ? [] : array_values($this->encodedPolylines);
        $this->removeExtendable($encodedPolyline);
    }

    public function hasPolygons(): bool
    {
        return !empty($this->polygons);
    }

    /**
     * @return Polygon[]
     */
    public function getPolygons(): array
    {
        return $this->polygons;
    }

    /**
     * @param Polygon[] $polygons
     */
    public function setPolygons(array $polygons): void
    {
        foreach ($this->polygons as $polygon) {
            $this->removePolygon($polygon);
        }

        $this->addPolygons($polygons);
    }

    /**
     * @param Polygon[] $polygons
     */
    public function addPolygons(array $polygons): void
    {
        foreach ($polygons as $polygon) {
            $this->addPolygon($polygon);
        }
    }

    public function hasPolygon(Polygon $polygon): bool
    {
        return in_array($polygon, $this->polygons, true);
    }

    public function addPolygon(Polygon $polygon): void
    {
        if (!$this->hasPolygon($polygon)) {
            $this->polygons[] = $polygon;
        }

        $this->addExtendable($polygon);
    }

    public function removePolygon(Polygon $polygon): void
    {
        unset($this->polygons[array_search($polygon, $this->polygons, true)]);
        $this->polygons = empty($this->polygons) ? [] : array_values($this->polygons);
        $this->removeExtendable($polygon);
    }

    public function hasRectangles(): bool
    {
        return !empty($this->rectangles);
    }

    /**
     * @return Rectangle[]
     */
    public function getRectangles(): array
    {
        return $this->rectangles;
    }

    /**
     * @param Rectangle[] $rectangles
     */
    public function setRectangles(array $rectangles): void
    {
        foreach ($this->rectangles as $rectangle) {
            $this->removeRectangle($rectangle);
        }

        $this->addRectangles($rectangles);
    }

    /**
     * @param Rectangle[] $rectangles
     */
    public function addRectangles(array $rectangles): void
    {
        foreach ($rectangles as $rectangle) {
            $this->addRectangle($rectangle);
        }
    }

    public function hasRectangle(Rectangle $rectangle): bool
    {
        return in_array($rectangle, $this->rectangles, true);
    }

    public function addRectangle(Rectangle $rectangle): void
    {
        if (!$this->hasRectangle($rectangle)) {
            $this->rectangles[] = $rectangle;
        }

        $this->addExtendable($rectangle);
    }

    public function removeRectangle(Rectangle $rectangle): void
    {
        unset($this->rectangles[array_search($rectangle, $this->rectangles, true)]);
        $this->rectangles = empty($this->rectangles) ? [] : array_values($this->rectangles);
        $this->removeExtendable($rectangle);
    }

    public function hasCircles(): bool
    {
        return !empty($this->circles);
    }

    /**
     * @return Circle[]
     */
    public function getCircles(): array
    {
        return $this->circles;
    }

    /**
     * @param Circle[] $circles
     */
    public function setCircles(array $circles): void
    {
        foreach ($this->circles as $circle) {
            $this->removeCircle($circle);
        }

        $this->addCircles($circles);
    }

    /**
     * @param Circle[] $circles
     */
    public function addCircles(array $circles): void
    {
        foreach ($circles as $circle) {
            $this->addCircle($circle);
        }
    }

    public function hasCircle(Circle $circle): bool
    {
        return in_array($circle, $this->circles, true);
    }

    public function addCircle(Circle $circle): void
    {
        if (!$this->hasCircle($circle)) {
            $this->circles[] = $circle;
        }

        $this->addExtendable($circle);
    }

    public function removeCircle(Circle $circle): void
    {
        unset($this->circles[array_search($circle, $this->circles, true)]);
        $this->circles = empty($this->circles) ? [] : array_values($this->circles);
        $this->removeExtendable($circle);
    }

    public function hasGroundOverlays(): bool
    {
        return !empty($this->groundOverlays);
    }

    /**
     * @return GroundOverlay[]
     */
    public function getGroundOverlays(): array
    {
        return $this->groundOverlays;
    }

    /**
     * @param GroundOverlay[] $groundOverlays
     */
    public function setGroundOverlays(array $groundOverlays): void
    {
        foreach ($this->groundOverlays as $groundOverlay) {
            $this->removeGroundOverlay($groundOverlay);
        }

        $this->addGroundOverlays($groundOverlays);
    }

    /**
     * @param GroundOverlay[] $groundOverlays
     */
    public function addGroundOverlays(array $groundOverlays): void
    {
        foreach ($groundOverlays as $groundOverlay) {
            $this->addGroundOverlay($groundOverlay);
        }
    }

    public function hasGroundOverlay(GroundOverlay $groundOverlay): bool
    {
        return in_array($groundOverlay, $this->groundOverlays, true);
    }

    public function addGroundOverlay(GroundOverlay $groundOverlay): void
    {
        if (!$this->hasGroundOverlay($groundOverlay)) {
            $this->groundOverlays[] = $groundOverlay;
        }

        $this->addExtendable($groundOverlay);
    }

    public function removeGroundOverlay(GroundOverlay $groundOverlay): void
    {
        unset($this->groundOverlays[array_search($groundOverlay, $this->groundOverlays, true)]);
        $this->groundOverlays = empty($this->groundOverlays) ? [] : array_values($this->groundOverlays);
        $this->removeExtendable($groundOverlay);
    }

    private function addExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->addExtendable($extendable);
        }
    }

    private function removeExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    private function isAutoZoom(): bool
    {
        return $this->hasMap() && $this->getMap()->isAutoZoom();
    }
}
