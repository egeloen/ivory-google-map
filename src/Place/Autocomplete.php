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

    private string $inputId = 'place_input';

    private ?EventManager $eventManager = null;

    private ?Bound $bound = null;

    /**
     * @var string[]
     */
    private array $types = [];

    /**
     * @var mixed[]
     */
    private array $components = [];

    private ?string $value = null;

    /**
     * @var string[]
     */
    private array $inputAttributes = [];

    /**
     * @var string[]
     */
    private array $libraries = [];

    public function __construct()
    {
        $this->setEventManager(new EventManager());
    }

    public function getHtmlId(): string
    {
        return $this->inputId;
    }

    public function setInputId(string $inputId): void
    {
        $this->inputId = $inputId;
    }

    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function hasBound(): bool
    {
        return $this->bound !== null;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     */
    public function hasType($type): bool
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }

    public function hasComponents(): bool
    {
        return !empty($this->components);
    }

    /**
     * @return mixed[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * @param mixed[] $components
     */
    public function setComponents(array $components): void
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param mixed[] $components
     */
    public function addComponents(array $components): void
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    /**
     * @param string $type
     */
    public function hasComponent($type): bool
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
    public function setComponent($type, $value): void
    {
        $this->components[$type] = $value;
    }

    /**
     * @param string $type
     */
    public function removeComponent($type): void
    {
        unset($this->components[$type]);
    }

    public function hasValue(): bool
    {
        return $this->value !== null;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value = null): void
    {
        $this->value = $value;
    }

    public function hasInputAttributes(): bool
    {
        return !empty($this->inputAttributes);
    }

    /**
     * @return string[]
     */
    public function getInputAttributes(): array
    {
        return $this->inputAttributes;
    }

    /**
     * @param string[] $inputAttributes
     */
    public function setInputAttributes(array $inputAttributes): void
    {
        $this->inputAttributes = [];
        $this->addInputAttributes($inputAttributes);
    }

    /**
     * @param string[] $inputAttributes
     */
    public function addInputAttributes(array $inputAttributes): void
    {
        foreach ($inputAttributes as $name => $value) {
            $this->setInputAttribute($name, $value);
        }
    }

    /**
     * @param string $name
     */
    public function hasInputAttribute($name): bool
    {
        return isset($this->inputAttributes[$name]);
    }

    /**
     * @param string $name
     */
    public function getInputAttribute($name): ?string
    {
        return $this->hasInputAttribute($name) ? $this->inputAttributes[$name] : null;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setInputAttribute($name, $value): void
    {
        $this->inputAttributes[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeInputAttribute($name): void
    {
        unset($this->inputAttributes[$name]);
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
}
