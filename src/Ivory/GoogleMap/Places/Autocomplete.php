<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Places;

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\PlaceException;

/**
 * Places autocomplete.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Autocomplete extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $inputId;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var array */
    protected $types;

    /** @var string */
    protected $value;

    /** @var array */
    protected $inputAttributes;

    /** @var boolean */
    protected $async;

    /** @var string */
    protected $language;

    /**
     * Creates a place autocomplete.
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('place_autocomplete_');

        $this->inputId = 'place_input';
        $this->inputAttributes = array(
            'type'        => 'text',
            'placeholder' => 'off',
        );

        $this->types = array();
        $this->async = false;
        $this->language = 'en';
    }

    /**
     * Gets the autocomplete input ID.
     *
     * @return string The autocomplete input ID.
     */
    public function getInputId()
    {
        return $this->inputId;
    }

    /**
     * Sets the autocomplete input ID.
     *
     * @param string $inputId The autocomplete input ID.
     *
     * @throws \Ivory\GoogleMap\Exception\PlaceException If the input ID is not a valid string.
     */
    public function setInputId($inputId)
    {
        if (!is_string($inputId) || (strlen($inputId) === 0)) {
            throw PlaceException::invalidAutocompleteInputId();
        }

        $this->inputId = $inputId;
    }

    /**
     * Checks if the autocomplete has a bound.
     *
     * @return boolean TRUE if the autocomplete has a bound else FALSE.
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * Gets the autocomplete bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The autocomplete bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the autocomplete bound.
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
     * @throws \Ivory\GoogleMap\Exception\PlaceException If the bound is not valid (prototypes).
     */
    public function setBound()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Bound)) {
            $this->bound = $args[0];
        } elseif ((isset($args[0]) && ($args[0] instanceof Coordinate))
            && (isset($args[1]) && ($args[1] instanceof Coordinate))
        ) {
            if ($this->bound === null) {
                $this->bound = new Bound();
            }

            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        } elseif ((isset($args[0]) && is_numeric($args[0]))
            && (isset($args[1]) && is_numeric($args[1]))
            && (isset($args[2]) && is_numeric($args[2]))
            && (isset($args[3]) && is_numeric($args[3]))
        ) {
            if ($this->bound === null) {
                $this->bound = new Bound();
            }

            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));

            if (isset($args[4]) && is_bool($args[4])) {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            }

            if (isset($args[5]) && is_bool($args[5])) {
                $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        } elseif (!isset($args[0])) {
            $this->bound = null;
        } else {
            throw PlaceException::invalidAutocompleteBound();
        }
    }

    /**
     * Checks if the autocomplete has types.
     *
     * @return boolean TRUE if the autocomplete has types else FALSE.
     */
    public function hasTypes()
    {
        return !empty($this->types);
    }

    /**
     * Checks if the autocomplete has a specific type.
     *
     * @param string $type The type.
     *
     * @return boolean TRUE if the autocomplete has te specific type else FALSE.
     */
    public function hasType($type)
    {
        return array_search($type, $this->types) !== false;
    }

    /**
     * Gets the autocomplete types.
     *
     * @return array The autocomplete types.
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Sets the autocomplete types.
     *
     * @param array $types The autocomplete types.
     */
    public function setTypes(array $types)
    {
        $this->types = array();

        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * Adds a type to the autocomplete.
     *
     * @param string $type The type to add.
     *
     * @throws \Ivory\GoogleMap\Exception\PlaceException If the type is not valid.
     * @throws \Ivory\GoogleMap\Exception\PlaceException If the type already exists.
     */
    public function addType($type)
    {
        if (!in_array($type, AutocompleteType::getAvailableAutocompleteTypes())) {
            throw PlaceException::invalidAutocompleteType();
        }

        if ($this->hasType($type)) {
            throw PlaceException::autocompleteTypeAlreadyExists($type);
        }

        $this->types[] = $type;
    }

    /**
     * Removes a type from the autocomplete.
     *
     * @param string $type The type to remove.
     *
     * @throws \Ivory\GoogleMap\Exception\PlaceException If the type does not exist.
     */
    public function removeType($type)
    {
        if (!$this->hasType($type)) {
            throw PlaceException::autocompleteTypeDoesNotExist($type);
        }

        $index = array_search($type, $this->types);
        unset($this->types[$index]);
    }

    /**
     * Checks if the autocomplete has a value.
     *
     * @return boolean TRUE if the autocomplete has a value else FALSE.
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * Gets the autocomplete value.
     *
     * @return string The autocomplete value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the autocomplete value.
     *
     * @param string $value The autocomplete value.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Gets the autocomplete input attributes.
     *
     * @return array The autocomplete input attributes.
     */
    public function getInputAttributes()
    {
        return $this->inputAttributes;
    }

    /**
     * Sets the autocomplete input attributes.
     *
     * @param array $inputAttributes The autocomplete input attributes.
     */
    public function setInputAttributes(array $inputAttributes)
    {
        $this->inputAttributes = array();

        foreach ($inputAttributes as $name => $value) {
            $this->setInputAttribute($name, $value);
        }
    }

    /**
     * Sets an autocomplete attribute.
     *
     * You can remove an attribute by setting it to `null`.
     *
     * @param string $name  The attribute name.
     * @param mixed  $value The attribute value.
     */
    public function setInputAttribute($name, $value)
    {
        if ($value === null) {
            if (isset($this->inputAttributes[$name])) {
                unset($this->inputAttributes[$name]);
            }
        } else {
            $this->inputAttributes[$name] = $value;
        }
    }

    /**
     * Checks if the autocomplete is loaded asynchronously.
     *
     * @return boolean TRUE if the autocomplete is loaded asynchronounsly else FALSE.
     */
    public function isAsync()
    {
        return $this->async;
    }

    /**
     * Sets if the autocomplete is loaded asynchronously.
     *
     * @param boolean $async TRUE if the autocomplete is loaded asynchronously else FALSE.
     */
    public function setAsync($async)
    {
        if (!is_bool($async)) {
            throw PlaceException::invalidAutocompleteAsync();
        }

        $this->async = $async;
    }

    /**
     * Gets the autocomplete language
     *
     * @return string The autocomplete language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the autocomplete language.
     *
     * @param string $language The autocomplete language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
