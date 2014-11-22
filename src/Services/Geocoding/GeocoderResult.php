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
 * Geocoder result.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderResult
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResult
{
    /** @var array */
    private $addressComponents;

    /** @var string */
    private $formattedAddress;

    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry */
    private $geometry;

    /** @var boolean */
    private $partialMatch;

    /** @var array */
    private $types;

    /**
     * Create a gecoder result.
     *
     * @param array                                                $addressComponents The address components.
     * @param string                                               $formattedAddress  The formatted address.
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry $geometry          The geometry.
     * @param array                                                $types             The types.
     * @param boolean                                              $partialMatch      The partial match flag.
     */
    public function __construct(
        array $addressComponents,
        $formattedAddress,
        GeocoderGeometry $geometry,
        array $types,
        $partialMatch = null
    ) {
        $this->setAddressComponents($addressComponents);
        $this->setFormattedAddress($formattedAddress);
        $this->setGeometry($geometry);
        $this->setTypes($types);
        $this->setPartialMatch($partialMatch);
    }

    /**
     * Resets the address components.
     */
    public function resetAddressComponents()
    {
        $this->addressComponents = array();
    }

    /**
     * Checks if there are address components.
     *
     * @return boolean TRUE if there are address components else FALSE.
     */
    public function hasAddressComponents()
    {
        return !empty($this->addressComponents);
    }

    /**
     * Gets the address components.
     *
     * @return array The address components.
     */
    public function getAddressComponents()
    {
        return $this->addressComponents;
    }

    /**
     * Sets the address components.
     *
     * @param array $addressComponents The address components.
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->resetAddressComponents();
        $this->addAddressComponents($addressComponents);
    }

    /**
     * Adds the address components.
     *
     * @param array $addressComponents The address components.
     */
    public function addAddressComponents(array $addressComponents)
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    /**
     * Removes the address components.
     *
     * @param array $addressComponents The address components.
     */
    public function removeAddressComponents(array $addressComponents)
    {
        foreach ($addressComponents as $addressComponent) {
            $this->removeAddressComponent($addressComponent);
        }
    }

    /**
     * Checks if there is an address component.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent $addressComponent The address component.
     *
     * @return boolean TRUE if there is an address component else FALSE.
     */
    public function hasAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        return in_array($addressComponent, $this->addressComponents, true);
    }

    /**
     * Adds an address component.
     *
     * @param \Ivory\GoogleMapBundle\Model\Services\GeocoderAddressComponent $addressComponent The address component.
     */
    public function addAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        if (!$this->hasAddressComponent($addressComponent)) {
            $this->addressComponents[] = $addressComponent;
        }
    }

    /**
     * Removes an address component.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderAddressComponent $addressComponent The address component.
     */
    public function removeAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        unset($this->addressComponents[array_search($addressComponent, $this->addressComponents, true)]);
    }

    /**
     * Gets the formatted address.
     *
     * @return string The formatted address.
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * Sets the formatted address.
     *
     * @param string $formattedAddress The formatted address.
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * Gets the geometry.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry The geometry.
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Sets the geometry.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry $geometry The geometry.
     */
    public function setGeometry(GeocoderGeometry $geometry)
    {
        $this->geometry = $geometry;
    }

    /**
     * Checks if there is a partial match.
     *
     * @return boolean TRUE if there is a partial match else FALSE.
     */
    public function hasPartialMatch()
    {
        return $this->partialMatch !== null;
    }

    /**
     * Checks if it is a partial match.
     *
     * @return boolean TRUE if it is a partial match else FALSE.
     */
    public function isPartialMatch()
    {
        return $this->partialMatch;
    }

    /**
     * Sets if it is a partial match.
     *
     * @param boolean|null $partialMatch TRUE if it is a partial match else FALSE.
     */
    public function setPartialMatch($partialMatch = null)
    {
        $this->partialMatch = $partialMatch;
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
     * @return boolean TRUe if there are types else FALSE.
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
