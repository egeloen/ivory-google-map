<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Exception\HelperException;
use Ivory\GoogleMap\Helper\Base\BoundHelper;
use Ivory\GoogleMap\Helper\Base\CoordinateHelper;
use Ivory\GoogleMap\Helper\Base\PointHelper;
use Ivory\GoogleMap\Helper\Base\SizeHelper;
use Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper;
use Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper;
use Ivory\GoogleMap\Helper\Controls\PanControlHelper;
use Ivory\GoogleMap\Helper\Controls\RotateControlHelper;
use Ivory\GoogleMap\Helper\Controls\ScaleControlHelper;
use Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper;
use Ivory\GoogleMap\Helper\Controls\ZoomControlHelper;
use Ivory\GoogleMap\Helper\Events\EventManagerHelper;
use Ivory\GoogleMap\Helper\Extension\CoreExtensionHelper;
use Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface;
use Ivory\GoogleMap\Helper\Layers\KMLLayerHelper;
use Ivory\GoogleMap\Helper\MapTypeIdHelper;
use Ivory\GoogleMap\Helper\Overlays\CircleHelper;
use Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper;
use Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper;
use Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface;
use Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper;
use Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper;
use Ivory\GoogleMap\Helper\Overlays\PolygonHelper;
use Ivory\GoogleMap\Helper\Overlays\PolylineHelper;
use Ivory\GoogleMap\Helper\Overlays\RectangleHelper;
use Ivory\GoogleMap\Map;

