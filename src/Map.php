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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map implements VariableAwareInterface, StaticOptionsAwareInterface
{
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $htmlId = 'map_canvas';

    /**
     * @var bool
     */
    private $autoZoom = false;

    /**
     * @var Coordinate
     */
    private $center;

    /**
     * @var Bound
     */
    private $bound;

    /**
     * @var ControlManager
     */
    private $controlManager;

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var LayerManager
     */
    private $layerManager;

    /**
     * @var OverlayManager
     */
    private $overlayManager;

    /**
     * @var string[]
     */
    private $libraries = [];

    /**
     * @var mixed[]
     */
    private $mapOptions = [];

    /**
     * @var string[]
     */
    private $stylesheetOptions = [];

    /**
     * @var string[]
     */
    private $htmlAttributes = [];

    public function __construct()
    {
        $this->setCenter(new Coordinate());
        $this->setBound(new Bound());
        $this->setControlManager(new ControlManager());
        $this->setEventManager(new EventManager());
        $this->setOverlayManager(new OverlayManager());
        $this->setLayerManager(new LayerManager());
    }

    /**
     * @return string
     */
    public function getHtmlId()
    {
        return $this->htmlId;
    }

    /**
     * @param string $htmlId
     */
    public function setHtmlId($htmlId)
    {
        $this->htmlId = $htmlId;
    }

    /**
     * @return bool
     */
    public function isAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * @param bool $autoZoom
     */
    public function setAutoZoom($autoZoom)
    {
        $this->autoZoom = $autoZoom;
    }

    /**
     * @return Coordinate
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * @param Coordinate $center
     */
    public function setCenter(Coordinate $center)
    {
        $this->center = $center;
    }

    /**
     * @return Bound
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound $bound
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * @return ControlManager
     */
    public function getControlManager()
    {
        return $this->controlManager;
    }

    /**
     * @param ControlManager $controlManager
     */
    public function setControlManager(ControlManager $controlManager)
    {
        $this->controlManager = $controlManager;
    }

    /**
     * @return EventManager
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * @param EventManager $eventManager
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @return LayerManager
     */
    public function getLayerManager()
    {
        return $this->layerManager;
    }

    /**
     * @param LayerManager $layerManager
     */
    public function setLayerManager(LayerManager $layerManager)
    {
        $this->layerManager = $layerManager;

        if ($layerManager->getMap() !== $this) {
            $layerManager->setMap($this);
        }
    }

    /**
     * @return OverlayManager
     */
    public function getOverlayManager()
    {
        return $this->overlayManager;
    }

    /**
     * @param OverlayManager $overlayManager
     */
    public function setOverlayManager(OverlayManager $overlayManager)
    {
        $this->overlayManager = $overlayManager;

        if ($overlayManager->getMap() !== $this) {
            $overlayManager->setMap($this);
        }
    }

    /**
     * @return bool
     */
    public function hasLibraries()
    {
        return !empty($this->libraries);
    }

    /**
     * @return string[]
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * @param string[] $libraries
     */
    public function setLibraries(array $libraries)
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /**
     * @param string[] $libraries
     */
    public function addLibraries(array $libraries)
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    /**
     * @param string $library
     *
     * @return bool
     */
    public function hasLibrary($library)
    {
        return in_array($library, $this->libraries, true);
    }

    /**
     * @param string $library
     */
    public function addLibrary($library)
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    /**
     * @param string $library
     */
    public function removeLibrary($library)
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
        $this->libraries = empty($this->libraries) ? [] : array_values($this->libraries);
    }

    /**
     * @return bool
     */
    public function hasMapOptions()
    {
        return !empty($this->mapOptions);
    }

    /**
     * @return mixed[]
     */
    public function getMapOptions()
    {
        return $this->mapOptions;
    }

    /**
     * @param mixed[] $mapOptions
     */
    public function setMapOptions(array $mapOptions)
    {
        $this->mapOptions = [];
        $this->addMapOptions($mapOptions);
    }

    /**
     * @param mixed[] $mapOptions
     */
    public function addMapOptions(array $mapOptions)
    {
        foreach ($mapOptions as $mapOption => $value) {
            $this->setMapOption($mapOption, $value);
        }
    }

    /**
     * @param string $mapOption
     *
     * @return bool
     */
    public function hasMapOption($mapOption)
    {
        return isset($this->mapOptions[$mapOption]);
    }

    /**
     * @param string $mapOption
     *
     * @return mixed
     */
    public function getMapOption($mapOption)
    {
        return $this->hasMapOption($mapOption) ? $this->mapOptions[$mapOption] : null;
    }

    /**
     * @param string $mapOption
     * @param mixed  $value
     */
    public function setMapOption($mapOption, $value)
    {
        $this->mapOptions[$mapOption] = $value;
    }

    /**
     * @param string $mapOption
     */
    public function removeMapOption($mapOption)
    {
        unset($this->mapOptions[$mapOption]);
    }

    /**
     * @return bool
     */
    public function hasStylesheetOptions()
    {
        return !empty($this->stylesheetOptions);
    }

    /**
     * @return string[]
     */
    public function getStylesheetOptions()
    {
        return $this->stylesheetOptions;
    }

    /**
     * @param string[] $stylesheetOptions
     */
    public function setStylesheetOptions(array $stylesheetOptions)
    {
        $this->stylesheetOptions = [];
        $this->addStylesheetOptions($stylesheetOptions);
    }

    /**
     * @param string[] $stylesheetOptions
     */
    public function addStylesheetOptions(array $stylesheetOptions)
    {
        foreach ($stylesheetOptions as $stylesheetOption => $value) {
            $this->setStylesheetOption($stylesheetOption, $value);
        }
    }

    /**
     * @param string $stylesheetOption
     *
     * @return bool
     */
    public function hasStylesheetOption($stylesheetOption)
    {
        return isset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * @param string $stylesheetOption
     *
     * @return string|null
     */
    public function getStylesheetOption($stylesheetOption)
    {
        return $this->hasStylesheetOption($stylesheetOption) ? $this->stylesheetOptions[$stylesheetOption] : null;
    }

    /**
     * @param string $stylesheetOption
     * @param string $value
     */
    public function setStylesheetOption($stylesheetOption, $value)
    {
        $this->stylesheetOptions[$stylesheetOption] = $value;
    }

    /**
     * @param string $stylesheetOption
     */
    public function removeStylesheetOption($stylesheetOption)
    {
        unset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * @return bool
     */
    public function hasHtmlAttributes()
    {
        return !empty($this->htmlAttributes);
    }

    /**
     * @return string[]
     */
    public function getHtmlAttributes()
    {
        return $this->htmlAttributes;
    }

    /**
     * @param string[] $htmlAttributes
     */
    public function setHtmlAttributes(array $htmlAttributes)
    {
        $this->htmlAttributes = [];
        $this->addHtmlAttributes($htmlAttributes);
    }

    /**
     * @param string[] $htmlAttributes
     */
    public function addHtmlAttributes(array $htmlAttributes)
    {
        foreach ($htmlAttributes as $htmlAttribute => $value) {
            $this->setHtmlAttribute($htmlAttribute, $value);
        }
    }

    /**
     * @param string $htmlAttribute
     *
     * @return bool
     */
    public function hasHtmlAttribute($htmlAttribute)
    {
        return isset($this->htmlAttributes[$htmlAttribute]);
    }

    /**
     * @param string $htmlAttribute
     *
     * @return string|null
     */
    public function getHtmlAttribute($htmlAttribute)
    {
        return $this->hasHtmlAttribute($htmlAttribute) ? $this->htmlAttributes[$htmlAttribute] : null;
    }

    /**
     * @param string $htmlAttribute
     * @param string $value
     */
    public function setHtmlAttribute($htmlAttribute, $value)
    {
        $this->htmlAttributes[$htmlAttribute] = $value;
    }

    /**
     * @param string $htmlAttribute
     */
    public function removeHtmlAttribute($htmlAttribute)
    {
        unset($this->htmlAttributes[$htmlAttribute]);
    }
}
