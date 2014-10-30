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

use Ivory\GoogleMap\Assets\AbstractVariableAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Controls\Controls;
use Ivory\GoogleMap\Events\Events;
use Ivory\GoogleMap\Layers\Layers;
use Ivory\GoogleMap\Overlays\Overlays;

/**
 * Map.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends AbstractVariableAsset
{
    /** @var string */
    private $htmlContainerId;

    /** @var \Ivory\GoogleMap\Base\Coordinate|null */
    private $center;

    /** @var \Ivory\GoogleMap\Base\Bound|null */
    private $bound;

    /** @var \Ivory\GoogleMap\Controls\Controls */
    private $controls;

    /** @var \Ivory\GoogleMap\Events\Events */
    private $events;

    /** @var \Ivory\GoogleMap\Layers\Layers */
    private $layers;

    /** @var \Ivory\GoogleMap\Overlays\Overlays */
    private $overlays;

    /** @var array */
    private $mapOptions = array();

    /** @var array */
    private $stylesheetOptions = array();

    /** @var string */
    private $language = 'en';

    /** @var array */
    private $libraries = array();

    /**
     * Creates a map.
     */
    public function __construct()
    {
        parent::__construct('map_');

        $this->setHtmlContainerId($this->getVariable());
        $this->setCenter(new Coordinate(0, 0));
        $this->setBound(new Bound());
        $this->setControls(new Controls());
        $this->setEvents(new Events());
        $this->setLayers(new Layers());
        $this->setOverlays(new Overlays());
    }

    /**
     * Gets the html container id.
     *
     * @return string The html constainer id.
     */
    public function getHtmlContainerId()
    {
        return $this->htmlContainerId;
    }

    /**
     * Sets the html container id.
     *
     * @param string $htmlContainerId The html container id.
     */
    public function setHtmlContainerId($htmlContainerId)
    {
        $this->htmlContainerId = $htmlContainerId;
    }

    /**
     * Gets the center.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|null The center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the center.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $center The center.
     */
    public function setCenter(Coordinate $center)
    {
        $this->center = $center;
    }

    /**
     * Gets the bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound|null The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * Gets the controls.
     *
     * @return \Ivory\GoogleMap\Controls\Controls The controls.
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * Sets the controls.
     *
     * @param \Ivory\GoogleMap\Controls\Controls $controls The controls.
     */
    public function setControls(Controls $controls)
    {
        $this->controls = $controls;
    }

    /**
     * Gets the events.
     *
     * @return \Ivory\GoogleMap\Events\Events The events.
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Sets the events.
     *
     * @param \Ivory\GoogleMap\Events\Events $events The events.
     */
    public function setEvents(Events $events)
    {
        $this->events = $events;
    }

    /**
     * Gets the layers.
     *
     * @return \Ivory\GoogleMap\Layers\Layers The layers.
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Sets the layers.
     *
     * @param \Ivory\GoogleMap\Layers\Layers $layers The layers.
     */
    public function setLayers(Layers $layers)
    {
        $this->layers = $layers;
    }

    /**
     * Gets the overlays.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays The overlays.
     */
    public function getOverlays()
    {
        return $this->overlays;
    }

    /**
     * Sets the overlays.
     *
     * @param \Ivory\GoogleMap\Overlays\Overlays $overlays The overlays.
     */
    public function setOverlays(Overlays $overlays)
    {
        $this->overlays = $overlays;
    }

    /**
     * Resets the map options.
     */
    public function resetMapOptions()
    {
        $this->mapOptions = array();
    }

    /**
     * Checks if there are map options.
     *
     * @return boolean TRUE if there are map options else FALSE.
     */
    public function hasMapOptions()
    {
        return !empty($this->mapOptions);
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
        $this->resetMapOptions();
        $this->addMapOptions($mapOptions);
    }

    /**
     * Adds the map options.
     *
     * @param array $mapOptions The map options.
     */
    public function addMapOptions(array $mapOptions)
    {
        foreach ($mapOptions as $name => $value) {
            $this->setMapOption($name, $value);
        }
    }

    /**
     * Removes the map options.
     *
     * @param array $names The map option names.
     */
    public function removeMapOptions(array $names)
    {
        foreach ($names as $name) {
            $this->removeMapOption($name);
        }
    }

    /**
     * Checks if there is a map option.
     *
     * @param string $name The map option name.
     *
     * @return boolean TRUE if there is the map option else FALSE.
     */
    public function hasMapOption($name)
    {
        return array_key_exists($name, $this->mapOptions);
    }

    /**
     * Gets a map option.
     *
     * @param string $name The map option name.
     *
     * @return mixed The map option value.
     */
    public function getMapOption($name)
    {
        return $this->hasMapOption($name) ? $this->mapOptions[$name] : null;
    }

    /**
     * Sets a map option
     *
     * @param string $name  The map option name.
     * @param mixed  $value The map option value.
     */
    public function setMapOption($name, $value)
    {
        $this->mapOptions[$name] = $value;
    }

    /**
     * Removes a map option.
     *
     * @param string $name The map option name.
     */
    public function removeMapOption($name)
    {
        unset($this->mapOptions[$name]);
    }

    /**
     * Resets the stylesheet options.
     */
    public function resetStylesheetOptions()
    {
        $this->stylesheetOptions = array();
    }

    /**
     * Checks if there are stylesheet options.
     *
     * @return boolean TRUE if there are stylesheet options else FALSE.
     */
    public function hasStylesheetOptions()
    {
        return !empty($this->stylesheetOptions);
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
        $this->resetStylesheetOptions();
        $this->addStylesheetOptions($stylesheetOptions);
    }

    /**
     * Adds the stylesheet options.
     *
     * @param array $stylesheetOptions The stylesheet options.
     */
    public function addStylesheetOptions(array $stylesheetOptions)
    {
        foreach ($stylesheetOptions as $name => $value) {
            $this->setStylesheetOption($name, $value);
        }
    }

    /**
     * Removes the stylesheet options.
     *
     * @param array $names The stylesheet option names.
     */
    public function removeStylesheetOptions(array $names)
    {
        foreach ($names as $name) {
            $this->removeStylesheetOption($name);
        }
    }

    /**
     * Checks if there is a stylesheet option.
     *
     * @param string $name The stylesheet option name.
     *
     * @return boolean TRUE if there is the stylesheet option else FALSE.
     */
    public function hasStylesheetOption($name)
    {
        return array_key_exists($name, $this->stylesheetOptions);
    }

    /**
     * Gets a stylesheet option.
     *
     * @param string $name The stylesheet option name.
     *
     * @return mixed The stylesheet option value.
     */
    public function getStylesheetOption($name)
    {
        return $this->hasStylesheetOption($name) ? $this->stylesheetOptions[$name] : null;
    }

    /**
     * Sets a stylesheet option.
     *
     * @param string $name  The stylesheet option name.
     * @param mixed  $value The stylesheet option value.
     */
    public function setStylesheetOption($name, $value)
    {
        $this->stylesheetOptions[$name] = $value;
    }

    /**
     * Removes a stylesheet option.
     *
     * @param string $name The stylesheet option name.
     */
    public function removeStylesheetOption($name)
    {
        unset($this->stylesheetOptions[$name]);
    }

    /**
     * Gets the language.
     *
     * @return string The language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the langauge.
     *
     * @param string $language The langauge.
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Resets the libraries.
     */
    public function resetLibraries()
    {
        $this->libraries = array();
    }

    /**
     * Checks if there are libraries.
     *
     * @return boolean TRUE if there are libraries else FALSE.
     */
    public function hasLibraries()
    {
        return !empty($this->libraries);
    }

    /**
     * Gets the libraries.
     *
     * @return array The libraries.
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * Sets the libraries.
     *
     * @param array $libraries The libraries.
     */
    public function setLibraries(array $libraries)
    {
        $this->resetLibraries();
        $this->addLibraries($libraries);
    }

    /**
     * Adds the libraries.
     *
     * @param array $libraries The libraries.
     */
    public function addLibraries(array $libraries)
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    /**
     * Removes the libraries.
     *
     * @param array $libraries The libraries.
     */
    public function removeLibraries(array $libraries)
    {
        foreach ($libraries as $library) {
            $this->removeLibrary($library);
        }
    }

    /**
     * Checks if there is a library.
     *
     * @param string $library The library.
     *
     * @return boolean TRUE if there is the library else FALSE.
     */
    public function hasLibrary($library)
    {
        return in_array($library, $this->libraries, true);
    }

    /**
     * Adds a library.
     *
     * @param string $library The library.
     */
    public function addLibrary($library)
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    /**
     * Removes a library.
     *
     * @param string $library The library.
     */
    public function removeLibrary($library)
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
    }
}
