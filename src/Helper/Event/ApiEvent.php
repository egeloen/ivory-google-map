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

use SplObjectStorage;
/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEvent extends AbstractEvent
{
    /**
     * @var object[]
     */
    private array $objects;

    /**
     * @var string[]
     */
    private array $sources = [];

    /**
     * @var string[]
     */
    private array $libraries = [];

    /**
     * @var SplObjectStorage
     */
    private $callbacks;

    /**
     * @var SplObjectStorage
     */
    private $requirements;

    /**
     * @param object[] $objects
     */
    public function __construct(array $objects)
    {
        $this->objects = $objects;
        $this->callbacks = new SplObjectStorage();
        $this->requirements = new SplObjectStorage();
    }

    /**
     * @param string|null $class
     */
    public function hasObjects($class = null): bool
    {
        $objects = $this->getObjects($class);

        return !empty($objects);
    }

    /**
     * @param string|null $class
     *
     * @return object[]
     */
    public function getObjects($class = null): array
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

    public function hasSources(): bool
    {
        return !empty($this->sources);
    }

    /**
     * @return string[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param string[] $sources
     */
    public function setSources(array $sources): void
    {
        $this->sources = [];
        $this->addSources($sources);
    }

    /**
     * @param string[] $sources
     */
    public function addSources(array $sources): void
    {
        foreach ($sources as $source) {
            $this->addSource($source);
        }
    }

    /**
     * @param string $source
     */
    public function hasSource($source): bool
    {
        return in_array($source, $this->sources, true);
    }

    /**
     * @param string $source
     */
    public function addSource($source): void
    {
        if (!$this->hasSource($source)) {
            $this->sources[] = $source;
        }
    }

    /**
     * @param string $source
     */
    public function removeSource($source): void
    {
        unset($this->sources[array_search($source, $this->sources, true)]);
        $this->sources = empty($this->sources) ? [] : array_values($this->sources);
    }

    public function hasLibraries(): bool
    {
        return !empty($this->libraries);
    }

    /**
     * @return string[]
     */
    public function getLibraries(): array
    {
        return $this->libraries;
    }

    /**
     * @param string[] $libraries
     */
    public function setLibraries(array $libraries): void
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /**
     * @param string[] $libraries
     */
    public function addLibraries(array $libraries): void
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    /**
     * @param string $library
     */
    public function hasLibrary($library): bool
    {
        return in_array($library, $this->libraries, true);
    }

    /**
     * @param string $library
     */
    public function addLibrary($library): void
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    /**
     * @param string $library
     */
    public function removeLibrary($library): void
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
        $this->libraries = empty($this->libraries) ? [] : array_values($this->libraries);
    }

    public function hasCallbacks(): bool
    {
        return count($this->callbacks) > 0;
    }

    public function getCallbacks(): SplObjectStorage
    {
        return $this->callbacks;
    }

    /**
     * @param string      $callback
     * @param object|null $object
     */
    public function hasCallback($callback, $object = null): bool
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
     */
    public function hasCallbackObject($object, $callback = null): bool
    {
        return isset($this->callbacks[$object]) && ($callback === null || $this->callbacks[$object] === $callback);
    }

    /**
     * @param $object
     */
    public function getCallback($object): ?string
    {
        return $this->hasCallbackObject($object) ? $this->callbacks[$object] : null;
    }

    /**
     * @param string $callback
     *
     * @return object|null
     */
    public function getCallbackObject($callback)
    {
        foreach ($this->callbacks as $object) {
            if ($this->callbacks[$object] === $callback) {
                return $object;
            }
        }

        return null;
    }

    /**
     * @param object $object
     * @param string $callback
     */
    public function addCallback($object, $callback): void
    {
        if (!$this->hasCallback($callback, $object)) {
            $this->callbacks[$object] = $callback;
        }
    }

    /**
     * @param object $object
     */
    public function removeCallbackObject($object): void
    {
        unset($this->callbacks[$object]);
    }

    /**
     * @param string $callback
     */
    public function removeCallback($callback): void
    {
        if ($this->hasCallback($callback)) {
            $this->removeCallbackObject($this->getCallbackObject($callback));
        }
    }

    /**
     * @param object|null $object
     */
    public function hasRequirements($object = null): bool
    {
        if ($object === null) {
            return count($this->requirements) > 0;
        }

        $requirements = $this->getRequirementsObject($object);

        return !empty($requirements);
    }

    public function getRequirements(): SplObjectStorage
    {
        return $this->requirements;
    }

    /**
     * @param object $object
     *
     * @return string[]
     */
    public function getRequirementsObject($object): array
    {
        return $this->hasRequirement($object) ? $this->requirements[$object] : [];
    }

    /**
     * @param object   $object
     * @param string[] $requirements
     */
    public function setRequirements($object, array $requirements): void
    {
        $this->requirements = new SplObjectStorage();
        $this->addRequirements($object, $requirements);
    }

    /**
     * @param object   $object
     * @param string[] $requirements
     */
    public function addRequirements($object, array $requirements): void
    {
        foreach ($requirements as $requirement) {
            $this->addRequirement($object, $requirement);
        }
    }

    /**
     * @param object      $object
     * @param string|null $requirement
     */
    public function hasRequirement($object, $requirement = null): bool
    {
        return isset($this->requirements[$object])
            && ($requirement === null || in_array($requirement, $this->requirements[$object], true));
    }

    /**
     * @param object $object
     * @param string $requirement
     */
    public function addRequirement($object, $requirement): void
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
    public function removeRequirement($object, $requirement = null): void
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
