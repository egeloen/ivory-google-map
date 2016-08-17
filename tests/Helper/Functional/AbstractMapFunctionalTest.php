<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerClusterType;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMapFunctionalTest extends AbstractApiFunctionalTest
{
    /**
     * @var MapHelper
     */
    private $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mapHelper = $this->createMapHelper();
    }

    /**
     * @param Map         $map
     * @param string|null $html
     */
    protected function renderMap(Map $map, $html = null)
    {
        $this->renderHtml(implode('', [$html, $this->mapHelper->render($map), $this->renderApi([$map])]));

        $this->waitUntil(function () use ($map) {
            try {
                $this->assertObjectExists($map);

                return true;
            } catch (\Exception $e) {
            }
        }, 5000);
    }

    /**
     * @param Map $map
     */
    protected function assertMap(Map $map)
    {
        $this->assertContainer($map);
        $this->assertEventManager($map, $map->getEventManager());
        $this->assertLayerManager($map, $map->getLayerManager());
        $this->assertOverlayManager($map, $map->getOverlayManager());

        $layerManager = $map->getLayerManager();

        if ($layerManager->hasGeoJsonLayers() || $layerManager->hasHeatmapLayers() || $layerManager->hasKmlLayers()) {
            return;
        }

        if ($map->isAutoZoom()) {
            $this->assertBound($map, $map->getBound(), $map->getVariable().'.getBounds()');
        } else {
            $this->assertCoordinate($map, $map->getCenter(), $map->getVariable().'.getCenter()');
        }
    }

    /**
     * @param Map $map
     */
    protected function assertMapHtml(Map $map)
    {
        $this->byId($map->getHtmlId());
    }

    /**
     * @param Map          $map
     * @param EventManager $eventManager
     */
    protected function assertEventManager(Map $map, EventManager $eventManager)
    {
        foreach ($eventManager->getDomEvents() as $domEvent) {
            $this->assertDomEvent($map, $domEvent);
        }

        foreach ($eventManager->getDomEventsOnce() as $domEventOnce) {
            $this->assertDomEventOnce($map, $domEventOnce);
        }

        foreach ($eventManager->getEvents() as $event) {
            $this->assertEvent($map, $event);
        }

        foreach ($eventManager->getEventsOnce() as $eventOnce) {
            $this->assertEventOnce($map, $eventOnce);
        }
    }

    /**
     * @param Map   $map
     * @param Event $event
     */
    protected function assertDomEvent(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.dom_events', $event);
    }

    /**
     * @param Map   $map
     * @param Event $event
     */
    protected function assertDomEventOnce(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.dom_events_once', $event);
    }

    /**
     * @param Map   $map
     * @param Event $event
     */
    protected function assertEvent(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.events', $event);
    }

    /**
     * @param Map   $map
     * @param Event $event
     */
    protected function assertEventOnce(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.events_once', $event);
    }

    /**
     * @param Map          $map
     * @param LayerManager $layerManager
     */
    public function assertLayerManager(Map $map, LayerManager $layerManager)
    {
        foreach ($layerManager->getGeoJsonLayers() as $geoJsonLayer) {
            $this->assertGeoJsonLayer($map, $geoJsonLayer);
        }

        foreach ($layerManager->getHeatmapLayers() as $heatmapLayer) {
            $this->assertHeatmapLayer($map, $heatmapLayer);
        }

        foreach ($layerManager->getKmlLayers() as $kmlLayer) {
            $this->assertKmlLayer($map, $kmlLayer);
        }
    }

    /**
     * @param Map          $map
     * @param GeoJsonLayer $geoJsonLayer
     */
    protected function assertGeoJsonLayer(Map $map, GeoJsonLayer $geoJsonLayer)
    {
    }

    /**
     * @param Map          $map
     * @param HeatmapLayer $heatmapLayer
     */
    protected function assertHeatmapLayer(Map $map, HeatmapLayer $heatmapLayer)
    {
        $this->assertSameContainerVariable(
            $map,
            'layers.heatmap_layers',
            $heatmapLayer,
            $map->getVariable(),
            $this->getFormatter()
        );
    }

    /**
     * @param Map      $map
     * @param KmlLayer $kmlLayer
     */
    protected function assertKmlLayer(Map $map, KmlLayer $kmlLayer)
    {
        $this->assertSameContainerVariable(
            $map,
            'layers.kml_layers',
            $kmlLayer,
            $map->getVariable(),
            $this->getFormatter()
        );
    }

    /**
     * @param Map            $map
     * @param OverlayManager $overlayManager
     */
    protected function assertOverlayManager(Map $map, OverlayManager $overlayManager)
    {
        foreach ($overlayManager->getCircles() as $circle) {
            $this->assertCircle($map, $circle);
        }

        foreach ($overlayManager->getEncodedPolylines() as $encodedPolyline) {
            $this->assertEncodedPolyline($map, $encodedPolyline);
        }

        foreach ($overlayManager->getGroundOverlays() as $groundOverlay) {
            $this->assertGroundOverlay($map, $groundOverlay);
        }

        foreach ($overlayManager->getInfoWindows() as $infoWindow) {
            $this->assertInfoWindow($map, $infoWindow);
        }

        foreach ($overlayManager->getMarkers() as $marker) {
            $this->assertMarker($map, $marker);
        }

        foreach ($overlayManager->getPolygons() as $polygon) {
            $this->assertPolygon($map, $polygon);
        }

        foreach ($overlayManager->getPolylines() as $polyline) {
            $this->assertPolyline($map, $polyline);
        }

        foreach ($overlayManager->getRectangles() as $rectangle) {
            $this->assertRectangle($map, $rectangle);
        }
    }

    /**
     * @param Map    $map
     * @param Circle $circle
     */
    protected function assertCircle(Map $map, Circle $circle)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.circles',
            $circle,
            $map->getVariable(),
            $this->getFormatter()
        );

        $this->assertCoordinate($map, $circle->getCenter());
        $this->assertSameVariable($circle->getRadius(), $circle->getVariable().'.getRadius()');
    }

    /**
     * @param Map             $map
     * @param EncodedPolyline $encodedPolyline
     */
    protected function assertEncodedPolyline(Map $map, EncodedPolyline $encodedPolyline)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.encoded_polylines',
            $encodedPolyline,
            $map->getVariable(),
            $this->getFormatter()
        );
    }

    /**
     * @param Map           $map
     * @param GroundOverlay $groundOverlay
     */
    protected function assertGroundOverlay(Map $map, GroundOverlay $groundOverlay)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.ground_overlays',
            $groundOverlay,
            $map->getVariable(),
            $this->getFormatter()
        );

        $this->assertSameVariable('"'.$groundOverlay->getUrl().'"', $groundOverlay->getVariable().'.getUrl()');
        $this->assertBound($map, $groundOverlay->getBound(), $groundOverlay->getVariable().'.getBounds()');
    }

    /**
     * @param Map        $map
     * @param InfoWindow $infoWindow
     */
    protected function assertInfoWindow(Map $map, InfoWindow $infoWindow)
    {
        $this->assertSameContainerVariable(
            $map,
            $infoWindow->getType() === InfoWindowType::INFO_BOX ? 'overlays.info_boxes' : 'overlays.info_windows',
            $infoWindow,
            $infoWindow->getPosition() !== null ? $map->getVariable() : null,
            $this->getFormatter()
        );

        $this->assertSameVariable('"'.$infoWindow->getContent().'"', $infoWindow->getVariable().'.getContent()');

        if ($infoWindow->hasPosition()) {
            $this->assertCoordinate($map, $infoWindow->getPosition(), $infoWindow->getVariable().'.getPosition()');
        }

        if ($infoWindow->hasPixelOffset() && $infoWindow->getType() !== InfoWindowType::INFO_BOX) {
            $this->assertSize($map, $infoWindow->getPixelOffset(), $infoWindow->getVariable().'.pixelOffset');
        }

        if ($infoWindow->isOpen()) {
            $this->assertSameObject($map->getVariable(), $infoWindow, $this->getFormatter());
        }
    }

    /**
     * @param Map    $map
     * @param Marker $marker
     */
    protected function assertMarker(Map $map, Marker $marker)
    {
        $variable = $map->getOverlayManager()->getMarkerCluster()->getType() !== MarkerClusterType::MARKER_CLUSTERER
            ? $map->getVariable()
            : null;

        $this->assertSameContainerVariable(
            $map,
            'overlays.markers',
            $marker,
            $variable,
            $this->getFormatter()
        );

        $this->assertCoordinate($map, $marker->getPosition(), $marker->getVariable().'.getPosition()');

        if ($marker->hasAnimation()) {
            $this->assertSameVariable(
                'google.maps.Animation.'.strtoupper($marker->getAnimation()),
                $marker->getVariable().'.getAnimation()'
            );
        }

        if ($marker->hasIcon()) {
            $this->assertIcon($map, $marker, $marker->getIcon());
        }

        if ($marker->hasShape()) {
            $this->assertMarkerShape($map, $marker, $marker->getShape());
        }

        if ($marker->hasInfoWindow()) {
            $this->assertInfoWindow($map, $marker->getInfoWindow());
        }
    }

    /**
     * @param Map    $map
     * @param Marker $marker
     * @param Icon   $icon
     */
    protected function assertIcon(Map $map, Marker $marker, Icon $icon)
    {
        $variable = $marker->getVariable().'.getIcon()';

        $this->assertSameVariable('"'.$icon->getUrl().'"', $variable.'.url');

        if ($icon->hasAnchor()) {
            $this->assertPoint($map, $icon->getAnchor(), $variable.'.anchor');
        }

        if ($icon->hasOrigin()) {
            $this->assertPoint($map, $icon->getOrigin(), $variable.'.origin');
        }

        if ($icon->hasScaledSize()) {
            $this->assertSize($map, $icon->getScaledSize(), $variable.'.scaledSize');
        }

        if ($icon->hasSize()) {
            $this->assertSize($map, $icon->getSize(), $variable.'.size');
        }
    }

    /**
     * @param Map         $map
     * @param Marker      $marker
     * @param MarkerShape $markerShape
     */
    protected function assertMarkerShape(Map $map, Marker $marker, MarkerShape $markerShape)
    {
        $variable = $marker->getVariable().'.getShape()';

        $this->assertSameVariable('"'.$markerShape->getType().'"', $variable.'.type');
        $this->assertSameVariable(
            json_encode($markerShape->getCoordinates()).'.toString()',
            $variable.'.coords.toString()'
        );
    }

    /**
     * @param Map     $map
     * @param Polygon $polygon
     */
    protected function assertPolygon(Map $map, Polygon $polygon)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.polygons',
            $polygon,
            $map->getVariable(),
            $this->getFormatter()
        );

        foreach ($polygon->getCoordinates() as $coordinate) {
            $this->assertCoordinate($map, $coordinate);
        }
    }

    /**
     * @param Map      $map
     * @param Polyline $polyline
     */
    protected function assertPolyline(Map $map, Polyline $polyline)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.polylines',
            $polyline,
            $map->getVariable(),
            $this->getFormatter()
        );

        foreach ($polyline->getCoordinates() as $coordinate) {
            $this->assertCoordinate($map, $coordinate);
        }
    }

    /**
     * @param Map       $map
     * @param Rectangle $rectangle
     */
    protected function assertRectangle(Map $map, Rectangle $rectangle)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.rectangles',
            $rectangle,
            $map->getVariable(),
            $this->getFormatter()
        );

        $this->assertBound($map, $rectangle->getBound(), $rectangle->getVariable().'.getBounds()');
    }

    /**
     * @param Map $map
     */
    protected function assertContainer(Map $map)
    {
        foreach ($this->getContainerPropertyPaths() as $propertyPath) {
            $this->assertContainerVariableExists($map, $propertyPath);
        }

        $this->assertSameContainerVariable($map, 'map');
    }

    /**
     * @return MapHelper
     */
    protected function createMapHelper()
    {
        return MapHelperBuilder::create()->build();
    }

    /**
     * @return callable
     */
    private function getFormatter()
    {
        return function ($expected, $variable, $formatter) {
            return call_user_func($formatter, $expected, $variable.'.getMap()', $formatter);
        };
    }

    /**
     * @return string[]
     */
    private function getContainerPropertyPaths()
    {
        return [
            null,
            $base = 'base',
            $base.'.coordinates',
            $base.'.bounds',
            $base.'.points',
            $base.'.sizes',
            'map',
            $overlays = 'overlays',
            $overlays.'.circles',
            $overlays.'.encoded_polylines',
            $overlays.'.ground_overlays',
            $overlays.'.polygons',
            $overlays.'.polylines',
            $overlays.'.rectangles',
            $overlays.'.info_windows',
            $overlays.'.info_boxes',
            $overlays.'.marker_images',
            $overlays.'.marker_cluster',
            $layers = 'layers',
            $layers.'.kml_layers',
            $events = 'events',
            $events.'.dom_events',
            $events.'.dom_events_once',
            $events.'.events',
            $events.'.events_once',
            $functions = 'functions',
            $functions.'.info_windows_close',
            $functions.'.to_array',
        ];
    }
}
