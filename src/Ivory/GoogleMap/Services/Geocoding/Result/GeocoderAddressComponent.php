<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding\Result;

use Ivory\GoogleMap\Exception\GeocodingException;

/**
 * GeocoderAddressComponent which describes a google map geocoder address component.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderAddressComponent
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponent
{
    /** @var string */
    protected $longName;

    /** @var string */
    protected $shortName;

    /** @var array */
    protected $types;

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
     * Gets the address component long name.
     *
     * @return string The address component long name.
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Sets the address component long name.
     *
     * @param string $longName The address componenet long name.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the long name is not valid.
     */
    public function setLongName($longName)
    {
        if (!is_string($longName)) {
            throw GeocodingException::invalidGeocoderAddressComponentLongName();
        }

        $this->longName = $longName;
    }

    /**
     * Gets the address component short name.
     *
     * @return string The address component short name.
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Sets the address component short name.
     *
     * @param string $shortName The address component short name.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the short name is not valid.
     */
    public function setShortName($shortName)
    {
        if (!is_string($shortName)) {
            throw GeocodingException::invalidGeocoderAddressComponentShortName();
        }

        $this->shortName = $shortName;
    }

    /**
     * Gets the address component types.
     *
     * @return array The address component types.
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Sets the address component types.
     *
     * @param array $types The address component types.
     */
    public function setTypes(array $types)
    {
        $this->types = array();

        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * Add an address component type.
     *
     * @param string $type The type to add.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the type is not valid.
     */
    public function addType($type)
    {
        if (!is_string($type)) {
            throw GeocodingException::invalidGeocoderAddressComponentType();
        }

        $this->types[] = $type;
    }
}
