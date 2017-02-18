<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Collector\Base\BoundCollector;
use Ivory\GoogleMap\Helper\Collector\Base\CoordinateCollector;
use Ivory\GoogleMap\Helper\Collector\Base\PointCollector;
use Ivory\GoogleMap\Helper\Collector\Base\SizeCollector;
use Ivory\GoogleMap\Helper\Collector\Control\CustomControlCollector;
use Ivory\GoogleMap\Helper\Collector\Event\DomEventCollector;
use Ivory\GoogleMap\Helper\Collector\Event\DomEventOnceCollector;
use Ivory\GoogleMap\Helper\Collector\Event\EventCollector;
use Ivory\GoogleMap\Helper\Collector\Event\EventOnceCollector;
use Ivory\GoogleMap\Helper\Collector\Layer\GeoJsonLayerCollector;
use Ivory\GoogleMap\Helper\Collector\Layer\HeatmapLayerCollector;
use Ivory\GoogleMap\Helper\Collector\Layer\KmlLayerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\CircleCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\DefaultInfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\EncodedPolylineCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\ExtendableCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\IconSequenceCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoBoxCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerShapeCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolygonCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\SymbolCollector;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\Renderer\Base\BoundRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\SizeRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlManagerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\CustomControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\FullscreenControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\MapTypeControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\RotateControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ScaleControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\StreetViewControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ZoomControlStyleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventOnceRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\EventOnceRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\EventRenderer;
use Ivory\GoogleMap\Helper\Renderer\Geometry\EncodingRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Layer\GeoJsonLayerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Layer\HeatmapLayerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Layer\KmlLayerRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapBoundRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapCenterRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapContainerRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapHtmlRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AnimationRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\CircleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\DefaultInfoWindowRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\BoundsExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\DefaultViewportExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\ExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\HeatmapLayerExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\PathExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\PositionExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\GroundOverlayRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconSequenceRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoBoxRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowCloseRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerClustererRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerShapeRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolygonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\PolylineRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\RectangleRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolPathRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\ObjectToArrayRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Helper\Subscriber\Base\BaseSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Base\BoundSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Base\CoordinateSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Base\PointSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Base\SizeSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Control\ControlSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Control\CustomControlSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Event\DomEventOnceSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Event\DomEventSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Event\EventOnceSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Event\EventSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Event\SimpleEventSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Layer\GeoJsonLayerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Layer\HeatmapLayerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Layer\KmlLayerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Layer\LayerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapBoundSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapCenterSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapContainerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapHtmlSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapInitSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapJavascriptSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapStylesheetSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\MapSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\CircleSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\DefaultInfoWindowSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\EncodedPolylineSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\ExtendableSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\GroundOverlaySubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\IconSequenceSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\IconSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\InfoBoxSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\InfoWindowCloseSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\InfoWindowOpenSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\MarkerClustererSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\MarkerInfoWindowOpenSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\MarkerShapeSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\MarkerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\OverlaySubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\PolygonSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\PolylineSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\RectangleSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Overlay\SymbolSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Utility\ObjectToArraySubscriber;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperBuilder extends AbstractJavascriptHelperBuilder
{
    /**
     * @return MapHelper
     */
    public function build()
    {
        return new MapHelper($this->createEventDispatcher());
    }

    /**
     * {@inheritdoc}
     */
    protected function createSubscribers()
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        // Overlay collectors
        $markerCollector = new MarkerCollector();
        $polylineCollector = new PolylineCollector();
        $circleCollector = new CircleCollector();
        $defaultInfoWindowCollector = new DefaultInfoWindowCollector($markerCollector);
        $encodedPolylineCollector = new EncodedPolylineCollector();
        $extendableCollector = new ExtendableCollector();
        $groundOverlayCollector = new GroundOverlayCollector();
        $iconSequenceCollector = new IconSequenceCollector($polylineCollector);
        $infoBoxCollector = new InfoBoxCollector($markerCollector);
        $infoWindowCollector = new InfoWindowCollector($markerCollector);
        $iconCollector = new IconCollector($markerCollector);
        $markerShapeCollector = new MarkerShapeCollector($markerCollector);
        $polygonCollector = new PolygonCollector();
        $rectangleCollector = new RectangleCollector();
        $symbolCollector = new SymbolCollector($markerCollector, $iconSequenceCollector);

        // Layer collectors
        $geoJsonLayerCollector = new GeoJsonLayerCollector();
        $heatmapLayerCollector = new HeatmapLayerCollector();
        $kmlLayerCollector = new KmlLayerCollector();

        // Event collectors
        $domEventCollector = new DomEventCollector();
        $domEventOnceCollector = new DomEventOnceCollector();
        $eventCollector = new EventCollector();
        $eventOnceCollector = new EventOnceCollector();

        // Control collectors
        $customControlCollector = new CustomControlCollector();

        // Base collectors
        $boundCollector = new BoundCollector($groundOverlayCollector, $rectangleCollector);
        $pointCollector = new PointCollector($markerCollector);
        $sizeCollector = new SizeCollector($infoWindowCollector, $iconCollector);
        $coordinateCollector = new CoordinateCollector(
            $boundCollector,
            $circleCollector,
            $infoWindowCollector,
            $markerCollector,
            $polygonCollector,
            $polylineCollector,
            $heatmapLayerCollector
        );

        // Base renderers
        $boundRenderer = new BoundRenderer($formatter);
        $coordinateRenderer = new CoordinateRenderer($formatter);
        $mapTypeIdRenderer = new MapTypeIdRenderer($formatter);
        $pointRenderer = new PointRenderer($formatter);
        $sizeRenderer = new SizeRenderer($formatter);

        // Control renderers
        $controlPositionRenderer = new ControlPositionRenderer($formatter);
        $customControlRenderer = new CustomControlRenderer($formatter, $controlPositionRenderer);
        $fullscreenControlRenderer = new FullscreenControlRenderer($formatter, $jsonBuilder, $controlPositionRenderer);
        $mapTypeControlStyleRenderer = new MapTypeControlStyleRenderer($formatter);
        $rotateControlRenderer = new RotateControlRenderer($formatter, $jsonBuilder, $controlPositionRenderer);
        $scaleControlStyleRenderer = new ScaleControlStyleRenderer($formatter);
        $streetViewControlRenderer = new StreetViewControlRenderer($formatter, $jsonBuilder, $controlPositionRenderer);
        $zoomControlStyleRenderer = new ZoomControlStyleRenderer($formatter);

        $mapTypeControlRenderer = new MapTypeControlRenderer(
            $formatter,
            $jsonBuilder,
            $mapTypeIdRenderer,
            $controlPositionRenderer,
            $mapTypeControlStyleRenderer
        );

        $scaleControlRenderer = new ScaleControlRenderer(
            $formatter,
            $jsonBuilder,
            $controlPositionRenderer,
            $scaleControlStyleRenderer
        );

        $zoomControlRenderer = new ZoomControlRenderer(
            $formatter,
            $jsonBuilder,
            $controlPositionRenderer,
            $zoomControlStyleRenderer
        );

        $controlManagerRenderer = new ControlManagerRenderer();
        $controlManagerRenderer->addRenderer($fullscreenControlRenderer);
        $controlManagerRenderer->addRenderer($mapTypeControlRenderer);
        $controlManagerRenderer->addRenderer($rotateControlRenderer);
        $controlManagerRenderer->addRenderer($scaleControlRenderer);
        $controlManagerRenderer->addRenderer($streetViewControlRenderer);
        $controlManagerRenderer->addRenderer($zoomControlRenderer);

        // Event renderers
        $domEventOnceRenderer = new DomEventOnceRenderer($formatter);
        $domEventRenderer = new DomEventRenderer($formatter);
        $eventOnceRenderer = new EventOnceRenderer($formatter);
        $eventRenderer = new EventRenderer($formatter);

        // Geometry renderers
        $encodingRenderer = new EncodingRenderer($formatter);

        // Html renderers
        $tagRenderer = new TagRenderer($formatter);
        $javascriptTagRenderer = new JavascriptTagRenderer($formatter, $tagRenderer);
        $stylesheetRenderer = new StylesheetRenderer($formatter);
        $stylesheetTagRenderer = new StylesheetTagRenderer($formatter, $tagRenderer, $stylesheetRenderer);

        // Utility
        $callbackRenderer = new CallbackRenderer($formatter);
        $objectToArrayRenderer = new ObjectToArrayRenderer($formatter);
        $requirementRenderer = new RequirementRenderer($formatter);

        // Map renderers
        $mapBoundRenderer = new MapBoundRenderer($formatter);
        $mapCenterRenderer = new MapCenterRenderer($formatter);
        $mapContainerRenderer = new MapContainerRenderer($formatter, $jsonBuilder);
        $mapHtmlRenderer = new MapHtmlRenderer($formatter, $tagRenderer, $stylesheetRenderer);
        $mapRenderer = new MapRenderer(
            $formatter,
            $jsonBuilder,
            $mapTypeIdRenderer,
            $controlManagerRenderer,
            $requirementRenderer
        );

        // Overlay renderers
        $animationRenderer = new AnimationRenderer($formatter);
        $circleRenderer = new CircleRenderer($formatter, $jsonBuilder);
        $defaultInfoWindowRenderer = new DefaultInfoWindowRenderer($formatter, $jsonBuilder);
        $encodedPolylineRenderer = new EncodedPolylineRenderer($formatter, $jsonBuilder, $encodingRenderer);
        $groundOverlayRenderer = new GroundOverlayRenderer($formatter, $jsonBuilder);
        $infoBoxRenderer = new InfoBoxRenderer($formatter, $jsonBuilder, $requirementRenderer);
        $infoWindowCloseRenderer = new InfoWindowCloseRenderer($formatter);
        $infoWindowOpenRenderer = new InfoWindowOpenRenderer($formatter);
        $iconRenderer = new IconRenderer($formatter, $jsonBuilder);
        $iconSequenceRenderer = new IconSequenceRenderer($formatter, $jsonBuilder);
        $markerClustererRenderer = new MarkerClustererRenderer($formatter, $jsonBuilder, $requirementRenderer);
        $markerRenderer = new MarkerRenderer($formatter, $jsonBuilder, $animationRenderer);
        $markerShapeRenderer = new MarkerShapeRenderer($formatter, $jsonBuilder);
        $polygonRenderer = new PolygonRenderer($formatter, $jsonBuilder);
        $polylineRenderer = new PolylineRenderer($formatter, $jsonBuilder);
        $rectangleRenderer = new RectangleRenderer($formatter, $jsonBuilder);
        $symbolPathRenderer = new SymbolPathRenderer($formatter);
        $symbolRenderer = new SymbolRenderer($formatter, $jsonBuilder, $symbolPathRenderer);

        // Extendable renderers
        $defaultViewportExtendableRenderer = new DefaultViewportExtendableRenderer($formatter);
        $heatmapLayerExtendableRenderer = new HeatmapLayerExtendableRenderer($formatter);
        $pathExtendableRenderer = new PathExtendableRenderer($formatter);
        $positionExtendableRenderer = new PositionExtendableRenderer($formatter);
        $boundsExtendableRenderer = new BoundsExtendableRenderer($formatter);

        $extendableRenderer = new ExtendableRenderer();
        $extendableRenderer->setRenderer(Circle::class, $boundsExtendableRenderer);
        $extendableRenderer->setRenderer(EncodedPolyline::class, $pathExtendableRenderer);
        $extendableRenderer->setRenderer(GroundOverlay::class, $boundsExtendableRenderer);
        $extendableRenderer->setRenderer(HeatmapLayer::class, $heatmapLayerExtendableRenderer);
        $extendableRenderer->setRenderer(InfoWindow::class, $positionExtendableRenderer);
        $extendableRenderer->setRenderer(KmlLayer::class, $defaultViewportExtendableRenderer);
        $extendableRenderer->setRenderer(Marker::class, $positionExtendableRenderer);
        $extendableRenderer->setRenderer(Polyline::class, $pathExtendableRenderer);
        $extendableRenderer->setRenderer(Polygon::class, $pathExtendableRenderer);
        $extendableRenderer->setRenderer(Rectangle::class, $boundsExtendableRenderer);

        // Layer renderers
        $geoJsonLayerRenderer = new GeoJsonLayerRenderer($formatter, $jsonBuilder);
        $heatmapLayerRenderer = new HeatmapLayerRenderer($formatter, $jsonBuilder);
        $kmlLayerRenderer = new KmlLayerRenderer($formatter, $jsonBuilder);

        return array_merge([
            // Base
            new BaseSubscriber($formatter),
            new BoundSubscriber($formatter, $boundCollector, $boundRenderer),
            new CoordinateSubscriber($formatter, $coordinateCollector, $coordinateRenderer),
            new PointSubscriber($formatter, $pointCollector, $pointRenderer),
            new SizeSubscriber($formatter, $sizeCollector, $sizeRenderer),

            // Control
            new ControlSubscriber($formatter),
            new CustomControlSubscriber($formatter, $customControlCollector, $customControlRenderer),

            // Event
            new DomEventOnceSubscriber($formatter, $domEventOnceCollector, $domEventOnceRenderer),
            new DomEventSubscriber($formatter, $domEventCollector, $domEventRenderer),
            new EventOnceSubscriber($formatter, $eventOnceCollector, $eventOnceRenderer),
            new EventSubscriber($formatter),
            new SimpleEventSubscriber($formatter, $eventCollector, $eventRenderer),

            // Layer
            new GeoJsonLayerSubscriber($formatter, $geoJsonLayerCollector, $geoJsonLayerRenderer),
            new HeatmapLayerSubscriber($formatter, $heatmapLayerCollector, $heatmapLayerRenderer),
            new KmlLayerSubscriber($formatter, $kmlLayerCollector, $kmlLayerRenderer),
            new LayerSubscriber($formatter),

            // Overlay
            new CircleSubscriber($formatter, $circleCollector, $circleRenderer),
            new DefaultInfoWindowSubscriber($formatter, $defaultInfoWindowCollector, $defaultInfoWindowRenderer),
            new EncodedPolylineSubscriber($formatter, $encodedPolylineCollector, $encodedPolylineRenderer),
            new ExtendableSubscriber($formatter, $extendableCollector, $extendableRenderer),
            new GroundOverlaySubscriber($formatter, $groundOverlayCollector, $groundOverlayRenderer),
            new IconSequenceSubscriber($formatter, $iconSequenceCollector, $iconSequenceRenderer),
            new IconSubscriber($formatter, $iconCollector, $iconRenderer),
            new InfoBoxSubscriber($formatter, $infoBoxCollector, $infoBoxRenderer),
            new InfoWindowCloseSubscriber($formatter, $infoWindowCollector, $infoWindowCloseRenderer),
            new InfoWindowOpenSubscriber($formatter, $infoWindowCollector, $infoWindowOpenRenderer),
            new MarkerClustererSubscriber($formatter, $markerClustererRenderer),
            new MarkerInfoWindowOpenSubscriber($formatter, $markerCollector, $infoWindowOpenRenderer, $eventRenderer),
            new MarkerShapeSubscriber($formatter, $markerShapeCollector, $markerShapeRenderer),
            new MarkerSubscriber($formatter, $markerCollector, $markerRenderer),
            new OverlaySubscriber($formatter),
            new PolygonSubscriber($formatter, $polygonCollector, $polygonRenderer),
            new PolylineSubscriber($formatter, $polylineCollector, $polylineRenderer),
            new RectangleSubscriber($formatter, $rectangleCollector, $rectangleRenderer),
            new SymbolSubscriber($formatter, $symbolCollector, $symbolRenderer),

            // Map
            new MapBoundSubscriber($formatter, $mapBoundRenderer),
            new MapCenterSubscriber($formatter, $mapCenterRenderer),
            new MapContainerSubscriber($formatter, $mapContainerRenderer),
            new MapHtmlSubscriber($formatter, $mapHtmlRenderer),
            new MapInitSubscriber($formatter),
            new MapJavascriptSubscriber($formatter, $mapRenderer, $callbackRenderer, $javascriptTagRenderer),
            new MapStylesheetSubscriber($formatter, $stylesheetTagRenderer),
            new MapSubscriber($formatter, $mapRenderer),

            // Utility
            new ObjectToArraySubscriber($formatter, $objectToArrayRenderer),
        ], parent::createSubscribers());
    }
}