/**
 * Map helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper extends AbstractHelper
{
    /** @var \Ivory\GoogleMap\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Ivory\GoogleMap\Helper\Base\BoundHelper */
    protected $boundHelper;

    /** @var \Ivory\GoogleMap\Helper\Base\PointHelper */
    protected $pointHelper;

    /** @var \Ivory\GoogleMap\Helper\Base\SizeHelper */
    protected $sizeHelper;

    /** @var \Ivory\GoogleMap\Helper\MapTypeIdHelper */
    protected $mapTypeIdHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper */
    protected $mapTypeControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper */
    protected $overviewMapControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\PanControlHelper */
    protected $panControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\RotateControlHelper */
    protected $rotateControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\ScaleControlHelper */
    protected $scaleControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper */
    protected $streetViewControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\ZoomControlHelper */
    protected $zoomControlHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface */
    protected $markerClusterHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper */
    protected $markerImageHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper */
    protected $markerShapeHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper */
    protected $infoWindowHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\PolylineHelper */
    protected $polylineHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper */
    protected $encodedPolylineHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\PolygonHelper */
    protected $polygonHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\RectangleHelper */
    protected $rectangleHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\CircleHelper */
    protected $circleHelper;

    /** @var \Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper */
    protected $groundOverlayHelper;

    /** @var \Ivory\GoogleMap\Helper\Layers\KMLLayerHelper */
    protected $kmlLayerHelper;

    /** @var \Ivory\GoogleMap\Helper\Events\EventManagerHelper */
    protected $eventManagerHelper;

    /** @var array */
    protected $extensionHelpers;

    /**
     * Creates a map helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\CoordinateHelper                 $coordinateHelper         The coordinate helper.
     * @param \Ivory\GoogleMap\Helper\Base\BoundHelper                      $boundHelper              The bound helper.
     * @param \Ivory\GoogleMap\Helper\Base\PointHelper                      $pointHelper              The point helper.
     * @param \Ivory\GoogleMap\Helper\Base\SizeHelper                       $sizeHelper               The size helper.
     * @param \Ivory\GoogleMap\Helper\MapTypeIdHelper                       $mapTypeIdHelper          The map type id helper.
     * @param \Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper         $mapTypeControlHelper     The map type control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper     $overviewMapControlHelper The overview map control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\PanControlHelper             $panControlHelper         The pan control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\RotateControlHelper          $rotateControlHelper      The rotate control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\ScaleControlHelper           $scaleControlHelper       The scale control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper      $streetViewControlHelper  The street view control helper.
     * @param \Ivory\GoogleMap\Helper\Controls\ZoomControlHelper            $zoomControlHelper        The zoom control helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerClusterHelperInterface $markerClusterHelper      The marker cluster helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper            $markerImageHelper        The marker image helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper            $markerShapeHelper        The marker shape helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper             $infoWindowHelper         The info window helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\PolylineHelper               $polylineHelper           The polyline helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper        $encodedPolylineHelper    The encoded polyline helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\PolygonHelper                $polygonHelper            The polygon helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\RectangleHelper              $rectangleHelper          The rectangle helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\CircleHelper                 $circleHelper             The circle helper.
     * @param \Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper          $groundOverlayHelper      The ground overlay helper.
     * @param \Ivory\GoogleMap\Helper\Layers\KMLLayerHelper                 $kmlLayerHelper           The KML layer helper.
     * @param \Ivory\GoogleMap\Helper\Events\EventManagerHelper             $eventManagerHelper       The event manager helper.
     * @param array                                                         $extensionHelpers         The extension helpers.
     */
    public function __construct(
        CoordinateHelper $coordinateHelper = null,
        BoundHelper $boundHelper = null,
        PointHelper $pointHelper = null,
        SizeHelper $sizeHelper = null,
        MapTypeIdHelper $mapTypeIdHelper = null,
        MapTypeControlHelper $mapTypeControlHelper = null,
        OverviewMapControlHelper $overviewMapControlHelper = null,
        PanControlHelper $panControlHelper = null,
        RotateControlHelper $rotateControlHelper = null,
        ScaleControlHelper $scaleControlHelper = null,
        StreetViewControlHelper $streetViewControlHelper = null,
        ZoomControlHelper $zoomControlHelper = null,
        MarkerClusterHelperInterface $markerClusterHelper = null,
        MarkerImageHelper $markerImageHelper = null,
        MarkerShapeHelper $markerShapeHelper = null,
        InfoWindowHelper $infoWindowHelper = null,
        PolylineHelper $polylineHelper = null,
        EncodedPolylineHelper $encodedPolylineHelper = null,
        PolygonHelper $polygonHelper = null,
        RectangleHelper $rectangleHelper = null,
        CircleHelper $circleHelper = null,
        GroundOverlayHelper $groundOverlayHelper = null,
        KMLLayerHelper $kmlLayerHelper = null,
        EventManagerHelper $eventManagerHelper = null,
        array $extensionHelpers = array()
    ) {
        parent::__construct();

        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($boundHelper === null) {
            $boundHelper = new BoundHelper();
        }

        if ($pointHelper === null) {
            $pointHelper = new PointHelper();
        }

        if ($sizeHelper === null) {
            $sizeHelper = new SizeHelper();
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

        if ($markerClusterHelper === null) {
            $markerClusterHelper = new MarkerClusterHelper();
        }

        if ($markerImageHelper === null) {
            $markerImageHelper = new MarkerImageHelper();
        }

        if ($markerShapeHelper === null) {
            $markerShapeHelper = new MarkerShapeHelper();
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

        if (empty($extensionHelpers)) {
            $extensionHelpers['core'] = new CoreExtensionHelper();
        }

        $this->setCoordinateHelper($coordinateHelper);
        $this->setBoundHelper($boundHelper);
        $this->setPointHelper($pointHelper);
        $this->setSizeHelper($sizeHelper);

        $this->setMapTypeIdHelper($mapTypeIdHelper);
        $this->setMapTypeControlHelper($mapTypeControlHelper);
        $this->setOverviewMapControlHelper($overviewMapControlHelper);
        $this->setPanControlHelper($panControlHelper);
        $this->setRotateControlHelper($rotateControlHelper);
        $this->setScaleControlHelper($scaleControlHelper);
        $this->setStreetViewControlHelper($streetViewControlHelper);
        $this->setZoomControlHelper($zoomControlHelper);

        $this->setMarkerClusterHelper($markerClusterHelper);
        $this->setMarkerImageHelper($markerImageHelper);
        $this->setMarkerShapeHelper($markerShapeHelper);
        $this->setInfoWindowHelper($infoWindowHelper);
        $this->setPolylineHelper($polylineHelper);
        $this->setEncodedPolylineHelper($encodedPolylineHelper);
        $this->setPolygonHelper($polygonHelper);
        $this->setRectangleHelper($rectangleHelper);
        $this->setCircleHelper($circleHelper);
        $this->setGroundOverlayHelper($groundOverlayHelper);

        $this->setKmlLayerHelper($kmlLayerHelper);

        $this->setEventManagerHelper($eventManagerHelper);

        $this->setExtensionHelpers($extensionHelpers);
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Gets the bound helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\BoundHelper The bound helper.
     */
    public function getBoundHelper()
    {
        return $this->boundHelper;
    }

    /**
     * Sets the bound helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function setBoundHelper(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Gets the point helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\PointHelper The point helper.
     */
    public function getPointHelper()
    {
        return $this->pointHelper;
    }

    /**
     * Sets the point helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\PointHelper $pointHelper The point helper.
     */
    public function setPointHelper(PointHelper $pointHelper)
    {
        $this->pointHelper = $pointHelper;
    }

    /**
     * Gets the size helper.
     *
     * @return \Ivory\GoogleMap\Helper\Base\SizeHelper The size helper.
     */
    public function getSizeHelper()
    {
        return $this->sizeHelper;
    }

    /**
     * Sets the size helper.
     *
     * @param \Ivory\GoogleMap\Helper\Base\SizeHelper $sizeHelper The size helper.
     */
    public function setSizeHelper(SizeHelper $sizeHelper)
    {
        $this->sizeHelper = $sizeHelper;
    }

    /**
     * Gets the map type id helper.
     *
     * @return \Ivory\GoogleMap\Helper\MapTypeIdHelper The map type id helper.
     */
    public function getMapTypeIdHelper()
    {
        return $this->mapTypeIdHelper;
    }

    /**
     * Sets the map type id helper.
     *
     * @param \Ivory\GoogleMap\Helper\MapTypeIdHelper $mapTypeIdHelper The map type id helper.
     */
    public function setMapTypeIdHelper(MapTypeIdHelper $mapTypeIdHelper)
    {
        $this->mapTypeIdHelper = $mapTypeIdHelper;
    }

    /**
     * Gets the map type control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper The map type control helper.
     */
    public function getMapTypeControlHelper()
    {
        return $this->mapTypeControlHelper;
    }

    /**
     * Sets the map type control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\MapTypeControlHelper $mapTypeControlHelper The map type control helper.
     */
    public function setMapTypeControlHelper(MapTypeControlHelper $mapTypeControlHelper)
    {
        $this->mapTypeControlHelper = $mapTypeControlHelper;
    }

    /**
     * Gets the overview map control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper The overview map control helper.
     */
    public function getOverviewMapControlHelper()
    {
        return $this->overviewMapControlHelper;
    }

    /**
     * Sets the overview map control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\OverviewMapControlHelper $overviewMapControlHelper The overview map
     *                                                                                            control helper.
     */
    public function setOverviewMapControlHelper(OverviewMapControlHelper $overviewMapControlHelper)
    {
        $this->overviewMapControlHelper = $overviewMapControlHelper;
    }

    /**
     * Gets the pan control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\PanControlHelper The pan control helper.
     */
    public function getPanControlHelper()
    {
        return $this->panControlHelper;
    }

    /**
     * Sets the pan control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\PanControlHelper $panControlHelper The pan control helper.
     */
    public function setPanControlHelper(PanControlHelper $panControlHelper)
    {
        $this->panControlHelper = $panControlHelper;
    }

    /**
     * Gets the rotate control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\RotateControlHelper The rotate control helper.
     */
    public function getRotateControlHelper()
    {
        return $this->rotateControlHelper;
    }

    /**
     * Sets the rotate control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\RotateControlHelper $rotateControlHelper The rotate control helper.
     */
    public function setRotateControlHelper(RotateControlHelper $rotateControlHelper)
    {
        $this->rotateControlHelper = $rotateControlHelper;
    }

    /**
     * Gets the scale control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\ScaleControlHelper The scale control helper.
     */
    public function getScaleControlHelper()
    {
        return $this->scaleControlHelper;
    }

    /**
     * Sets the scale control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ScaleControlHelper $scaleControlHelper The scale control helper.
     */
    public function setScaleControlHelper(ScaleControlHelper $scaleControlHelper)
    {
        $this->scaleControlHelper = $scaleControlHelper;
    }

    /**
     * Gets the street view control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper The street view control helper.
     */
    public function getStreetViewControlHelper()
    {
        return $this->streetViewControlHelper;
    }

    /**
     * Sets the street view control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\StreetViewControlHelper $streetViewControlHelper The street view control
     *                                                                                          helper.
     */
    public function setStreetViewControlHelper(StreetViewControlHelper $streetViewControlHelper)
    {
        $this->streetViewControlHelper = $streetViewControlHelper;
    }

    /**
     * Gets the zoom control helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\ZoomControlHelper The zoom control helper.
     */
    public function getZoomControlHelper()
    {
        return $this->zoomControlHelper;
    }

    /**
     * Sets the zoom control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ZoomControlHelper $zoomControlHelper The zoom control helper.
     */
    public function setZoomControlHelper(ZoomControlHelper $zoomControlHelper)
    {
        $this->zoomControlHelper = $zoomControlHelper;
    }

    /**
     * Gets the marker cluster helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface The marker cluster helper.
     */
    public function getMarkerClusterHelper()
    {
        return $this->markerClusterHelper;
    }

    /**
     * Sets the marker cluster helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface $markerClusterHelper The marker cluster helper.
     */
    public function setMarkerClusterHelper(MarkerClusterHelperInterface $markerClusterHelper)
    {
        $this->markerClusterHelper = $markerClusterHelper;
    }

    /**
     * Gets the marker image helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper The marker image helper.
     */
    public function getMarkerImageHelper()
    {
        return $this->markerImageHelper;
    }

    /**
     * Sets the marker image helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerImageHelper $markerImageHelper The marker image helper.
     */
    public function setMarkerImageHelper(MarkerImageHelper $markerImageHelper)
    {
        $this->markerImageHelper = $markerImageHelper;
    }

    /**
     * Gets the marker shape helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper The marker shape helper.
     */
    public function getMarkerShapeHelper()
    {
        return $this->markerShapeHelper;
    }

    /**
     * Sets the marker shape helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\MarkerShapeHelper $markerShapeHelper The marker shape helper.
     */
    public function setMarkerShapeHelper(MarkerShapeHelper $markerShapeHelper)
    {
        $this->markerShapeHelper = $markerShapeHelper;
    }

    /**
     * Gets the info window helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper The info window helper.
     */
    public function getInfoWindowHelper()
    {
        return $this->infoWindowHelper;
    }

    /**
     * Sets the info window helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\InfoWindowHelper $infoWindowHelper The info window helper.
     */
    public function setInfoWindowHelper(InfoWindowHelper $infoWindowHelper)
    {
        $this->infoWindowHelper = $infoWindowHelper;
    }

    /**
     * Gets the polyline helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\PolylineHelper The polyline helper.
     */
    public function getPolylineHelper()
    {
        return $this->polylineHelper;
    }

    /**
     * Sets the polyline helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\PolylineHelper $polylineHelper The polyline helper.
     */
    public function setPolylineHelper(PolylineHelper $polylineHelper)
    {
        $this->polylineHelper = $polylineHelper;
    }

    /**
     * Gets the encoded polyline helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper The encoded polyline helper.
     */
    public function getEncodedPolylineHelper()
    {
        return $this->encodedPolylineHelper;
    }

    /**
     * Sets the encoded polyline helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\EncodedPolylineHelper $encodedPolylineHelper The encoded polyline helper.
     */
    public function setEncodedPolylineHelper(EncodedPolylineHelper $encodedPolylineHelper)
    {
        $this->encodedPolylineHelper = $encodedPolylineHelper;
    }

    /**
     * Gets the polygon helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\PolygonHelper The polygon helper.
     */
    public function getPolygonHelper()
    {
        return $this->polygonHelper;
    }

    /**
     * Sets the polygon helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\PolygonHelper $polygonHelper The polygon helper.
     */
    public function setPolygonHelper(PolygonHelper $polygonHelper)
    {
        $this->polygonHelper = $polygonHelper;
    }

    /**
     * Gets the rectangle helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\RectangleHelper The rectangle helper.
     */
    public function getRectangleHelper()
    {
        return $this->rectangleHelper;
    }

    /**
     * Sets the rectangle helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\RectangleHelper $rectangleHelper The rectangle helper.
     */
    public function setRectangleHelper(RectangleHelper $rectangleHelper)
    {
        $this->rectangleHelper = $rectangleHelper;
    }

    /**
     * Gets the circle helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\CircleHelper The circle helper.
     */
    public function getCircleHelper()
    {
        return $this->circleHelper;
    }

    /**
     * Sets the circle helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\CircleHelper $circleHelper The circle helper.
     */
    public function setCircleHelper(CircleHelper $circleHelper)
    {
        $this->circleHelper = $circleHelper;
    }

    /**
     * Gets the ground overlay helper.
     *
     * @return \Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper The ground overlay helper.
     */
    public function getGroundOverlayHelper()
    {
        return $this->groundOverlayHelper;
    }

    /**
     * Sets the ground overlay helper.
     *
     * @param \Ivory\GoogleMap\Helper\Overlays\GroundOverlayHelper $groundOverlayHelper The ground overlay helper.
     */
    public function setGroundOverlayHelper(GroundOverlayHelper $groundOverlayHelper)
    {
        $this->groundOverlayHelper = $groundOverlayHelper;
    }

    /**
     * Gets the KML layer helper.
     *
     * @return \Ivory\GoogleMap\Helper\Layers\KMLLayerHelper The KML layer helper.
     */
    public function getKmlLayerHelper()
    {
        return $this->kmlLayerHelper;
    }

    /**
     * Sets the KML layer helper.
     *
     * @param \Ivory\GoogleMap\Helper\Layers\KMLLayerHelper $kmlLayerHelper The KML layer helper.
     */
    public function setKmlLayerHelper(KMLLayerHelper $kmlLayerHelper)
    {
        $this->kmlLayerHelper = $kmlLayerHelper;
    }

    /**
     * Gets the event manager helper.
     *
     * @return \Ivory\GoogleMap\Helper\Events\EventManagerHelper The event manager helper.
     */
    public function getEventManagerHelper()
    {
        return $this->eventManagerHelper;
    }

    /**
     * Sets the event manager helper.
     *
     * @param \Ivory\GoogleMap\Helper\Events\EventManagerHelper $eventManagerHelper The event manager helper.
     */
    public function setEventManagerHelper(EventManagerHelper $eventManagerHelper)
    {
        $this->eventManagerHelper = $eventManagerHelper;
    }

    /**
     * Checks if the map helper has extensions.
     *
     * @return boolean TRUE if the map helper has extensions else FALSE.
     */
    public function hasExtensionHelpers()
    {
        return !empty($this->extensionHelpers);
    }

    /**
     * Gets the map extension helpers.
     *
     * @return array The map extension helpers.
     */
    public function getExtensionHelpers()
    {
        return $this->extensionHelpers;
    }

    /**
     * Sets the map extension helpers.
     *
     * @param array $extensionHelpers The map extension helpers.
     */
    public function setExtensionHelpers(array $extensionHelpers)
    {
        $this->extensionHelpers = array();

        foreach ($extensionHelpers as $name => $extensionHelper) {
            $this->setExtensionHelper($name, $extensionHelper);
        }
    }

    /**
     * Checks if the map helper has a specific extension helper.
     *
     * @param string $name The extension helper name.
     *
     * @return boolean TRUE if the map helper has a specific extension helper else FALSE.
     */
    public function hasExtensionHelper($name)
    {
        return isset($this->extensionHelpers[$name]);
    }

    /**
     * Gets a specific extension helper.
     *
     * @param string $name The extension helper name.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the extension helper does not exist.
     *
     * @return \Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface The extension helper.
     */
    public function getExtensionHelper($name)
    {
        if (!$this->hasExtensionHelper($name)) {
            throw HelperException::invalidExtension($name);
        }

        return $this->extensionHelpers[$name];
    }

    /**
     * Sets an extension helper.
     *
     * @param string                                                     $name            The extension helper name.
     * @param \Ivory\GoogleMap\Helper\Extension\ExtensionHelperInterface $extensionHelper The extension helper.
     */
    public function setExtensionHelper($name, ExtensionHelperInterface $extensionHelper)
    {
        $this->extensionHelpers[$name] = $extensionHelper;
    }

    /**
     * Removes an extension helper.
     *
     * @param string $name The extension helper name.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the extension helper does not exist.
     */
    public function removeExtensionHelper($name)
    {
        if (!$this->hasExtensionHelper($name)) {
            throw HelperException::invalidExtension($name);
        }

        unset($this->extensionHelpers[$name]);
    }

    /**
     * Renders the html (container & stylesheets).
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function render(Map $map)
    {
        return implode('', array(
            $this->renderHtmlContainer($map),
            $this->renderStylesheets($map),
            $this->renderJavascripts($map)
        ));
    }

    /**
     * Renders the map container.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function renderHtmlContainer(Map $map)
    {
        return sprintf(
            '<div id="%s" style="width:%s;height:%s;"></div>'.PHP_EOL,
            $map->getHtmlContainerId(),
            $map->getStylesheetOption('width'),
            $map->getStylesheetOption('height')
        );
    }

    /**
     * Renders the html map stylesheets.
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
        $output = array();

        if (!$map->isAsync()) {
            $output[] = $this->renderJsLibraries($map);
        }

        $output[] = '<script type="text/javascript">'.PHP_EOL;
        $output[] = $this->renderJsBefore($map);
        $output[] = $this->renderJsContainer($map);
        $output[] = $this->renderJsAfter($map);
        $output[] = '</script>'.PHP_EOL;

        if ($map->isAsync()) {
            $output[] = $this->renderJsLibraries($map);
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript libraries.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The HTML output.
     */
    public function renderJsLibraries(Map $map)
    {
        $output = array();

        foreach ($this->getExtensionHelpers() as $extension) {
            $output[] = $extension->renderLibraries($map);
        }

        return implode('', $output);
    }

    /**
     * Renders JS code just before the generated one.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsBefore(Map $map)
    {
        $output = array();

        foreach ($this->getExtensionHelpers() as $extension) {
            $output[] = $extension->renderBefore($map);
        }

        return implode('', $output);
    }

    /**
     * Renders JS code just after the generated one.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsAfter(Map $map)
    {
        $output = array();

        foreach (array_reverse($this->getExtensionHelpers()) as $extension) {
            $output[] = $extension->renderAfter($map);
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainer(Map $map)
    {
        $output = array();

        $output[] = $this->renderJsContainerInit($map);

        $output[] = $this->renderJsContainerCoordinates($map);
        $output[] = $this->renderJsContainerBounds($map);
        $output[] = $this->renderJsContainerPoints($map);
        $output[] = $this->renderJsContainerSizes($map);

        $output[] = $this->renderJsContainerMap($map);

        $output[] = $this->renderJsContainerCircles($map);
        $output[] = $this->renderJsContainerEncodedPolylines($map);
        $output[] = $this->renderJsContainerGroundOverlays($map);
        $output[] = $this->renderJsContainerPolygons($map);
        $output[] = $this->renderJsContainerPolylines($map);
        $output[] = $this->renderJsContainerRectangles($map);
        $output[] = $this->renderJsContainerInfoWindows($map);
        $output[] = $this->renderJsContainerMarkerImages($map);
        $output[] = $this->renderJsContainerMarkerShapes($map);
        $output[] = $this->renderJsContainerMarkerCluster($map);

        $output[] = $this->renderJsContainerKMLLayers($map);

        $output[] = $this->renderJsContainerEventManager($map);

        $output[] = $this->renderJsContainerExtra($map);

        return implode('', $output);
    }

    /**
     * Renders the javascript container initialization (empty container).
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerInit(Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setJsonEncodeOptions(JSON_FORCE_OBJECT)
            // Map
            ->setValue('[map]', null)
            // Base
            ->setValue('[coordinates]', array())
            ->setValue('[bounds]', array())
            ->setValue('[points]', array())
            ->setValue('[sizes]', array())
            // Overlays
            ->setValue('[circles]', array())
            ->setValue('[encoded_polylines]', array())
            ->setValue('[ground_overlays]', array())
            ->setValue('[polygons]', array())
            ->setValue('[polylines]', array())
            ->setValue('[rectangles]', array())
            ->setValue('[info_windows]', array())
            ->setValue('[marker_images]', array())
            ->setValue('[marker_shapes]', array())
            ->setValue('[markers]', array())
            ->setValue('[marker_cluster]', null)
            // Layers
            ->setValue('[kml_layers]', array())
            // Event Manager
            ->setValue('[event_manager][dom_events]', array())
            ->setValue('[event_manager][dom_events_once]', array())
            ->setValue('[event_manager][events]', array())
            ->setValue('[event_manager][events_once]', array())
            // Internal
            ->setValue('[closable_info_windows]', array())
            ->setValue(
                '[functions][to_array]',
                'function (object) { var array = []; for (var key in object) { array.push(object[key]); } return array; }',
                false
            );

        return sprintf('%s = %s;'.PHP_EOL, $this->getJsContainerName($map), $this->jsonBuilder->build());
    }

    /**
     * Renders the javascript container coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerCoordinates(Map $map)
    {
        $output = array();

        foreach ($this->computeCoordinates($map) as $coordinate) {
            $output[] = sprintf(
                '%s.coordinates.%s = %s',
                $this->getJsContainerName($map),
                $coordinate->getJavascriptVariable(),
                $this->coordinateHelper->render($coordinate)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container bounds.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerBounds(Map $map)
    {
        $output = array();

        foreach ($this->computeBounds($map) as $bound) {
            $output[] = sprintf(
                '%s.bounds.%s = %s',
                $this->getJsContainerName($map),
                $bound->getJavascriptVariable(),
                $this->boundHelper->render($bound)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container points.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerPoints(Map $map)
    {
        $output = array();

        foreach ($this->computePoints($map) as $point) {
            $output[] = sprintf(
                '%s.points.%s = %s',
                $this->getJsContainerName($map),
                $point->getJavascriptVariable(),
                $this->pointHelper->render($point)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container sizes.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerSizes(Map $map)
    {
        $output = array();

        foreach ($this->computeSizes($map) as $size) {
            $output[] = sprintf(
                '%s.sizes.%s = %s',
                $this->getJsContainerName($map),
                $size->getJavascriptVariable(),
                $this->sizeHelper->render($size)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerMap(Map $map)
    {
        return sprintf('%s.map = %s', $this->getJsContainerName($map), $this->renderMap($map));
    }

    /**
     * Renders the javascript container circles.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerCircles(Map $map)
    {
        $output = array();

        foreach ($map->getCircles() as $circle) {
            $output[] = sprintf(
                '%s.circles.%s = %s',
                $this->getJsContainerName($map),
                $circle->getJavascriptVariable(),
                $this->circleHelper->render($circle, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container encoded polylines.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerEncodedPolylines(Map $map)
    {
        $output = array();

        foreach ($map->getEncodedPolylines() as $encodedPolyline) {
            $output[] = sprintf(
                '%s.encoded_polylines.%s = %s',
                $this->getJsContainerName($map),
                $encodedPolyline->getJavascriptVariable(),
                $this->encodedPolylineHelper->render($encodedPolyline, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container ground overlays.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerGroundOverlays(Map $map)
    {
        $output = array();

        foreach ($map->getGroundOverlays() as $groundOverlay) {
            $output[] = sprintf(
                '%s.ground_overlays.%s = %s',
                $this->getJsContainerName($map),
                $groundOverlay->getJavascriptVariable(),
                $this->groundOverlayHelper->render($groundOverlay, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container polygons.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerPolygons(Map $map)
    {
        $output = array();

        foreach ($map->getPolygons() as $polygon) {
            $output[] = sprintf(
                '%s.polygons.%s = %s',
                $this->getJsContainerName($map),
                $polygon->getJavascriptVariable(),
                $this->polygonHelper->render($polygon, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container polylines.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerPolylines(Map $map)
    {
        $output = array();

        foreach ($map->getPolylines() as $polyline) {
            $output[] = sprintf(
                '%s.polylines.%s = %s',
                $this->getJsContainerName($map),
                $polyline->getJavascriptVariable(),
                $this->polylineHelper->render($polyline, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container rectangles.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerRectangles(Map $map)
    {
        $output = array();

        foreach ($map->getRectangles() as $rectangle) {
            $output[] = sprintf(
                '%s.rectangles.%s = %s',
                $this->getJsContainerName($map),
                $rectangle->getJavascriptVariable(),
                $this->rectangleHelper->render($rectangle, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container info windows.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerInfoWindows(Map $map)
    {
        $output = array();

        $mapInfoWindows = $map->getInfoWindows();
        $markerInfoWindows = $this->computeMarkerInfoWindows($map);

        foreach ($mapInfoWindows as $mapInfoWindow) {
            $output[] = sprintf(
                '%s.info_windows.%s = %s',
                $this->getJsContainerName($map),
                $mapInfoWindow->getJavascriptVariable(),
                $this->infoWindowHelper->render($mapInfoWindow)
            );
        }

        foreach ($markerInfoWindows as $markerInfoWindow) {
            $output[] = sprintf(
                '%s.info_windows.%s = %s',
                $this->getJsContainerName($map),
                $markerInfoWindow->getJavascriptVariable(),
                $this->infoWindowHelper->render($markerInfoWindow, false)
            );
        }

        foreach (array_merge($mapInfoWindows, $markerInfoWindows) as $infoWindow) {
            if ($infoWindow->isAutoClose()) {
                $output[] = sprintf(
                    '%s.closable_info_windows.%s = %s;'.PHP_EOL,
                    $this->getJsContainerName($map),
                    $infoWindow->getJavascriptVariable(),
                    $infoWindow->getJavascriptVariable()
                );
            }
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container maker images.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerMarkerImages(Map $map)
    {
        $output = array();

        foreach ($this->computeMarkerImages($map) as $markerImage) {
            $output[] = sprintf(
                '%s.marker_images.%s = %s',
                $this->getJsContainerName($map),
                $markerImage->getJavascriptVariable(),
                $this->markerImageHelper->render($markerImage)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container marker shapes.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerMarkerShapes(Map $map)
    {
        $output = array();

        foreach ($this->computeMarkerShapes($map) as $markerShape) {
            $output[] = sprintf(
                '%s.marker_shapes.%s = %s',
                $this->getJsContainerName($map),
                $markerShape->getJavascriptVariable(),
                $this->markerShapeHelper->render($markerShape)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container marker cluster.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerMarkerCluster(Map $map)
    {
        $output = array(
            $this->markerClusterHelper->renderMarkers($map->getMarkerCluster(), $map),
            $this->markerClusterHelper->render($map->getMarkerCluster(), $map),
        );

        return implode('', $output);
    }

    /**
     * Renders the javascript container KML layer.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerKMLLayers(Map $map)
    {
        $output = array();

        foreach ($map->getKMLLayers() as $kmlLayer) {
            $output[] = sprintf(
                '%s.kml_layers.%s = %s',
                $this->getJsContainerName($map),
                $kmlLayer->getJavascriptVariable(),
                $this->kmlLayerHelper->render($kmlLayer, $map)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the javascript container event manager.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerEventManager(Map $map)
    {
        $output = array();

        foreach ($map->getEventManager()->getDomEvents() as $domEvent) {
            $output[] = sprintf(
                '%s.event_manager.dom_events.%s = %s',
                $this->getJsContainerName($map),
                $domEvent->getJavascriptVariable(),
                $this->eventManagerHelper->renderDomEvent($domEvent)
            );
        }

        foreach ($map->getEventManager()->getDomEventsOnce() as $domEventOnce) {
            $output[] = sprintf(
                '%s.event_manager.dom_events_once.%s = %s',
                $this->getJsContainerName($map),
                $domEventOnce->getJavascriptVariable(),
                $this->eventManagerHelper->renderDomEventOnce($domEventOnce)
            );
        }

        foreach ($map->getEventManager()->getEvents() as $event) {
            $output[] = sprintf(
                '%s.event_manager.events.%s = %s',
                $this->getJsContainerName($map),
                $event->getJavascriptVariable(),
                $this->eventManagerHelper->renderEvent($event)
            );
        }

        foreach ($map->getEventManager()->getEventsOnce() as $eventOnce) {
            $output[] = sprintf(
                '%s.event_manager.events_once.%s = %s',
                $this->getJsContainerName($map),
                $eventOnce->getJavascriptVariable(),
                $this->eventManagerHelper->renderEventOnce($eventOnce)
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the js container extra.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderJsContainerExtra(Map $map)
    {
        $output = array();

        foreach ($map->getInfoWindows() as $infoWindow) {
            if ($infoWindow->isOpen()) {
                $output[] = $this->infoWindowHelper->renderOpen($infoWindow, $map);
            }
        }

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasInfoWindow() && $marker->getInfoWindow()->isOpen()) {
                $output[] = $this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map, $marker);
            }
        }

        foreach ($this->computeBounds($map) as $bound) {
            if ($bound->hasExtends()) {
                $output[] = $this->boundHelper->renderExtends($bound);
            }
        }

        if ($map->isAutoZoom()) {
            $output[] = $this->renderMapBound($map);
        } else {
            $output[] = $this->renderMapCenter($map);
        }

        return implode('', $output);
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
        $mapTypeId = $map->getMapOption('mapTypeId');
        $map->removeMapOption('mapTypeId');

        $this->jsonBuilder
            ->reset()
            ->setValue('[mapTypeId]', $this->mapTypeIdHelper->render($mapTypeId), false);

        $this->renderMapControls($map);

        if ($map->isAutoZoom()) {
            $map->removeMapOption('zoom');
        }

        $this->jsonBuilder->setValues($map->getMapOptions());

        return sprintf(
            '%s = new google.maps.Map(document.getElementById("%s"), %s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getHtmlContainerId(),
            $this->jsonBuilder->build()
        );
    }

    /**
     * Renders the map center.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string Ths JS output.
     */
    public function renderMapCenter(Map $map)
    {
        return sprintf(
            '%s.setCenter(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getCenter()->getJavascriptVariable()
        );
    }

    /**
     * Renders the map bound.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderMapBound(Map $map)
    {
        return sprintf(
            '%s.fitBounds(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getBound()->getJavascriptVariable()
        );
    }

    /**
     * Computes the coordinates of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed coordinated.
     */
    protected function computeCoordinates(Map $map)
    {
        $coordinates = array();

        if (!$map->isAutoZoom() && !in_array($map->getCenter(), $coordinates)) {
            $coordinates[] = $map->getCenter();
        }

        foreach ($this->computeBounds($map) as $bound) {
            if (!$bound->hasExtends() && $bound->hasCoordinates()) {
                if (!in_array($bound->getSouthWest(), $coordinates)) {
                    $coordinates[] = $bound->getSouthWest();
                }

                if (!in_array($bound->getNorthEast(), $coordinates)) {
                    $coordinates[] = $bound->getNorthEast();
                }
            }
        }

        foreach ($map->getCircles() as $circle) {
            if (!in_array($circle->getCenter(), $coordinates)) {
                $coordinates[] = $circle->getCenter();
            }
        }

        foreach ($map->getInfoWindows() as $infoWindow) {
            if (!in_array($infoWindow->getPosition(), $coordinates)) {
                $coordinates[] = $infoWindow->getPosition();
            }
        }

        foreach ($map->getMarkers() as $marker) {
            if (!in_array($marker->getPosition(), $coordinates)) {
                $coordinates[] = $marker->getPosition();
            }
        }

        foreach ($map->getPolygons() as $polygon) {
            foreach ($polygon->getCoordinates() as $polygonCoordinate) {
                if (!in_array($polygonCoordinate, $coordinates)) {
                    $coordinates[] = $polygonCoordinate;
                }
            }
        }

        foreach ($map->getPolylines() as $polyline) {
            foreach ($polyline->getCoordinates() as $polylineCoordinate) {
                if (!in_array($polylineCoordinate, $coordinates)) {
                    $coordinates[] = $polylineCoordinate;
                }
            }
        }

        return $coordinates;
    }

    /**
     * Computes the bounds of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed bounds.
     */
    protected function computeBounds(Map $map)
    {
        $bounds = array();

        if ($map->isAutoZoom() && !in_array($map->getBound(), $bounds)) {
            $bounds[] = $map->getBound();
        }

        foreach ($map->getGroundOverlays() as $groundOverlay) {
            if (!in_array($groundOverlay->getBound(), $bounds)) {
                $bounds[] = $groundOverlay->getBound();
            }
        }

        foreach ($map->getRectangles() as $rectangle) {
            if (!in_array($rectangle->getBound(), $bounds)) {
                $bounds[] = $rectangle->getBound();
            }
        }

        return $bounds;
    }

    /**
     * Computes the points of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed points.
     */
    protected function computePoints(Map $map)
    {
        $points = array();

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasIcon()) {
                if ($marker->getIcon()->hasAnchor() && !in_array($marker->getIcon()->getAnchor(), $points)) {
                    $points[] = $marker->getIcon()->getAnchor();
                }

                if ($marker->getIcon()->hasOrigin() && !in_array($marker->getIcon()->getOrigin(), $points)) {
                    $points[] = $marker->getIcon()->getOrigin();
                }
            }

            if ($marker->hasShadow()) {
                if ($marker->getShadow()->hasAnchor() && !in_array($marker->getShadow()->getAnchor(), $points)) {
                    $points[] = $marker->getShadow()->getAnchor();
                }

                if ($marker->getShadow()->hasOrigin() && !in_array($marker->getShadow()->getOrigin(), $points)) {
                    $points[] = $marker->getShadow()->getOrigin();
                }
            }
        }

        return $points;
    }

    /**
     * Computes the sizes of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed sizes.
     */
    protected function computeSizes(Map $map)
    {
        $sizes = array();

        foreach (array_merge($map->getInfoWindows(), $this->computeMarkerInfoWindows($map)) as $infoWindow) {
            if ($infoWindow->hasPixelOffset() && !in_array($infoWindow->getPixelOffset(), $sizes)) {
                $sizes[] = $infoWindow->getPixelOffset();
            }
        }

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasIcon()) {
                if ($marker->getIcon()->hasSize() && !in_array($marker->getIcon()->getSize(), $sizes)) {
                    $sizes[] = $marker->getIcon()->getSize();
                }

                if ($marker->getIcon()->hasScaledSize() && !in_array($marker->getIcon()->getScaledSize(), $sizes)) {
                    $sizes[] = $marker->getIcon()->getScaledSize();
                }
            }

            if ($marker->hasShadow()) {
                if ($marker->getShadow()->hasSize() && !in_array($marker->getShadow()->getSize(), $sizes)) {
                    $sizes[] = $marker->getShadow()->getSize();
                }

                if ($marker->getShadow()->hasScaledSize() && !in_array($marker->getShadow()->getScaledSize(), $sizes)) {
                    $sizes[] = $marker->getShadow()->getScaledSize();
                }
            }
        }

        return $sizes;
    }

    /**
     * Computes the marker images of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed marker images.
     */
    protected function computeMarkerImages(Map $map)
    {
        $markerImages = array();

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasIcon() && !in_array($marker->getIcon(), $markerImages)) {
                $markerImages[] = $marker->getIcon();
            }

            if ($marker->hasShadow() && !in_array($marker->getShadow(), $markerImages)) {
                $markerImages[] = $marker->getShadow();
            }
        }

        return $markerImages;
    }

    /**
     * Computes the marker shapes of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed marker shapes.
     */
    protected function computeMarkerShapes(Map $map)
    {
        $markerShapes = array();

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasShape() && !in_array($marker->getShape(), $markerShapes)) {
                $markerShapes[] = $marker->getShape();
            }
        }

        return $markerShapes;
    }

    /**
     * Computes the marker info windows of a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return array The computed marker info windows.
     */
    protected function computeMarkerInfoWindows(Map $map)
    {
        $infoWinfows = array();

        foreach ($map->getMarkers() as $marker) {
            if ($marker->hasInfoWindow() && !in_array($marker->getInfoWindow(), $infoWinfows)) {
                $infoWinfows[] = $marker->getInfoWindow();
            }
        }

        return $infoWinfows;
    }

    /**
     * Renders the map controls in the json builder.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     */
    protected function renderMapControls(Map $map)
    {
        $controlNames = array(
            'MapTypeControl',
            'OverviewMapControl',
            'PanControl',
            'RotateControl',
            'ScaleControl',
            'StreetViewControl',
            'ZoomControl',
        );

        foreach ($controlNames as $controlName) {
            $controlHelper = lcfirst($controlName).'Helper';
            $this->renderMapControl($map, $controlName, $this->$controlHelper);
        }
    }

    /**
     * Renders a map control in the json builder.
     *
     * @param \Ivory\GoogleMap\Map $map           The map.
     * @param string               $controlName   The control name.
     * @param mixed                $controlHelper The control helper.
     */
    protected function renderMapControl(Map $map, $controlName, $controlHelper)
    {
        $lcFirstControlName = lcfirst($controlName);

        if (!$map->hasMapOption($lcFirstControlName)) {
            return;
        }

        $this->jsonBuilder->setValue(
            sprintf('[%s]', $lcFirstControlName),
            (bool) $map->getMapOption($lcFirstControlName)
        );

        if ($map->getMapOption($lcFirstControlName)) {
            $hasControlMethod = 'has'.$controlName;
            if ($map->$hasControlMethod()) {
                $getControlMethod = 'get'.$controlName;

                $this->jsonBuilder->setValue(
                    sprintf('[%sOptions]', $lcFirstControlName),
                    $controlHelper->render($map->$getControlMethod()),
                    false
                );
            }
        }

        $map->removeMapOption($lcFirstControlName);
    }
}
