<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteRequest extends AbstractPlaceAutocompleteRequest
{
    /**
     * @var string[]
     */
    private array $types = [];

    /**
     * @var string[]
     */
    private array $components = [];

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
     * @return string[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * @param string[] $components
     */
    public function setComponents(array $components): void
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param string[] $components
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
     */
    public function getComponent($type): ?string
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    /**
     * @param string $type
     * @param string $value
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

    /**
     * {@inheritdoc}
     */
    public function buildContext(): string
    {
        return 'autocomplete';
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): array
    {
        $query = parent::buildQuery();

        if ($this->hasTypes()) {
            $query['types'] = implode('|', $this->types);
        }

        if ($this->hasComponents()) {
            $query['components'] = implode('|', array_map(fn($key, $value) => $key.':'.$value, array_keys($this->components), array_values($this->components)));
        }

        return $query;
    }
}
