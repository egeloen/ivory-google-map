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

use Exception;
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
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerClusterType;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Rectangle;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMapFunctionalTest extends AbstractApiFunctionalTest
{
    private MapHelper $mapHelper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapHelper = $this->createMapHelper();
    }

    /**
     * @param string|null $html
     */
    protected function renderMap(Map $map, $html = null)
    {
        $this->renderHtml(implode('', [$html, $this->mapHelper->render($map), $this->renderApi([$map])]));

        try {
            $this->waitUntil(function () use ($map) {
                try {
                    $this->assertObjectExists($map);

                    return true;
                } catch (Exception $e) {
                }
            }, 5000);
        } catch (Exception $e) {
        }

        $this->assertSame([], $this->log('browser'));
    }

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

    protected function assertMapHtml(Map $map)
    {
        $this->byId();
    }

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

    protected function assertDomEvent(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.dom_events', $event);
    }

    protected function assertDomEventOnce(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.dom_events_once', $event);
    }

    protected function assertEvent(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.events', $event);
    }

    protected function assertEventOnce(Map $map, Event $event)
    {
        $this->assertSameContainerVariable($map, 'events.events_once', $event);
    }

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

    protected function assertGeoJsonLayer(Map $map, GeoJsonLayer $geoJsonLayer)
    {
    }

    protected function assertHeatmapLayer(Map $map, HeatmapLayer $heatmapLayer)
    {
        $this->assertSameContainerVariable(
            $map,
            'layers.heatmap_layers',
            $heatmapLayer,
            $map->getVariable(),
            $this->getMapFormatter()
        );
    }

    protected function assertKmlLayer(Map $map, KmlLayer $kmlLayer)
    {
        $this->assertSameContainerVariable(
            $map,
            'layers.kml_layers',
            $kmlLayer,
            $map->getVariable(),
            $this->getMapFormatter()
        );
    }

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

    protected function assertCircle(Map $map, Circle $circle)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.circles',
            $circle,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        $this->assertCoordinate($map, $circle->getCenter());
        $this->assertSameVariable($circle->getRadius(), $circle->getVariable().'.getRadius()');
        $this->assertOptions($circle);
    }

    protected function assertEncodedPolyline(Map $map, EncodedPolyline $encodedPolyline)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.encoded_polylines',
            $encodedPolyline,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        $this->assertOptions($encodedPolyline);
    }

    protected function assertGroundOverlay(Map $map, GroundOverlay $groundOverlay)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.ground_overlays',
            $groundOverlay,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        $this->assertSameVariable('"'.$groundOverlay->getUrl().'"', $groundOverlay->getVariable().'.getUrl()');
        $this->assertBound($map, $groundOverlay->getBound(), $groundOverlay->getVariable().'.getBounds()');
        $this->assertOptions($groundOverlay);
    }

    protected function assertInfoWindow(Map $map, InfoWindow $infoWindow)
    {
        $this->assertSameContainerVariable(
            $map,
            $infoWindow->getType() === InfoWindowType::INFO_BOX ? 'overlays.info_boxes' : 'overlays.info_windows',
            $infoWindow,
            $infoWindow->getPosition() !== null ? $map->getVariable() : null,
            $this->getMapFormatter()
        );

        $this->assertSameVariable('"'.$infoWindow->getContent().'"', $infoWindow->getVariable().'.getContent()');

        if ($infoWindow->hasPosition()) {
            $this->assertCoordinate($map, $infoWindow->getPosition(), $infoWindow->getVariable().'.getPosition()');
        }

        if ($infoWindow->hasPixelOffset() && $infoWindow->getType() !== InfoWindowType::INFO_BOX) {
            $this->assertSize($map, $infoWindow->getPixelOffset(), $infoWindow->getVariable().'.pixelOffset');
        }

        if ($infoWindow->isOpen()) {
            $this->assertSameObject($map->getVariable(), $infoWindow, $this->getMapFormatter());
        }

        $this->assertOptions($infoWindow);
    }

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
            $this->getMapFormatter()
        );

        $this->assertCoordinate($map, $marker->getPosition(), $marker->getVariable().'.getPosition()');

        if ($marker->hasAnimation()) {
            $this->assertSameVariable(
                'google.maps.Animation.'.strtoupper($marker->getAnimation()),
                $marker->getVariable().'.getAnimation()'
            );
        }

        if ($marker->hasIcon()) {
            $this->assertIcon($map, $marker->getIcon(), $marker->getVariable().'.getIcon()');
        }

        if ($marker->hasSymbol()) {
            $this->assertSymbol($map, $marker->getSymbol(), $marker->getVariable().'.getIcon()');
        }

        if ($marker->hasShape()) {
            $this->assertMarkerShape($map, $marker->getShape(), $marker->getVariable().'.getShape()');
        }

        if ($marker->hasInfoWindow()) {
            $this->assertInfoWindow($map, $marker->getInfoWindow());
        }

        $this->assertOptions($marker);
    }

    /**
     * @param string $expected
     */
    protected function assertIcon(Map $map, Icon $icon, $expected)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.icons',
            $icon,
            $expected,
            $this->getJsonFormatter()
        );

        $this->assertSameVariable('"'.$icon->getUrl().'"', $icon->getVariable().'.url');

        if ($icon->hasAnchor()) {
            $this->assertPoint($map, $icon->getAnchor(), $icon->getVariable().'.anchor');
        }

        if ($icon->hasOrigin()) {
            $this->assertPoint($map, $icon->getOrigin(), $icon->getVariable().'.origin');
        }

        if ($icon->hasScaledSize()) {
            $this->assertSize($map, $icon->getScaledSize(), $icon->getVariable().'.scaledSize');
        }

        if ($icon->hasSize()) {
            $this->assertSize($map, $icon->getSize(), $icon->getVariable().'.size');
        }
    }

    /**
     * @param string       $expected
     */
    protected function assertIconSequence(Map $map, IconSequence $iconSequence, $expected)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.icon_sequences',
            $iconSequence,
            $expected,
            $this->getJsonFormatter()
        );

        $this->assertSymbol($map, $iconSequence->getSymbol(), $iconSequence->getVariable().'.icon');
        $this->assertOptions($iconSequence);
    }

    /**
     * @param string      $expected
     */
    protected function assertMarkerShape(Map $map, MarkerShape $markerShape, $expected)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.marker_shapes',
            $markerShape,
            $expected,
            $this->getJsonFormatter()
        );

        $this->assertSameVariable('"'.$markerShape->getType().'"', $markerShape->getVariable().'.type');
        $this->assertSameVariable(
            json_encode($markerShape->getCoordinates(), JSON_THROW_ON_ERROR).'.toString()',
            $markerShape->getVariable().'.coords.toString()'
        );
    }

    protected function assertPolygon(Map $map, Polygon $polygon)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.polygons',
            $polygon,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        foreach ($polygon->getCoordinates() as $coordinate) {
            $this->assertCoordinate($map, $coordinate);
        }

        $this->assertOptions($polygon);
    }

    protected function assertPolyline(Map $map, Polyline $polyline)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.polylines',
            $polyline,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        foreach ($polyline->getCoordinates() as $coordinate) {
            $this->assertCoordinate($map, $coordinate);
        }

        foreach ($polyline->getIconSequences() as $iconSequence) {
            $this->assertIconSequence($map, $iconSequence, $polyline->getVariable().'.icons');
        }

        $this->assertOptions($polyline);
    }

    protected function assertRectangle(Map $map, Rectangle $rectangle)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.rectangles',
            $rectangle,
            $map->getVariable(),
            $this->getMapFormatter()
        );

        $this->assertBound($map, $rectangle->getBound(), $rectangle->getVariable().'.getBounds()');
        $this->assertOptions($rectangle);
    }

    /**
     * @param string $expected
     */
    protected function assertSymbol(Map $map, Symbol $symbol, $expected)
    {
        $this->assertSameContainerVariable(
            $map,
            'overlays.symbols',
            $symbol,
            $expected,
            $this->getJsonFormatter()
        );

        $symbolPaths = [
            SymbolPath::CIRCLE                => 0,
            SymbolPath::FORWARD_CLOSED_ARROW  => 1,
            SymbolPath::FORWARD_OPEN_ARROW    => 2,
            SymbolPath::BACKWARD_CLOSED_ARROW => 3,
            SymbolPath::BACKWARD_OPEN_ARROW   => 4,
        ];

        $this->assertSameVariable(
            isset($symbolPaths[$path = $symbol->getPath()]) ? $symbolPaths[$path] : $path,
            $symbol->getVariable().'.path'
        );

        if ($symbol->hasAnchor()) {
            $this->assertPoint($map, $symbol->getAnchor(), $symbol->getVariable().'.anchor');
        }

        if ($symbol->hasLabelOrigin()) {
            $this->assertPoint($map, $symbol->getLabelOrigin(), $symbol->getVariable().'.labelOrigin');
        }

        $this->assertOptions($symbol);
    }

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
    private function getMapFormatter()
    {
        return fn($expected, $variable, $formatter) => call_user_func($formatter, $expected, $variable.'.getMap()', $formatter);
    }

    /**
     * @return callable
     */
    private function getJsonFormatter()
    {
        return fn($expected, $variable, $formatter) => call_user_func($formatter, $expected.'.toString()', $variable.'.toString()');
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
            $overlays.'.icons',
            $overlays.'.symbols',
            $overlays.'.icon_sequences',
            $overlays.'.circles',
            $overlays.'.encoded_polylines',
            $overlays.'.ground_overlays',
            $overlays.'.polygons',
            $overlays.'.polylines',
            $overlays.'.rectangles',
            $overlays.'.info_windows',
            $overlays.'.info_boxes',
            $overlays.'.marker_shapes',
            $overlays.'.markers',
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
