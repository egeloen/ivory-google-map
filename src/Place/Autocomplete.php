<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Place;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Autocomplete implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $inputId = 'place_input';

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var Bound|null
     */
    private $bound;

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @var mixed[]
     */
    private $components = [];

    /**
     * @var string
     */
    private $value;

    /**
     * @var string[]
     */
    private $inputAttributes = [];

    /**
     * @var string[]
     */
    private $libraries = [];

    public function __construct()
    {
        $this->setEventManager(new EventManager());
    }

    /**
     * @return string
     */
    public function getHtmlId()
    {
        return $this->inputId;
    }

    /**
     * @param string $inputId
     */
    public function setInputId($inputId)
    {
        $this->inputId = $inputId;
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
     * @return bool
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }

    /**
     * @return bool
     */
    public function hasTypes()
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types)
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType($type)
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type)
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type)
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }

    /**
     * @return bool
     */
    public function hasComponents()
    {
        return !empty($this->components);
    }

    /**
     * @return mixed[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param mixed[] $components
     */
    public function setComponents(array $components)
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param mixed[] $components
     */
    public function addComponents(array $components)
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasComponent($type)
    {
        return isset($this->components[$type]);
    }

    /**
     * @param string $type
     *
     * @return mixed
     */
    public function getComponent($type)
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    /**
     * @param string $type
     * @param mixed  $value
     */
    public function setComponent($type, $value)
    {
        $this->components[$type] = $value;
    }

    /**
     * @param string $type
     */
    public function removeComponent($type)
    {
        unset($this->components[$type]);
    }

    /**
     * @return bool
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function hasInputAttributes()
    {
        return !empty($this->inputAttributes);
    }

    /**
     * @return string[]
     */
    public function getInputAttributes()
    {
        return $this->inputAttributes;
    }

    /**
     * @param string[] $inputAttributes
     */
    public function setInputAttributes(array $inputAttributes)
    {
        $this->inputAttributes = [];
        $this->addInputAttributes($inputAttributes);
    }

    /**
     * @param string[] $inputAttributes
     */
    public function addInputAttributes(array $inputAttributes)
    {
        foreach ($inputAttributes as $name => $value) {
            $this->setInputAttribute($name, $value);
        }
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasInputAttribute($name)
    {
        return isset($this->inputAttributes[$name]);
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    public function getInputAttribute($name)
    {
        return $this->hasInputAttribute($name) ? $this->inputAttributes[$name] : null;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setInputAttribute($name, $value)
    {
        $this->inputAttributes[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeInputAttribute($name)
    {
        unset($this->inputAttributes[$name]);
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
}
