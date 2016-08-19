<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Response;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderResult
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResult
{
    /**
     * @var string|null
     */
    private $placeId;

    /**
     * @var GeocoderAddress[]
     */
    private $addresses = [];

    /**
     * @var string|null
     */
    private $formattedAddress;

    /**
     * @var string[]
     */
    private $postcodeLocalities = [];

    /**
     * @var GeocoderGeometry|null
     */
    private $geometry;

    /**
     * @var bool|null
     */
    private $partialMatch;

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @return bool
     */
    public function hasPlaceId()
    {
        return $this->placeId !== null;
    }

    /**
     * @return string|null
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * @param string|null $type
     *
     * @return bool
     */
    public function hasAddresses($type = null)
    {
        $addresses = $this->getAddresses($type);

        return !empty($addresses);
    }

    /**
     * @param string|null $type
     *
     * @return GeocoderAddress[]
     */
    public function getAddresses($type = null)
    {
        if ($type === null) {
            return $this->addresses;
        }

        $addresses = [];

        foreach ($this->addresses as $address) {
            if (in_array($type, $address->getTypes(), true)) {
                $addresses[] = $address;
            }
        }

        return $addresses;
    }

    /**
     * @param GeocoderAddress[] $addresses
     */
    public function setAddresses(array $addresses)
    {
        $this->addresses = [];
        $this->addAddresses($addresses);
    }

    /**
     * @param GeocoderAddress[] $addresses
     */
    public function addAddresses(array $addresses)
    {
        foreach ($addresses as $address) {
            $this->addAddress($address);
        }
    }

    /**
     * @param GeocoderAddress $address
     *
     * @return bool
     */
    public function hasAddress(GeocoderAddress $address)
    {
        return in_array($address, $this->addresses, true);
    }

    /**
     * @param GeocoderAddress $address
     */
    public function addAddress(GeocoderAddress $address)
    {
        if (!$this->hasAddress($address)) {
            $this->addresses[] = $address;
        }
    }

    /**
     * @param GeocoderAddress $address
     */
    public function removeAddress(GeocoderAddress $address)
    {
        unset($this->addresses[array_search($address, $this->addresses, true)]);
        $this->addresses = array_values($this->addresses);
    }

    /**
     * @return bool
     */
    public function hasFormattedAddress()
    {
        return !empty($this->formattedAddress);
    }

    /**
     * @return string|null
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param string|null $formattedAddress
     */
    public function setFormattedAddress($formattedAddress = null)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @return bool
     */
    public function hasPostcodeLocalities()
    {
        return !empty($this->postcodeLocalities);
    }

    /**
     * @return string[]
     */
    public function getPostcodeLocalities()
    {
        return $this->postcodeLocalities;
    }

    /**
     * @param string[] $postcodeLocalities
     */
    public function setPostcodeLocalities(array $postcodeLocalities)
    {
        $this->postcodeLocalities = [];
        $this->addPostcodeLocalities($postcodeLocalities);
    }

    /**
     * @param string[] $postcodeLocalities
     */
    public function addPostcodeLocalities(array $postcodeLocalities)
    {
        foreach ($postcodeLocalities as $postcodeLocality) {
            $this->addPostcodeLocality($postcodeLocality);
        }
    }

    /**
     * @param string $postcodeLocality
     *
     * @return bool
     */
    public function hasPostcodeLocality($postcodeLocality)
    {
        return in_array($postcodeLocality, $this->postcodeLocalities, true);
    }

    /**
     * @param string $postcodeLocality
     */
    public function addPostcodeLocality($postcodeLocality)
    {
        if (!$this->hasPostcodeLocality($postcodeLocality)) {
            $this->postcodeLocalities[] = $postcodeLocality;
        }
    }

    /**
     * @param string $postcodeLocality
     */
    public function removePostcodeLocality($postcodeLocality)
    {
        unset($this->postcodeLocalities[array_search($postcodeLocality, $this->postcodeLocalities, true)]);
        $this->postcodeLocalities = array_values($this->postcodeLocalities);
    }

    /**
     * @return bool
     */
    public function hasGeometry()
    {
        return $this->geometry !== null;
    }

    /**
     * @return GeocoderGeometry|null
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @param GeocoderGeometry|null $geometry
     */
    public function setGeometry(GeocoderGeometry $geometry = null)
    {
        $this->geometry = $geometry;
    }

    /**
     * @return bool
     */
    public function hasPartialMatch()
    {
        return $this->partialMatch !== null;
    }

    /**
     * @return bool
     */
    public function isPartialMatch()
    {
        return $this->partialMatch;
    }

    /**
     * @param bool|null $partialMatch
     */
    public function setPartialMatch($partialMatch = null)
    {
        $this->partialMatch = $partialMatch;
    }

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
}
