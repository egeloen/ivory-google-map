<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEvent extends AbstractEvent
{
    /**
     * @var object[]
     */
    private $objects;

    /**
     * @var string[]
     */
    private $sources = [];

    /**
     * @var string[]
     */
    private $libraries = [];

    /**
     * @var \SplObjectStorage
     */
    private $callbacks;

    /**
     * @var \SplObjectStorage
     */
    private $requirements;

    /**
     * @param object[] $objects
     */
    public function __construct(array $objects)
    {
        $this->objects = $objects;
        $this->callbacks = new \SplObjectStorage();
        $this->requirements = new \SplObjectStorage();
    }

    /**
     * @param string|null $class
     *
     * @return bool
     */
    public function hasObjects($class = null)
    {
        $objects = $this->getObjects($class);

        return !empty($objects);
    }

    /**
     * @param string|null $class
     *
     * @return object[]
     */
    public function getObjects($class = null)
    {
        if ($class === null) {
            return $this->objects;
        }

        $objects = [];

        foreach ($this->objects as $object) {
            if ($object instanceof $class) {
                $objects[] = $object;
            }
        }

        return $objects;
    }

    /**
     * @return bool
     */
    public function hasSources()
    {
        return !empty($this->sources);
    }

    /**
     * @return string[]
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param string[] $sources
     */
    public function setSources(array $sources)
    {
        $this->sources = [];
        $this->addSources($sources);
    }

    /**
     * @param string[] $sources
     */
    public function addSources(array $sources)
    {
        foreach ($sources as $source) {
            $this->addSource($source);
        }
    }

    /**
     * @param string $source
     *
     * @return bool
     */
    public function hasSource($source)
    {
        return in_array($source, $this->sources, true);
    }

    /**
     * @param string $source
     */
    public function addSource($source)
    {
        if (!$this->hasSource($source)) {
            $this->sources[] = $source;
        }
    }

    /**
     * @param string $source
     */
    public function removeSource($source)
    {
        unset($this->sources[array_search($source, $this->sources, true)]);
        $this->sources = empty($this->sources) ? [] : array_values($this->sources);
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
    public function hasCallbacks()
    {
        return count($this->callbacks) > 0;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * @param string      $callback
     * @param object|null $object
     *
     * @return bool
     */
    public function hasCallback($callback, $object = null)
    {
        foreach ($this->callbacks as $rawObject) {
            if ($this->callbacks[$rawObject] === $callback && ($object === null || $object === $rawObject)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param object      $object
     * @param string|null $callback
     *
     * @return bool
     */
    public function hasCallbackObject($object, $callback = null)
    {
        return isset($this->callbacks[$object]) && ($callback === null || $this->callbacks[$object] === $callback);
    }

    /**
     * @param $object
     *
     * @return string|null
     */
    public function getCallback($object)
    {
        return $this->hasCallbackObject($object) ? $this->callbacks[$object] : null;
    }

    /**
     * @param string $callback
     *
     * @return object
     */
    public function getCallbackObject($callback)
    {
        foreach ($this->callbacks as $object) {
            if ($this->callbacks[$object] === $callback) {
                return $object;
            }
        }
    }

    /**
     * @param object $object
     * @param string $callback
     */
    public function addCallback($object, $callback)
    {
        if (!$this->hasCallback($callback, $object)) {
            $this->callbacks[$object] = $callback;
        }
    }

    /**
     * @param object $object
     */
    public function removeCallbackObject($object)
    {
        unset($this->callbacks[$object]);
    }

    /**
     * @param string $callback
     */
    public function removeCallback($callback)
    {
        if ($this->hasCallback($callback)) {
            $this->removeCallbackObject($this->getCallbackObject($callback));
        }
    }

    /**
     * @param object|null $object
     *
     * @return bool
     */
    public function hasRequirements($object = null)
    {
        if ($object === null) {
            return count($this->requirements) > 0;
        }

        $requirements = $this->getRequirementsObject($object);

        return !empty($requirements);
    }

    /**
     * @return \SplObjectStorage
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @param object $object
     *
     * @return string[]
     */
    public function getRequirementsObject($object)
    {
        return $this->hasRequirement($object) ? $this->requirements[$object] : [];
    }

    /**
     * @param object   $object
     * @param string[] $requirements
     */
    public function setRequirements($object, array $requirements)
    {
        $this->requirements = new \SplObjectStorage();
        $this->addRequirements($object, $requirements);
    }

    /**
     * @param object   $object
     * @param string[] $requirements
     */
    public function addRequirements($object, array $requirements)
    {
        foreach ($requirements as $requirement) {
            $this->addRequirement($object, $requirement);
        }
    }

    /**
     * @param object      $object
     * @param string|null $requirement
     *
     * @return bool
     */
    public function hasRequirement($object, $requirement = null)
    {
        return isset($this->requirements[$object])
            && ($requirement === null || in_array($requirement, $this->requirements[$object], true));
    }

    /**
     * @param object $object
     * @param string $requirement
     */
    public function addRequirement($object, $requirement)
    {
        if (!$this->hasRequirement($object)) {
            $this->requirements[$object] = [];
        }

        if (!$this->hasRequirement($object, $requirement)) {
            $this->requirements[$object] = array_merge(
                $this->requirements[$object],
                [$requirement]
            );
        }
    }

    /**
     * @param object      $object
     * @param string|null $requirement
     */
    public function removeRequirement($object, $requirement = null)
    {
        if ($requirement === null) {
            unset($this->requirements[$object]);

            return;
        }

        if ($this->hasRequirement($object, $requirement)) {
            $requirements = $this->requirements[$object];
            unset($requirements[array_search($requirement, $requirements, true)]);

            if (!empty($requirements)) {
                $this->requirements[$object] = array_values($requirements);
            } else {
                $this->removeRequirement($object);
            }
        }
    }
}
