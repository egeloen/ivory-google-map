<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

/**
 * Api event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEvent extends AbstractEvent
{
    const MAP = 'Ivory\GoogleMap\Map';
    const PLACES_AUTOCOMPLETE = 'Ivory\GoogleMap\Places\Autocomplete';

    /** @var array */
    private $items;

    /** @var string */
    private $language = 'en';

    /** @var array */
    private $sources = array();

    /** @var array */
    private $libraries = array();

    /** @var array */
    private $callbacks = array();

    /**
     * Creates an api event.
     *
     * @param array $items The items.
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Checks if there are items.
     *
     * @param string|null $class The item class.
     *
     * @return boolean TRUE if there are items else FALSE.
     */
    public function hasItems($class = null)
    {
        $items = $this->getItems($class);

        return !empty($items);
    }

    /**
     * Gets the items.
     *
     * @param string|null $class The items class.
     *
     * @return array The items.
     */
    public function getItems($class = null)
    {
        if ($class === null) {
            return $this->items;
        }

        $items = array();
        foreach ($this->items as $item) {
            if ($item instanceof $class) {
                $items[] = $item;
            }
        }

        return $items;
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
     * Sets the language.
     *
     * @param string $language The language.
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Resets the sources.
     */
    public function resetSources()
    {
        $this->sources = array();
    }

    /**
     * Checks if there are sources.
     *
     * @return boolean TRUE if there are sources else FALSE.
     */
    public function hasSources()
    {
        return !empty($this->sources);
    }

    /**
     * Gets the sources.
     *
     * @return array The sources.
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * Sets the sources.
     *
     * @param array $sources The sources.
     */
    public function setSources(array $sources)
    {
        $this->resetSources();
        $this->addSources($sources);
    }

    /**
     * Adds the sources.
     *
     * @param array $sources The sources.
     */
    public function addSources(array $sources)
    {
        foreach ($sources as $source) {
            $this->addSource($source);
        }
    }

    /**
     * Removes the sources.
     *
     * @param array $sources The sources.
     */
    public function removeSources(array $sources)
    {
        foreach ($sources as $source) {
            $this->removeSource($source);
        }
    }

    /**
     * Check if there is a source.
     *
     * @param string $source The source.
     *
     * @return boolean TRUE if there is the source else FALSE.
     */
    public function hasSource($source)
    {
        return in_array($source, $this->sources, true);
    }

    /**
     * Adds a source.
     *
     * @param string $source The source.
     */
    public function addSource($source)
    {
        if (!in_array($source, $this->sources, true)) {
            $this->sources[] = $source;
        }
    }

    /**
     * Removes a source.
     *
     * @param string $source The source.
     */
    public function removeSource($source)
    {
        unset($this->sources[array_search($source, $this->sources, true)]);
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
        if (!in_array($library, $this->libraries, true)) {
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

    /**
     * Resets the callbacks.
     */
    public function resetCallbacks()
    {
        $this->callbacks = array();
    }

    /**
     * Checks if there are callbacks.
     *
     * @return boolean TRUE if there are callbacks else FALSE.
     */
    public function hasCallbacks()
    {
        return !empty($this->callbacks);
    }

    /**
     * Gets the callbacks.
     *
     * @return array The callbacks.
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * Sets the callbacks.
     *
     * @param array $callbacks The callbacks.
     */
    public function setCallbacks(array $callbacks)
    {
        $this->resetCallbacks();
        $this->addCallbacks($callbacks);
    }

    /**
     * Adds the callbacks.
     *
     * @param array $callbacks The callbacks.
     */
    public function addCallbacks(array $callbacks)
    {
        foreach ($callbacks as $callback) {
            $this->addCallback($callback);
        }
    }

    /**
     * Removes the callbacks.
     *
     * @param array $callbacks The callbacks.
     */
    public function removeCallbacks(array $callbacks)
    {
        foreach ($callbacks as $callback) {
            $this->removeCallback($callback);
        }
    }

    /**
     * Checks if there is a callback.
     *
     * @param string $callback The callback.
     *
     * @return boolean TRUE if there is the callback else FALSE.
     */
    public function hasCallback($callback)
    {
        return in_array($callback, $this->callbacks, true);
    }

    /**
     * Adds a callback.
     *
     * @param string $callback The callback.
     */
    public function addCallback($callback)
    {
        if (!in_array($callback, $this->callbacks, true)) {
            $this->callbacks[] = $callback;
        }
    }

    /**
     * Removes a callback.
     *
     * @param string $callback The callback.
     */
    public function removeCallback($callback)
    {
        unset($this->callbacks[array_search($callback, $this->callbacks, true)]);
    }
}
