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
 * Geocoder result which describes a google map geocoder result.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderResult
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResult
{
    /** @var array */
    protected $addressComponents;

    /** @var string */
    protected $formattedAddress;

    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry */
    protected $geometry;

    /** @var boolean */
    protected $partialMatch;

    /** @var array */
    protected $types;

    /**
     * Create a gecoder result.
     *
     * @param array                                                       $addressComponents The address components.
     * @param string                                                      $formattedAddress  The formatted address.
     * @param \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry $geometry          The geometry.
     * @param array                                                       $types             The types.
     * @param boolean                                                     $partialMatch      The partial match flag.
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
     * Gets the address components.
     *
     * @param string|null The type of the address components.
     *
     * @return array The address components.
     */
    public function getAddressComponents($type = null)
    {
        if ($type === null) {
            return $this->addressComponents;
        }

        $addressComponents = array();

        foreach ($this->addressComponents as $addressComponent) {
            if (in_array($type, $addressComponent->getTypes())) {
                $addressComponents[] = $addressComponent;
            }
        }

        return $addressComponents;
    }

    /**
     * Sets address components.
     *
     * @param array $addressComponents The address components.
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = array();

        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    /**
     * Adds an address component to the geocoder result.
     *
     * @param \Ivory\GoogleMapBundle\Model\Services\Result\GeocoderAddressComponent $addressComponent The address
     *                                                                                                component to add.
     */
    public function addAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        $this->addressComponents[] = $addressComponent;
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
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the formatted address is not valid.
     */
    public function setFormattedAddress($formattedAddress)
    {
        if (!is_string($formattedAddress)) {
            throw GeocodingException::invalidGeocoderResultFormattedAddress();
        }

        $this->formattedAddress = $formattedAddress;
    }

    /**
     * Gets the geocoder result geometry.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry The geocoder result geometry.
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Sets the geocoder result geometry.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry $geometry The geocoder result geometry.
     */
    public function setGeometry(GeocoderGeometry $geometry)
    {
        $this->geometry = $geometry;
    }

    /**
     * Checks if the geocoder result is a partial match.
     *
     * @return boolean TRUE if the geocoder result is a partial match else FALSE.
     */
    public function isPartialMatch()
    {
        return $this->partialMatch;
    }

    /**
     * Sets the geocoder result partial match flag.
     *
     * @param boolean $partialMatch TRUE if the geocoder result is a partial match else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the partial match flag is not valid.
     */
    public function setPartialMatch($partialMatch = null)
    {
        if (!is_bool($partialMatch) && ($partialMatch !== null)) {
            throw GeocodingException::invalidGeocoderResultPartialMatch();
        }

        $this->partialMatch = $partialMatch;
    }

    /**
     * Gets the geocoder result types.
     *
     * @return array The geocoder result types.
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Sets the geocoder result types.
     *
     * @param array $types The geocoder result types.
     */
    public function setTypes(array $types)
    {
        $this->types = array();

        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * Adds a type to the geocoder result.
     *
     * @param string $type The type to add.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the type is not valid.
     */
    public function addType($type)
    {
        if (!is_string($type)) {
            throw GeocodingException::invalidGeocoderResultType();
        }

        $this->types[] = $type;
    }
}
