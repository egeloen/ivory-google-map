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

use Ivory\GoogleMap\Assets\AbstractVariableAsset;
use Ivory\GoogleMap\Base\Bound;

/**
 * Autocomplete.
 *
 * @link http://developers.google.com/maps/documentation/javascript/reference#Autocomplete
 * @author GeLo <geloen.eric@gmail.com>
 */
class Autocomplete extends AbstractVariableAsset
{
    /** @var string */
    private $inputId;

    /** @var array */
    private $inputAttributes = array();

    /** @var string|null */
    private $value;

    /** @var \Ivory\GoogleMap\Base\Bound|null */
    private $bound;

    /** @var array */
    private $types = array();

    /** @var array */
    private $componentRestrictions = array();

    /** @var string */
    private $language = 'en';

    /**
     * Creates an autocomplete.
     */
    public function __construct()
    {
        parent::__construct('places_autocomplete_');

        $this->setInputId($this->getVariable());
    }

    /**
     * Gets the input id.
     *
     * @return string The input id.
     */
    public function getInputId()
    {
        return $this->inputId;
    }

    /**
     * Sets the input id.
     *
     * @param string $inputId The input id.
     */
    public function setInputId($inputId)
    {
        $this->inputId = $inputId;
    }

    /**
     * Resets the input attributes.
     */
    public function resetInputAttributes()
    {
        $this->inputAttributes = array();
    }

    /**
     * Checks if there are input attributes.
     *
     * @return boolean TRUE if there are input attributes else FALSE.
     */
    public function hasInputAttributes()
    {
        return !empty($this->inputAttributes);
    }

    /**
     * Gets the input attributes.
     *
     * @return array The input attributes.
     */
    public function getInputAttributes()
    {
        return $this->inputAttributes;
    }

    /**
     * Sets the input attributes.
     *
     * @param array $inputAttributes The input attributes.
     */
    public function setInputAttributes(array $inputAttributes)
    {
        $this->resetInputAttributes();
        $this->addInputAttributes($inputAttributes);
    }

    /**
     * Adds the input attributes.
     *
     * @param array $inputAttributes The input attributes.
     */
    public function addInputAttributes(array $inputAttributes)
    {
        foreach ($inputAttributes as $name => $value) {
            $this->setInputAttribute($name, $value);
        }
    }

    /**
     * Removes the input attributes.
     *
     * @param array $names The input attribute names.
     */
    public function removeInputAttributes(array $names)
    {
        foreach ($names as $name) {
            $this->removeInputAttribute($name);
        }
    }

    /**
     * Checks if there is an input attribute.
     *
     * @param string $name The input attribute name.
     *
     * @return boolean TRUE if there is the input attribute else FALSE.
     */
    public function hasInputAttribute($name)
    {
        return array_key_exists($name, $this->inputAttributes);
    }

    /**
     * Gets an input attribute.
     *
     * @param string $name The input attribute name.
     *
     * @return mixed The input attribute value.
     */
    public function getInputAttribute($name)
    {
        return $this->hasInputAttribute($name) ? $this->inputAttributes[$name] : null;
    }

    /**
     * Sets an input attribute.
     *
     * @param string $name  The input attribute name.
     * @param mixed  $value The input attribute value.
     */
    public function setInputAttribute($name, $value)
    {
        $this->inputAttributes[$name] = $value;
    }

    /**
     * Removes an input attribute.
     *
     * @param string $name The input attribute name.
     */
    public function removeInputAttribute($name)
    {
        unset($this->inputAttributes[$name]);
    }

    /**
     * Checks if there is a value.
     *
     * @return boolean TRUE if there is a value else FALSE.
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * Gets the value.
     *
     * @return string|null The value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @param string $value The value.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Checks if there is a bound.
     *
     * @return boolean TRUE if there is a bound else FALSE.
     */
    public function hasBound()
    {
        return $this->bound !== null;
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
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }

    /**
     * Resets the types.
     */
    public function resetTypes()
    {
        $this->types = array();
    }

    /**
     * Checks if there are types.
     *
     * @return boolean TRUE if there are types else FALSE.
     */
    public function hasTypes()
    {
        return !empty($this->types);
    }

    /**
     * Gets the types.
     *
     * @return array The types.
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Sets the types.
     *
     * @param array $types The types.
     */
    public function setTypes(array $types)
    {
        $this->resetTypes();
        $this->addTypes($types);
    }

    /**
     * Adds the types.
     *
     * @param array $types The types.
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * Removes the types.
     *
     * @param array $types The types.
     */
    public function removeTypes(array $types)
    {
        foreach ($types as $type) {
            $this->removeType($type);
        }
    }

    /**
     * Checks if there is a type.
     *
     * @param string $type The type.
     *
     * @return boolean TRUE if there is the type else FALSE.
     */
    public function hasType($type)
    {
        return in_array($type, $this->types, true);
    }

    /**
     * Adds a type.
     *
     * @param string $type The type.
     */
    public function addType($type)
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * Removes a type.
     *
     * @param string $type The type.
     */
    public function removeType($type)
    {
        unset($this->types[array_search($type, $this->types, true)]);
    }

    /**
     * Resets the component restrictions.
     */
    public function resetComponentRestrictions()
    {
        $this->componentRestrictions = array();
    }

    /**
     * Checks if there are component restrictions.
     *
     * @return boolean TRUE if there are component restrictions else FALSE.
     */
    public function hasComponentRestrictions()
    {
        return !empty($this->componentRestrictions);
    }

    /**
     * Gets the component restrictions.
     *
     * @return array The component restrictions.
     */
    public function getComponentRestrictions()
    {
        return $this->componentRestrictions;
    }

    /**
     * Sets the component restrictions.
     *
     * @param array $componentRestrictions The component restrictions.
     */
    public function setComponentRestrictions(array $componentRestrictions)
    {
        $this->resetComponentRestrictions();
        $this->addComponentRestrictions($componentRestrictions);
    }

    /**
     * Adds the component restrictions.
     *
     * @param array $componentRestrictions The component restrictions.
     */
    public function addComponentRestrictions(array $componentRestrictions)
    {
        foreach ($componentRestrictions as $name => $value) {
            $this->setComponentRestriction($name, $value);
        }
    }

    /**
     * Removes the component restrictions.
     *
     * @param array $names The component restriction names.
     */
    public function removeComponentRestrictions(array $names)
    {
        foreach ($names as $name) {
            $this->removeComponentRestriction($name);
        }
    }

    /**
     * Checks if there is a component restriction.
     *
     * @param string $name The component restriction name.
     *
     * @return boolean TRUE if there is the component restriction else FALSE.
     */
    public function hasComponentRestriction($name)
    {
        return array_key_exists($name, $this->componentRestrictions);
    }

    /**
     * Gets a component restriction.
     *
     * @param string $name The component restriction name.
     *
     * @return mixed The component restriction value.
     */
    public function getComponentRestriction($name)
    {
        return $this->hasComponentRestriction($name) ? $this->componentRestrictions[$name] : null;
    }

    /**
     * Sets a component restriction.
     *
     * @param string $name  The component restriction name.
     * @param mixed  $value The component restriction value.
     */
    public function setComponentRestriction($name, $value)
    {
        $this->componentRestrictions[$name] = $value;
    }

    /**
     * Removes a component restriction.
     *
     * @param string $name The component restriction name.
     */
    public function removeComponentRestriction($name)
    {
        unset($this->componentRestrictions[$name]);
    }

    /**
     * Gets the language
     *
     * @return string The language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string $language The language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
