<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

/**
 * Geocoder address component.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderAddressComponent
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponent
{
    /** @var string */
    private $longName;

    /** @var string */
    private $shortName;

    /** @var array */
    private $types;

    /**
     * Creates a geocoder address component.
     *
     * @param string $longName  The long name.
     * @param string $shortName The short name.
     * @param array  $types     The types.
     */
    public function __construct($longName, $shortName, array $types)
    {
        $this->setLongName($longName);
        $this->setShortName($shortName);
        $this->setTypes($types);
    }

    /**
     * Gets the long name.
     *
     * @return string The long name.
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Sets the long name.
     *
     * @param string $longName The long name.
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;
    }

    /**
     * Gets the short name.
     *
     * @return string The short name.
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Sets the short name.
     *
     * @param string $shortName The short name.
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
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
}
