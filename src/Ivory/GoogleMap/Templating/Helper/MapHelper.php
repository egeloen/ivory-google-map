<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper;

use Ivory\GoogleMap\Events\Event,
    Ivory\GoogleMap\Map,
    Ivory\GoogleMap\Overlays\Marker,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper,
    Ivory\GoogleMap\Templating\Helper\Base\BoundHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper,
    Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper,
    Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper,
    Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper,
    Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper,
    Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper;

/**
 * Map helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper
{
    /** @var boolean */
    protected $loaded;

    /** @var \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper */
    protected $boundHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper */
    protected $mapTypeIdHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper */
    protected $mapTypeControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper */
    protected $overviewMapControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper */
    protected $panControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper */
    protected $rotateControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper */
    protected $scaleControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper */
    protected $streetViewControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper */
    protected $zoomControlHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper */
    protected $markerHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper */
    protected $infoWindowHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper */
    protected $polylineHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper */
    protected $encodedPolylineHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper */
    protected $polygonHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper */
    protected $rectangleHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper */
    protected $circleHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper */
    protected $groundOverlayHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper */
    protected $kmlLayerHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper */
    protected $eventManagerHelper;

    /**
     * Creates a map helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper             $coordinateHelper         The coordinate helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper                  $boundHelper              The bound helper.
     * @param \Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper                   $mapTypeIdHelper          The map type id helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper     $mapTypeControlHelper     The map type control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper $overviewMapControlHelper The overview map control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper         $panControlHelper         The pan control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper      $rotateControlHelper      The rotate control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper       $scaleControlHelper       The scale control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper  $streetViewControlHelper  The street view control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper        $zoomControlHelper        The zoom control helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper             $markerHelper             The marker helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper         $infoWindowHelper         The info window helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper           $polylineHelper           The polyline helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper    $encodedPolylineHelper    The encoded polyline helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper            $polygonHelper            The polygon helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper          $rectangleHelper          The rectangle helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper             $circleHelper             The circle helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper      $groundOverlayHelper      The ground overlay helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper             $kmlLayerHelper           The KML layer helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper         $eventManagerHelper       The event manager helper.
     */
    public function __construct(
        CoordinateHelper $coordinateHelper = null,
        BoundHelper $boundHelper = null,
        MapTypeIdHelper $mapTypeIdHelper = null,
        MapTypeControlHelper $mapTypeControlHelper = null,
        OverviewMapControlHelper $overviewMapControlHelper = null,
        PanControlHelper $panControlHelper = null,
        RotateControlHelper $rotateControlHelper = null,
        ScaleControlHelper $scaleControlHelper = null,
        StreetViewControlHelper $streetViewControlHelper = null,
        ZoomControlHelper $zoomControlHelper = null,
        MarkerHelper $markerHelper = null,
        InfoWindowHelper $infoWindowHelper = null,
        PolylineHelper $polylineHelper = null,
        EncodedPolylineHelper $encodedPolylineHelper = null,
        PolygonHelper $polygonHelper = null,
        RectangleHelper $rectangleHelper = null,
        CircleHelper $circleHelper = null,
        GroundOverlayHelper $groundOverlayHelper = null,
        KMLLayerHelper $kmlLayerHelper = null,
        EventManagerHelper $eventManagerHelper = null
    )
    {
        $this->loaded = false;

        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($boundHelper === null) {
            $boundHelper = new BoundHelper();
        }

        if ($mapTypeIdHelper === null) {
            $mapTypeIdHelper = new MapTypeIdHelper();
        }

        if ($mapTypeControlHelper === null) {
            $mapTypeControlHelper = new MapTypeControlHelper();
        }

        if ($overviewMapControlHelper === null) {
            $overviewMapControlHelper = new OverviewMapControlHelper();
        }

        if ($panControlHelper === null) {
            $panControlHelper = new PanControlHelper();
        }

        if ($rotateControlHelper === null) {
            $rotateControlHelper = new RotateControlHelper();
        }

        if ($scaleControlHelper === null) {
            $scaleControlHelper = new ScaleControlHelper();
        }

        if ($streetViewControlHelper === null) {
            $streetViewControlHelper = new StreetViewControlHelper();
        }

        if ($zoomControlHelper === null) {
            $zoomControlHelper = new ZoomControlHelper();
        }

        if ($markerHelper === null) {
            $markerHelper = new MarkerHelper();
        }

        if ($infoWindowHelper === null) {
            $infoWindowHelper = new InfoWindowHelper();
        }

        if ($polylineHelper === null) {
            $polylineHelper = new PolylineHelper();
        }

        if ($encodedPolylineHelper === null) {
            $encodedPolylineHelper = new EncodedPolylineHelper();
        }

        if ($polygonHelper === null) {
            $polygonHelper = new PolygonHelper();
        }

        if ($rectangleHelper === null) {
            $rectangleHelper = new RectangleHelper();
        }

        if ($circleHelper === null) {
            $circleHelper = new CircleHelper();
        }

        if ($groundOverlayHelper === null) {
            $groundOverlayHelper = new GroundOverlayHelper();
        }

        if ($kmlLayerHelper === null) {
            $kmlLayerHelper = new KMLLayerHelper();
        }

        if ($eventManagerHelper === null) {
            $eventManagerHelper = new EventManagerHelper();
        }

        $this->setCoordinateHelper($coordinateHelper);
        $this->setBoundHelper($boundHelper);
        $this->setMapTypeIdHelper($mapTypeIdHelper);
        $this->setMapTypeControlHelper($mapTypeControlHelper);
        $this->setOverviewMapControlHelper($overviewMapControlHelper);
        $this->setPanControlHelper($panControlHelper);
        $this->setRotateControlHelper($rotateControlHelper);
        $this->setScaleControlHelper($scaleControlHelper);
        $this->setStreetViewControlHelper($streetViewControlHelper);
        $this->setZoomControlHelper($zoomControlHelper);
        $this->setMarkerHelper($markerHelper);
        $this->setInfoWindowHelper($infoWindowHelper);
        $this->setPolylineHelper($polylineHelper);
        $this->setEncodedPolylineHelper($encodedPolylineHelper);
        $this->setPolygonHelper($polygonHelper);
        $this->setRectangleHelper($rectangleHelper);
        $this->setCircleHelper($circleHelper);
        $this->setGroundOverlayHelper($groundOverlayHelper);
        $this->setKmlLayerHelper($kmlLayerHelper);
        $this->setEventManagerHelper($eventManagerHelper);
    }

    /**
     * Gets the bound helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper The bound helper.
     */
    public function getBoundHelper()
    {
        return $this->boundHelper;
    }

    /**
     * Sets the bound helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function setBoundHelper(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Gets the map type id helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper The map type id helper.
     */
    public function getMapTypeIdHelper()
    {
        return $this->mapTypeIdHelper;
    }

    /**
     * Sets the map type id helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\MapTypeIdHelper $mapTypeIdHelper The map type id helper.
     */
    public function setMapTypeIdHelper(MapTypeIdHelper $mapTypeIdHelper)
    {
        $this->mapTypeIdHelper = $mapTypeIdHelper;
    }

    /**
     * Gets the map type control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper The map type control helper.
     */
    public function getMapTypeControlHelper()
    {
        return $this->mapTypeControlHelper;
    }

    /**
     * Sets the map type control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\MapTypeControlHelper $mapTypeControlHelper The map type control helper.
     */
    public function setMapTypeControlHelper(MapTypeControlHelper $mapTypeControlHelper)
    {
        $this->mapTypeControlHelper = $mapTypeControlHelper;
    }

    /**
     * Gets the overview map control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper The overview map control helper.
     */
    public function getOverviewMapControlHelper()
    {
        return $this->overviewMapControlHelper;
    }

    /**
     * Sets the overview map control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\OverviewMapControlHelper $overviewMapControlHelper The overview map control helper.
     */
    public function setOverviewMapControlHelper(OverviewMapControlHelper $overviewMapControlHelper)
    {
        $this->overviewMapControlHelper = $overviewMapControlHelper;
    }

    /**
     * Gets the pan control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper The pan control helper.
     */
    public function getPanControlHelper()
    {
        return $this->panControlHelper;
    }

    /**
     * Sets the pan control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\PanControlHelper $panControlHelper The pan control helper.
     */
    public function setPanControlHelper(PanControlHelper $panControlHelper)
    {
        $this->panControlHelper = $panControlHelper;
    }

    /**
     * Gets the rotate control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper The rotate control helper.
     */
    public function getRotateControlHelper()
    {
        return $this->rotateControlHelper;
    }

    /**
     * Sets the rotate control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\RotateControlHelper $rotateControlHelper The rotate control helper.
     */
    public function setRotateControlHelper(RotateControlHelper $rotateControlHelper)
    {
        $this->rotateControlHelper = $rotateControlHelper;
    }

    /**
     * Gets the scale control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper The scale control helper.
     */
    public function getScaleControlHelper()
    {
        return $this->scaleControlHelper;
    }

    /**
     * Sets the scale control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\ScaleControlHelper $scaleControlHelper The scale control helper.
     */
    public function setScaleControlHelper(ScaleControlHelper $scaleControlHelper)
    {
        $this->scaleControlHelper = $scaleControlHelper;
    }

    /**
     * Gets the street view control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper The street view control helper.
     */
    public function getStreetViewControlHelper()
    {
        return $this->streetViewControlHelper;
    }

    /**
     * Sets the street view control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\StreetViewControlHelper $streetViewControlHelper The street view control helper.
     */
    public function setStreetViewControlHelper(StreetViewControlHelper $streetViewControlHelper)
    {
        $this->streetViewControlHelper = $streetViewControlHelper;
    }

    /**
     * Gets the zoom control helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper The zoom control helper.
     */
    public function getZoomControlHelper()
    {
        return $this->zoomControlHelper;
    }

    /**
     * Sets the zoom control helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Controls\ZoomControlHelper $zoomControlHelper The zoom control helper.
     */
    public function setZoomControlHelper(ZoomControlHelper $zoomControlHelper)
    {
        $this->zoomControlHelper = $zoomControlHelper;
    }

    /**
     * Gets the marker helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper The marker helper.
     */
    public function getMarkerHelper()
    {
        return $this->markerHelper;
    }

    /**
     * Sets the marker helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\MarkerHelper $markerHelper The marker helper.
     */
    public function setMarkerHelper(MarkerHelper $markerHelper)
    {
        $this->markerHelper = $markerHelper;
    }

    /**
     * Gets the info window helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper The info window helper.
     */
    public function getInfoWindowHelper()
    {
        return $this->infoWindowHelper;
    }

    /**
     * Sets the info window helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper $infoWindowHelper The info window helper.
     */
    public function setInfoWindowHelper(InfoWindowHelper $infoWindowHelper)
    {
        $this->infoWindowHelper = $infoWindowHelper;
    }

    /**
     * Gets the polyline helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper The polyline helper.
     */
    public function getPolylineHelper()
    {
        return $this->polylineHelper;
    }

    /**
     * Sets the polyline helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper $polylineHelper The polyline helper.
     */
    public function setPolylineHelper(PolylineHelper $polylineHelper)
    {
        $this->polylineHelper = $polylineHelper;
    }

    /**
     * Gets the encoded polyline helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper The encoded polyline helper.
     */
    public function getEncodedPolylineHelper()
    {
        return $this->encodedPolylineHelper;
    }

    /**
     * Sets the encoded polyline helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\EncodedPolylineHelper $encodedPolylineHelper The encoded polyline helper.
     */
    public function setEncodedPolylineHelper(EncodedPolylineHelper $encodedPolylineHelper)
    {
        $this->encodedPolylineHelper = $encodedPolylineHelper;
    }

    /**
     * Gets the polygon helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper The polygon helper.
     */
    public function getPolygonHelper()
    {
        return $this->polygonHelper;
    }

    /**
     * Sets the polygon helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper $polygonHelper The polygon helper.
     */
    public function setPolygonHelper(PolygonHelper $polygonHelper)
    {
        $this->polygonHelper = $polygonHelper;
    }

    /**
     * Gets the rectangle helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper The rectangle helper.
     */
    public function getRectangleHelper()
    {
        return $this->rectangleHelper;
    }

    /**
     * Sets the rectangle helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\RectangleHelper $rectangleHelper The rectangle helper.
     */
    public function setRectangleHelper(RectangleHelper $rectangleHelper)
    {
        $this->rectangleHelper = $rectangleHelper;
    }

    /**
     * Gets the circle helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper The circle helper.
     */
    public function getCircleHelper()
    {
        return $this->circleHelper;
    }

    /**
     * Sets the circle helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\CircleHelper $circleHelper The circle helper.
     */
    public function setCircleHelper(CircleHelper $circleHelper)
    {
        $this->circleHelper = $circleHelper;
    }

    /**
     * Gets the ground overlay helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper The ground overlay helper.
     */
    public function getGroundOverlayHelper()
    {
        return $this->groundOverlayHelper;
    }

    /**
     * Sets the ground overlay helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Overlays\GroundOverlayHelper $groundOverlayHelper The ground overlay helper.
     */
    public function setGroundOverlayHelper(GroundOverlayHelper $groundOverlayHelper)
    {
        $this->groundOverlayHelper = $groundOverlayHelper;
    }

    /**
     * Gets the KML layer helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper The KML layer helper.
     */
    public function getKmlLayerHelper()
    {
        return $this->kmlLayerHelper;
    }

    /**
     * Sets the KML layer helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Layers\KMLLayerHelper $kmlLayerHelper The KML layer helper.
     */
    public function setKmlLayerHelper(KMLLayerHelper $kmlLayerHelper)
    {
        $this->kmlLayerHelper = $kmlLayerHelper;
    }

    /**
     * Gets the event manager helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper The event manager helper.
     */
    public function getEventManagerHelper()
    {
        return $this->eventManagerHelper;
    }

    /**
     * Sets the event manager helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Events\EventManagerHelper $eventManagerHelper The event manager helper.
     */
    public function setEventManagerHelper(EventManagerHelper $eventManagerHelper)
    {
        $this->eventManagerHelper = $eventManagerHelper;
    }

    /**
     * Renders the map container.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function renderContainer(Map $map)
    {
        return sprintf('<div id="%s" style="width:%s;height:%s;"></div>'.PHP_EOL,
            $map->getHtmlContainerId(),
            $map->getStylesheetOption('width'),
            $map->getStylesheetOption('height')
        );
    }

    /**
     * Renders the map stylesheets.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function renderStylesheets(Map $map)
    {
        $html = array();

        $html[] = '<style type="text/css">'.PHP_EOL;
        $html[] = '#'.$map->getHtmlContainerId().'{'.PHP_EOL;

        foreach ($map->getStylesheetOptions() as $option => $value) {
            $html[] = $option.':'.$value.';'.PHP_EOL;
        }

        $html[] = '}'.PHP_EOL;
        $html[] = '</style>'.PHP_EOL;

        return implode('', $html);
    }

    /**
     * Renders the map javascripts.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function renderJavascripts(Map $map)
    {
        $html = array();

        if (!$this->loaded) {
            $html[] = $this->renderGoogleMapAPI($map);
        }

        $html[] = '<script type="text/javascript">'.PHP_EOL;

        if ($map->isAsync()) {
            $html[] = 'function load_ivory_google_map() {'.PHP_EOL;
        }

        $html[] = $this->renderMap($map);

        $closableInfoWindows = $this->renderClosableInfoWindows($map);

        $html[] = $this->renderMarkers($map, (bool) $closableInfoWindows);
        $html[] = $this->renderInfoWindows($map);
        $html[] = $this->renderPolylines($map);
        $html[] = $this->renderEncodedPolylines($map);
        $html[] = $this->renderPolygons($map);
        $html[] = $this->renderRectangles($map);
        $html[] = $this->renderCircles($map);
        $html[] = $this->renderGroundOverlays($map);

        if ($map->isAutoZoom()) {
            $html[] = $this->renderBound($map);
        } else {
            $html[] = $this->renderCenter($map);
        }

        $html[] = $this->renderKMLLayers($map);

        if ($closableInfoWindows) {
            $html[] = $closableInfoWindows;
        }

        $html[] = $this->renderEvents($map);

        if ($map->isAsync()) {
            $html[] = '}'.PHP_EOL;
        }

        $html[] = '</script>'.PHP_EOL;

        return implode('', $html);
    }

    /**
     * Renders the map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderMap(Map $map)
    {
        $html = array();

        $mapControlJSONOptions = $this->renderMapControls($map);
        $mapOptions = $map->getMapOptions();
        $mapJSONOptions = '{"mapTypeId":'.$this->mapTypeIdHelper->render($mapOptions['mapTypeId']);
        unset($mapOptions['mapTypeId']);

        if (!empty($mapControlJSONOptions)) {
            $mapJSONOptions .= ','.$mapControlJSONOptions;
        }

        if ($map->isAutoZoom() && isset($mapOptions['zoom'])) {
            unset($mapOptions['zoom']);
        }

        if (!empty($mapOptions)) {
            $mapJSONOptions .= ','.substr(json_encode($mapOptions), 1);
        } else {
            $mapJSONOptions .= '}';
        }

        $html[] = sprintf('var %s = new google.maps.Map(document.getElementById("%s"), %s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getHtmlContainerId(),
            $mapJSONOptions
        );

        return implode('', $html);
    }

    /**
     * Renders a map center.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string Ths JS output.
     */
    public function renderCenter(Map $map)
    {
        return sprintf('%s.setCenter(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($map->getCenter())
        );
    }

    /**
     * Renders a map bound.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderBound(Map $map)
    {
        $html = array();

        $html[] = $this->boundHelper->render($map->getBound());
        $html[] = sprintf('%s.fitBounds(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getBound()->getJavascriptVariable()
        );

        return implode('', $html);
    }

    /**
     * Renders the map markers.
     *
     * @param \Ivory\GoogleMap\Map $map                    The map.
     * @paral boolean              $hasClosableInfoWindows TRUE if the map has closable info windows else FALSE.
     *
     * @return string Ths JS output.
     */
    public function renderMarkers(Map $map, $hasClosableInfoWindows)
    {
        $html = array();

        foreach ($map->getMarkers() as $marker) {
            $html[] = $this->markerHelper->render($marker, $map);

            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoOpen()) {
                $this->registerMarkerInfoWindowEvent($map, $marker, $hasClosableInfoWindows);
            }
        }

        return implode('', $html);
    }

    /**
     * Renders the map info windows.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderInfoWindows(Map $map)
    {
        $html = array();

        foreach ($map->getInfoWindows() as $infoWindow) {
            $html[] = $this->infoWindowHelper->render($infoWindow);

            if ($infoWindow->isOpen()) {
                $html[] = $this->infoWindowHelper->renderOpen($infoWindow, $map);
            }
        }

        return implode('', $html);
    }

    /**
     * Renders the map polylines.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderPolylines(Map $map)
    {
        $html = array();

        foreach ($map->getPolylines() as $polyline) {
            $html[] = $this->polylineHelper->render($polyline, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map encoded polylines.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderEncodedPolylines(Map $map)
    {
        $html = array();

        foreach ($map->getEncodedPolylines() as $encodedPolyline) {
            $html[] = $this->encodedPolylineHelper->render($encodedPolyline, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map polygons.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderPolygons(Map $map)
    {
        $html = array();

        foreach ($map->getPolygons() as $polygon) {
            $html[] = $this->polygonHelper->render($polygon, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map rectangles.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderRectangles(Map $map)
    {
        $html = array();

        foreach ($map->getRectangles() as $rectangle) {
            $html[] = $this->rectangleHelper->render($rectangle, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map circles.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderCircles(Map $map)
    {
        $html = array();

        foreach ($map->getCircles() as $circle) {
            $html[] = $this->circleHelper->render($circle, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map ground overlays.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderGroundOverlays(Map $map)
    {
        $html = array();

        foreach ($map->getGroundOverlays() as $groundOverlay) {
            $html[] = $this->groundOverlayHelper->render($groundOverlay, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map KML layers.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderKMLLayers(Map $map)
    {
        $html = array();

        foreach ($map->getKMLLayers() as $kmlLayer) {
            $html[] = $this->kmlLayerHelper->render($kmlLayer, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the closable info windows.
     *
     * @return string The JS output.
     */
    public function renderClosableInfoWindows(Map $map)
    {
        $html = array();

        $closableInfoWindows = array();
        foreach ($map->getInfoWindows() as $infoWindow) {
            if ($infoWindow->isAutoClose()) {
                $closableInfoWindows[] = $infoWindow->getJavascriptVariable();
            }
        }

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoClose()) {
                $closableInfoWindows[] = $marker->getInfoWindow()->getJavascriptVariable();
            }
        }

        if (!empty($closableInfoWindows)) {
            $html[] = sprintf('var closable_info_windows = Array(%s);'.PHP_EOL, implode(', ', $closableInfoWindows));
        }

        return implode('', $html);
    }

    /**
     * Renders the map events.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderEvents(Map $map)
    {
        return $this->eventManagerHelper->render($map->getEventManager());
    }

    /**
     * Renders the google map API.
     *
     * @param \Ivory\GoogleMap\Map $map The map
     *
     * @return string The HTML output.
     */
    protected function renderGoogleMapAPI(Map $map)
    {
        $this->loaded = true;

        $url = '//maps.google.com/maps/api/js?';

        $encodedPolylines = $map->getEncodedPolylines();
        if (!empty($encodedPolylines)) {
            $url .= 'libraries=geometry&amp;';
        }

        if ($map->isAsync()) {
            $url .= 'callback=load_ivory_google_map&amp;';
        }

        $url .= sprintf('language=%s&amp;sensor=false', $map->getLanguage());

        return sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL, $url);
    }

    /**
     * Renders the map controls.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    protected function renderMapControls(Map $map)
    {
        $mapControls = array();
        $controlNames = array(
            'MapTypeControl',
            'OverviewMapControl',
            'PanControl',
            'RotateControl',
            'ScaleControl',
            'StreetViewControl',
            'ZoomControl',
        );

        foreach($controlNames as $controlName) {
            $controlHelper = lcfirst($controlName).'Helper';

            $mapControlJSONOption = $this->renderMapControl($map, $controlName, $this->$controlHelper);
            if (!empty($mapControlJSONOption)) {
                $mapControls[] = $mapControlJSONOption;
            }
        }

        return implode(',', $mapControls);
    }

    /**
     * Renders a map control.
     *
     * @param \Ivory\GoogleMap\Map $map           The map.
     * @param string               $controlName   The control name.
     * @param mixed                $controlHelper The control helper.
     *
     * @return string Ths JS output.
     */
    protected function renderMapControl(Map $map, $controlName, $controlHelper)
    {
        $mapControl = array();
        $lcFirstControlName = lcfirst($controlName);

        if ($map->hasMapOption($lcFirstControlName)) {
            if ($map->getMapOption($lcFirstControlName)) {
                $mapControl[] = sprintf('"%s":true', $lcFirstControlName);

                $hasControlMethod = 'has'.$controlName;
                if ($map->$hasControlMethod()) {
                    $getControlMethod = 'get'.$controlName;

                    $mapControl[] = sprintf('"%sOptions":%s',
                        $lcFirstControlName,
                        $controlHelper->render($map->$getControlMethod())
                    );
                }
            } else {
                $mapControl[] = sprintf('"%s":false', $lcFirstControlName);
            }

            $map->removeMapOption($lcFirstControlName);
        }

        return implode(',', $mapControl);
    }

    /**
     * Registers the marker info window event (auto open).
     *
     * @param \Ivory\GoogleMap\Map             $map                    The map.
     * @param \Ivory\GoogleMap\Overlays\Marker $marker                 The marker.
     * @param boolean                          $hasClosableInfoWindows TRUE if the map has closable info windows else FALSE.
     */
    protected function registerMarkerInfoWindowEvent(Map $map, Marker $marker, $hasClosableInfoWindows)
    {
        $openInfoWindow = str_replace(
            PHP_EOL,
            '',
            $this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map, $marker)
        );

        if ($hasClosableInfoWindows) {
            $handle = <<<EOF
function () {
    for (var info_window in closable_info_windows) {
        closable_info_windows[info_window].close();
    }
    $openInfoWindow
}
EOF;
        } else {
            $handle = sprintf('function () {%s}', $openInfoWindow);
        }

        $event = new Event();
        $event->setJavascriptVariable(sprintf($marker->getJavascriptVariable().'_%s', 'info_window_event'));
        $event->setInstance($marker->getJavascriptVariable());
        $event->setEventName($marker->getInfoWindow()->getOpenEvent());
        $event->setHandle($handle);

        $map->getEventManager()->addEvent($event);
    }
}
