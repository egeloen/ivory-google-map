<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap;

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\OverviewMapControl;
use Ivory\GoogleMap\Controls\PanControl;
use Ivory\GoogleMap\Controls\RotateControl;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\StreetViewControl;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Events\EventManager;
use Ivory\GoogleMap\Exception\MapException;
use Ivory\GoogleMap\Layers\KMLLayer;
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Map wich describes a google map.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $htmlContainerId;

    /** @var boolean */
    protected $async;

    /** @var boolean */
    protected $autoZoom;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $center;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var array */
    protected $mapOptions;

    /** @var array */
    protected $stylesheetOptions;

    /** @var \Ivory\GoogleMap\Controls\MapTypeControl */
    protected $mapTypeControl;

    /** @var \Ivory\GoogleMap\Controls\OverviewMapControl */
    protected $overviewMapControl;

    /** @var \Ivory\GoogleMap\Controls\PanControl */
    protected $panControl;

    /** @var \Ivory\GoogleMap\Controls\RotateControl */
    protected $rotateControl;

    /** @var \Ivory\GoogleMap\Controls\ScaleControl */
    protected $scaleControl;

    /** @var \Ivory\GoogleMap\Controls\StreetViewControl */
    protected $streetViewControl;

    /** @var \Ivory\GoogleMap\Controls\ZoomControl */
    protected $zoomControl;

    /** @var \Ivory\GoogleMap\Events\EventManager */
    protected $eventManager;

    /** @var array */
    protected $markers;

    /** @var array */
    protected $infoWindows;

    /** @var array */
    protected $polylines;

    /** @var array */
    protected $encodedPolylines;

    /** @var array */
    protected $polygons;

    /** @var array */
    protected $rectangles;

    /** @var array */
    protected $circles;

    /** @var array */
    protected $groundOverlays;

    /** @var array */
    protected $kmlLayers;

    /** @var array */
    protected $libraries;

    /** @var string */
    protected $language;

    /**
     * Creates a map.
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('map_');

        $this->htmlContainerId = 'map_canvas';
        $this->async = false;
        $this->autoZoom = false;

        $this->center = new Coordinate();
        $this->bound = new Bound();
        $this->eventManager = new EventManager();

        $this->mapOptions = array(
            'mapTypeId' => MapTypeId::ROADMAP,
            'zoom'      => 3,
        );

        $this->stylesheetOptions = array(
            'width'  => '300px',
            'height' => '300px',
        );

        $this->markers = array();
        $this->infoWindows = array();
        $this->polylines = array();
        $this->encodedPolylines = array();
        $this->polygons = array();
        $this->rectangles = array();
        $this->circles = array();
        $this->groundOverlays = array();
        $this->kmlLayers = array();

        $this->libraries = array();
        $this->language = 'en';
    }

    /**
     * Gets the map HTML container ID.
     *
     * @return string The map HTML constainer ID.
     */
    public function getHtmlContainerId()
    {
        return $this->htmlContainerId;
    }

    /**
     * Sets the map HTML container ID.
     *
     * @param string $htmlContainerId The map HTML container ID.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the HTML container ID is not a string.
     */
    public function setHtmlContainerId($htmlContainerId)
    {
        if (!is_string($htmlContainerId)) {
            throw MapException::invalidHtmlContainerId();
        }

        $this->htmlContainerId = $htmlContainerId;
    }

    /**
     * Check if the map loading is asynchronous.
     *
     * @return boolean TRUE if the map loading is asynchronous else FALSE.
     */
    public function isAsync()
    {
        return $this->async;
    }

    /**
     * Sets if the map loading is asynchronous.
     *
     * @param boolean $async TRUE if the map loading is asynchronous else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the async flag is not a boolean.
     */
    public function setAsync($async)
    {
        if (!is_bool($async)) {
            throw MapException::invalidAsync();
        }

        $this->async = $async;
    }

    /**
     * Check if the map autozooms.
     *
     * @return boolean TRUE if the map autozooms else FALSE.
     */
    public function isAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * Sets if the map autozooms.
     *
     * @param boolean $autoZoom TRUE if the map autozooms else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the auto zoom flag is not a boolean.
     */
    public function setAutoZoom($autoZoom)
    {
        if (!is_bool($autoZoom)) {
            throw MapException::invalidAutoZoom();
        }

        $this->autoZoom = $autoZoom;
    }

    /**
     * Gets the map center.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The map center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the map center.
     *
     * Available prototypes:
     *  - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     *  - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the center is not valid (prototypes).
     */
    public function setCenter()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->center = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->center->setNoWrap($args[2]);
            }
        } else {
            throw MapException::invalidCenter();
        }
    }

    /**
     * Gets the map bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The map bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the map bound.
     *
     * Available prototypes:
     *  - function setBound(Ivory\GoogleMap\Base\Bound $bound = null)
     *  - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     *  - function setBound(
     *      double $southWestLatitude,
     *      double $southWestLongitude,
     *      double $northEastLatitude,
     *      double $northEastLongitude,
     *      boolean southWestNoWrap = true,
     *      boolean $northEastNoWrap = true
     *  )
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the bound is not valid (prototypes).
     */
    public function setBound()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Bound)) {
            $this->bound = $args[0];
        } elseif ((isset($args[0]) && ($args[0] instanceof Coordinate))
            && (isset($args[1]) && ($args[1] instanceof Coordinate))
        ) {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        } elseif ((isset($args[0]) && is_numeric($args[0]))
            && (isset($args[1]) && is_numeric($args[1]))
            && (isset($args[2]) && is_numeric($args[2]))
            && (isset($args[3]) && is_numeric($args[3]))
        ) {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));

            if (isset($args[4]) && is_bool($args[4])) {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            }

            if (isset($args[5]) && is_bool($args[5])) {
                $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        } elseif (!isset($args[0])) {
            $this->bound->setSouthWest(null);
            $this->bound->setNorthEast(null);
        } else {
            throw MapException::invalidBound();
        }
    }

    /**
     * Checks if the map option exists.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option is not valid.
     *
     * @return boolean TRUE if the map option exists else FALSE.
     */
    public function hasMapOption($mapOption)
    {
        if (!is_string($mapOption)) {
            throw MapException::invalidMapOption();
        }

        return isset($this->mapOptions[$mapOption]);
    }

    /**
     * Gets the map options
     *
     * @return array The map options.
     */
    public function getMapOptions()
    {
        return $this->mapOptions;
    }

    /**
     * Sets the map options.
     *
     * @param array $mapOptions The map options.
     */
    public function setMapOptions(array $mapOptions)
    {
        foreach ($mapOptions as $mapOption => $value) {
            $this->setMapOption($mapOption, $value);
        }
    }

    /**
     * Gets a specific map option.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option does not exist.
     *
     * @return mixed The map option value.
     */
    public function getMapOption($mapOption)
    {
        if (!$this->hasMapOption($mapOption)) {
            throw MapException::mapOptionDoesNotExist($mapOption);
        }

        return $this->mapOptions[$mapOption];
    }

    /**
     * Sets a specific map option
     *
     * @param string $mapOption The map option.
     * @param mixed  $value     The map option value.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option is not valid.
     */
    public function setMapOption($mapOption, $value)
    {
        if (!is_string($mapOption)) {
            throw MapException::invalidMapOption();
        }

        $this->mapOptions[$mapOption] = $value;
    }

    /**
     * Removes a map option.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option does not exist.
     */
    public function removeMapOption($mapOption)
    {
        if (!$this->hasMapOption($mapOption)) {
            throw MapException::mapOptionDoesNotExist($mapOption);
        }

        unset($this->mapOptions[$mapOption]);
    }

    /**
     * Checks if the stylesheet option exists.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option is not valid.
     *
     * @return boolean TRUE if the stylesheet option exists else FALSE.
     */
    public function hasStylesheetOption($stylesheetOption)
    {
        if (!is_string($stylesheetOption)) {
            throw MapException::invalidStylesheetOption();
        }

        return isset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * Gets the stylesheet options.
     *
     * @return array The stylesheet options.
     */
    public function getStylesheetOptions()
    {
        return $this->stylesheetOptions;
    }

    /**
     * Sets the stylesheet options.
     *
     * @param array $stylesheetOptions The stylesheet options.
     */
    public function setStylesheetOptions(array $stylesheetOptions)
    {
        foreach ($stylesheetOptions as $stylesheetOption => $value) {
            $this->setStylesheetOption($stylesheetOption, $value);
        }
    }

    /**
     * Gets a specific stylesheet option.
     *
     * @param string $stylesheetOption  The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option does not exist.
     *
     * @return mixed The stylesheet option value.
     */
    public function getStylesheetOption($stylesheetOption)
    {
        if (!$this->hasStylesheetOption($stylesheetOption)) {
            throw MapException::stylesheetOptionDoesNotExist($stylesheetOption);
        }

        return $this->stylesheetOptions[$stylesheetOption];
    }

    /**
     * Sets a specific stylesheet option.
     *
     * @param string $stylesheetOption The stylesheet option.
     * @param mixed  $value            The stylesheet option value.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option is not valid.
     */
    public function setStylesheetOption($stylesheetOption, $value)
    {
        if (!is_string($stylesheetOption)) {
            throw MapException::invalidStylesheetOption();
        }

        $this->stylesheetOptions[$stylesheetOption] = $value;
    }

    /**
     * Removes a stylesheet option.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option does not exist.
     */
    public function removeStylesheetOption($stylesheetOption)
    {
        if (!$this->hasStylesheetOption($stylesheetOption)) {
            throw MapException::stylesheetOptionDoesNotExist($stylesheetOption);
        }

        unset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * Checks if the map has a map type control.
     *
     * @return boolean TRUE if the map has a map type control else FALSE.
     */
    public function hasMapTypeControl()
    {
        return $this->mapTypeControl !== null;
    }

    /**
     * Gets the map type control.
     *
     * @return Ivory\GoogleMap\Controls\MapTypeControl The map type control.
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }

    /**
     * Sets the map type control.
     *
     * Available prototypes:
     *  - function setMapTypeControl(Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)
     *  - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map type control is not valid (prototypes).
     */
    public function setMapTypeControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof MapTypeControl)) {
            $this->mapTypeControl = $args[0];
            $this->mapOptions['mapTypeControl'] = true;
        } elseif ((isset($args[0]) && is_array($args[0]))
            && (isset($args[1]) && is_string($args[1]))
            && (isset($args[2]) && is_string($args[2]))
        ) {
            if ($this->mapTypeControl === null) {
                $this->mapTypeControl = new MapTypeControl();
            }

            $this->mapTypeControl->setMapTypeIds($args[0]);
            $this->mapTypeControl->setControlPosition($args[1]);
            $this->mapTypeControl->setMapTypeControlStyle($args[2]);

            $this->mapOptions['mapTypeControl'] = true;
        } elseif (!isset($args[0])) {
            $this->mapTypeControl = null;

            if (isset($this->mapOptions['mapTypeControl'])) {
                unset($this->mapOptions['mapTypeControl']);
            }
        } else {
            throw MapException::invalidMapTypeControl();
        }
    }

    /**
     * Checks if the map has an overview map control.
     *
     * @return boolean TRUE if the map has an overview map control else FALSE.
     */
    public function hasOverviewMapControl()
    {
        return $this->overviewMapControl !== null;
    }

    /**
     * Gets the overview map control.
     *
     * @return Ivory\GoogleMap\Controls\OverviewMapControl The overview map control.
     */
    public function getOverviewMapControl()
    {
        return $this->overviewMapControl;
    }

    /**
     * Sets the overview map control.
     *
     * Available prototypes:
     *  - function setOverviewMapControl(Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)
     *  - function setOverviewMapControl(boolean $opened)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the overview map control is not valid (prototypes).
     */
    public function setOverviewMapControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0]) instanceof OverviewMapControl) {
            $this->overviewMapControl = $args[0];
            $this->mapOptions['overviewMapControl'] = true;
        } elseif (isset($args[0]) && is_bool($args[0])) {
            if ($this->overviewMapControl === null) {
                $this->overviewMapControl = new OverviewMapControl();
            }

            $this->overviewMapControl->setOpened($args[0]);
            $this->mapOptions['overviewMapControl'] = true;
        } elseif (!isset($args[0])) {
            $this->overviewMapControl = null;

            if (isset($this->mapOptions['overviewMapControl'])) {
                unset($this->mapOptions['overviewMapControl']);
            }
        } else {
            throw MapException::invalidOverviewMapControl();
        }
    }

    /**
     * Checks if the map has a pan control.
     *
     * @return boolean TRUE if the map has a pan control else FALSE.
     */
    public function hasPanControl()
    {
        return $this->panControl !== null;
    }

    /**
     * Gets the map pan control.
     *
     * @return Ivory\GoogleMap\Controls\PanControl The map pan control.
     */
    public function getPanControl()
    {
        return $this->panControl;
    }

    /**
     * Sets the map pan control.
     *
     * Available prototypes:
     *  - function setPanControl(Ivory\GoogleMap\Controls\PanControl $panControl = null)
     *  - function setPanControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the pan control is not valid (prototypes).
     */
    public function setPanControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof PanControl)) {
            $this->panControl = $args[0];
            $this->mapOptions['panControl'] = true;
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->panControl === null) {
                $this->panControl = new PanControl();
            }

            $this->panControl->setControlPosition($args[0]);
            $this->mapOptions['panControl'] = true;
        } elseif (!isset($args[0])) {
            $this->panControl = null;

            if (isset($this->mapOptions['panControl'])) {
                unset($this->mapOptions['panControl']);
            }
        } else {
            throw MapException::invalidPanControl();
        }
    }

    /**
     * Checks if the map has a rotate control.
     *
     * @return boolean TRUE if the map has a rotate control else FALSE.
     */
    public function hasRotateControl()
    {
        return $this->rotateControl !== null;
    }

    /**
     * Gets the map rotate control.
     *
     * @return Ivory\GoogleMap\Controls\RotateControl The map rotate control.
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }

    /**
     * Sets the map rotate control.
     *
     * Available prototypes:
     *  - function setRotateControl(Ivory\GoogleMap\Controls\RotateControl $rotateControl = null)
     *  - function setRotateControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the rotate control is not valid (prototypes).
     */
    public function setRotateControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof RotateControl)) {
            $this->rotateControl = $args[0];
            $this->mapOptions['rotateControl'] = true;
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->rotateControl === null) {
                $this->rotateControl = new RotateControl();
            }

            $this->rotateControl->setControlPosition($args[0]);
            $this->mapOptions['rotateControl'] = true;
        } elseif (!isset($args[0])) {
            $this->rotateControl = null;

            if (isset($this->mapOptions['rotateControl'])) {
                unset($this->mapOptions['rotateControl']);
            }
        } else {
            throw MapException::invalidRotateControl();
        }
    }

    /**
     * Checks if the map has a scale control else FALSE.
     *
     * @return boolean TRUE if the map has a scale control else FALSE.
     */
    public function hasScaleControl()
    {
        return $this->scaleControl !== null;
    }

    /**
     * Gets the map scale control.
     *
     * @return Ivory\GoogleMap\Controls\ScaleControl The map scale control.
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }

    /**
     * Sets the map scale control.
     *
     * Available prototypes:
     *  - function setScaleControl(Ivory\GoogleMap\Controls\ScaleControl $scaleControl = null)
     *  - function setScaleControl(string $controlPosition, string $scaleControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the scale control is not valid (prototypes).
     */
    public function setScaleControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof ScaleControl)) {
            $this->scaleControl = $args[0];
            $this->mapOptions['scaleControl'] = true;
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_string($args[1]))) {
            if ($this->scaleControl === null) {
                $this->scaleControl = new ScaleControl();
            }

            $this->scaleControl->setControlPosition($args[0]);
            $this->scaleControl->setScaleControlStyle($args[1]);

            $this->mapOptions['scaleControl'] = true;
        } elseif (!isset($args[0])) {
            $this->scaleControl = null;

            if (isset($this->mapOptions['scaleControl'])) {
                unset($this->mapOptions['scaleControl']);
            }
        } else {
            throw MapException::invalidScaleControl();
        }
    }

    /**
     * Checks if the map has a street view control.
     *
     * @return boolean TRUE if the map has a street view control else FALSE.
     */
    public function hasStreetViewControl()
    {
        return $this->streetViewControl !== null;
    }

    /**
     * Gets the map street view control.
     *
     * @return Ivory\GoogleMap\Controls\StreetViewControl The map street view control.
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }

    /**
     * Sets the map street view control.
     *
     * Available prototypes:
     *  - function setStreetViewControl(Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl = null)
     *  - function setStreetViewControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the street view control is not valid (prototypes).
     */
    public function setStreetViewControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof StreetViewControl)) {
            $this->streetViewControl = $args[0];
            $this->mapOptions['streetViewControl'] = true;
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->streetViewControl === null) {
                $this->streetViewControl = new StreetViewControl();
            }

            $this->streetViewControl->setControlPosition($args[0]);
            $this->mapOptions['streetViewControl'] = true;
        } elseif (!isset($args[0])) {
            $this->streetViewControl = null;

            if (isset($this->mapOptions['streetViewControl'])) {
                unset($this->mapOptions['streetViewControl']);
            }
        } else {
            throw MapException::invalidStreetViewControl();
        }
    }

    /**
     * Checks if the map has a zoom control.
     *
     * @return boolean TRUE if the map has a zoom control else FALSE.
     */
    public function hasZoomControl()
    {
        return $this->zoomControl !== null;
    }

    /**
     * Gets the map zoom control.
     *
     * @return Ivory\GoogleMap\Controls\ZoomControl The map zoom control.
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }

    /**
     * Sets the map zoom control.
     *
     * Available prototypes:
     *  - function setZoomControl(Ivory\GoogleMap\Controls\ZoomControl $zoomControl = null)
     *  - function setZoomControl(string $controlPosition, string $zoomControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the zoom control is not valid (prototypes).
     */
    public function setZoomControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof ZoomControl)) {
            $this->zoomControl = $args[0];
            $this->mapOptions['zoomControl'] = true;
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_string($args[1]))) {
            if ($this->zoomControl === null) {
                $this->zoomControl = new ZoomControl();
            }

            $this->zoomControl->setControlPosition($args[0]);
            $this->zoomControl->setZoomControlStyle($args[1]);

            $this->mapOptions['zoomControl'] = true;
        } elseif (!isset($args[0])) {
            $this->zoomControl = null;

            if (isset($this->mapOptions['zoomControl'])) {
                unset($this->mapOptions['zoomControl']);
            }
        } else {
            throw MapException::invalidZoomControl();
        }
    }

    /**
     * Gets the map event manager.
     *
     * @return \Ivory\GoogleMap\Events\EventManager The map event manager.
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * Sets the map event manager.
     *
     * @param Ivory\GoogleMap\Events\EventManager $eventManager The map event manager.
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Gets the map markers.
     *
     * @return array The map markers.
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Add a map marker.
     *
     * @param Ivory\GoogleMap\Overlays\Marker $marker The marker to add.
     */
    public function addMarker(Marker $marker)
    {
        $this->markers[] = $marker;

        if ($this->autoZoom) {
            $this->bound->extend($marker);
        }
    }

    /**
     * Gets the map info windows.
     *
     * @return array The map info windows.
     */
    public function getInfoWindows()
    {
        return $this->infoWindows;
    }

    /**
     * Add a map info window.
     *
     * @param Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window to add.
     */
    public function addInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindows[] = $infoWindow;

        if ($this->autoZoom) {
            $this->bound->extend($infoWindow);
        }
    }

    /**
     * Gets the map polylines.
     *
     * @return Ivory\GoogleMap\Overlays\Polyline The map polylines.
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * Add a map polyline.
     *
     * @param Ivory\GoogleMap\Overlays\Polyline The polyline to add.
     */
    public function addPolyline(Polyline $polyline)
    {
        $this->polylines[] = $polyline;

        if ($this->autoZoom) {
            $this->bound->extend($polyline);
        }
    }

    /**
     * Gets the map encoded polylines.
     *
     * @return array The map encoded polylines.
     */
    public function getEncodedPolylines()
    {
        return $this->encodedPolylines;
    }

    /**
     * Adds an encoded polyline to the map.
     *
     * @param Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline to add.
     */
    public function addEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        $this->encodedPolylines[] = $encodedPolyline;

        if ($this->autoZoom) {
            $this->bound->extend($encodedPolyline);
        }
    }

    /**
     * Gets the map polygons.
     *
     * @return array The map polygons.
     */
    public function getPolygons()
    {
        return $this->polygons;
    }

    /**
     * Add a map polygon.
     *
     * @param Ivory\GoogleMap\Overlays\Polygon $polygon The polygon to add.
     */
    public function addPolygon(Polygon $polygon)
    {
        $this->polygons[] = $polygon;

        if ($this->autoZoom) {
            $this->bound->extend($polygon);
        }
    }

    /**
     * Gets the map rectangles.
     *
     * @return array The map rectangles.
     */
    public function getRectangles()
    {
        return $this->rectangles;
    }

    /**
     * Add a map rectangle to the map.
     *
     * @param Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle to add.
     */
    public function addRectangle(Rectangle $rectangle)
    {
        $this->rectangles[] = $rectangle;

        if ($this->autoZoom) {
            $this->bound->extend($rectangle);
        }
    }

    /**
     * Gets the map circles
     *
     * @return array The map circles.
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * Add a circle to the map.
     *
     * @param Ivory\GoogleMap\Overlays\Circle $circle The circle to add.
     */
    public function addCircle(Circle $circle)
    {
        $this->circles[] = $circle;

        if ($this->autoZoom) {
            $this->bound->extend($circle);
        }
    }

    /**
     * Gets the map ground overlays.
     *
     * @return array The map ground overlays.
     */
    public function getGroundOverlays()
    {
        return $this->groundOverlays;
    }

    /**
     * Add a ground overlay to the map.
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\GroupOverlay $groundOverlay The ground overlay to add.
     */
    public function addGroundOverlay(GroundOverlay $groundOverlay)
    {
        $this->groundOverlays[] = $groundOverlay;

        if ($this->autoZoom) {
            $this->bound->extend($groundOverlay);
        }
    }

    /**
     * Gets the KML layers.
     *
     * @return array The KML layers.
     */
    public function getKMLLayers()
    {
        return $this->kmlLayers;
    }

    /**
     * Adds a KML Layer to the map.
     *
     * @param Ivory\GoogleMap\Layers\KMLLayer $kmlLayer The KML Layer to add.
     */
    public function addKMLLayer(KMLLayer $kmlLayer)
    {
        $this->kmlLayers[] = $kmlLayer;
    }

    /**
     * Checks if the map has libraries.
     *
     * @return boolean TRUE if the map has libraries else FALSE.
     */
    public function hasLibraries()
    {
        return !empty($this->libraries);
    }

    /**
     * Gets the map libraries.
     *
     * @return array The map libraries.
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * Sets the map libraries.
     *
     * @param array $libraries The map libraries.
     */
    public function setLibraries(array $libraries)
    {
        $this->libraries = $libraries;
    }

    /**
     * Gets the map language.
     *
     * @return string The map language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the map langauge.
     *
     * @param string $language The map langauge.
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
