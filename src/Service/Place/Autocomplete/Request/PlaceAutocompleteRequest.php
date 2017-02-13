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
    private $types = [];

    /**
     * @var string[]
     */
    private $components = [];

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
        $this->types = array_values($this->types);
    }

    /**
     * @return bool
     */
    public function hasComponents()
    {
        return !empty($this->components);
    }

    /**
     * @return string[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param string[] $components
     */
    public function setComponents(array $components)
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param string[] $components
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
     * @return string
     */
    public function getComponent($type)
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    /**
     * @param string $type
     * @param string $value
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
     * {@inheritdoc}
     */
    public function buildContext()
    {
        return 'autocomplete';
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = parent::buildQuery();

        if ($this->hasTypes()) {
            $query['types'] = implode('|', $this->types);
        }

        if ($this->hasComponents()) {
            $query['components'] = implode('|', array_map(function ($key, $value) {
                return $key.':'.$value;
            }, array_keys($this->components), array_values($this->components)));
        }

        return $query;
    }
}
