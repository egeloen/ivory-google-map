<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder;

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
     * @var GeocoderAddressComponent[]
     */
    private $addressComponents = [];

    /**
     * @var string|null
     */
    private $formattedAddress;

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
    public function hasAddressComponents($type = null)
    {
        $addressComponents = $this->getAddressComponents($type);

        return !empty($addressComponents);
    }

    /**
     * @param string|null $type
     *
     * @return GeocoderAddressComponent[]
     */
    public function getAddressComponents($type = null)
    {
        if ($type === null) {
            return $this->addressComponents;
        }

        $addressComponents = [];

        foreach ($this->addressComponents as $addressComponent) {
            if (in_array($type, $addressComponent->getTypes(), true)) {
                $addressComponents[] = $addressComponent;
            }
        }

        return $addressComponents;
    }

    /**
     * @param GeocoderAddressComponent[] $addressComponents
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = [];
        $this->addAddressComponents($addressComponents);
    }

    /**
     * @param GeocoderAddressComponent[] $addressComponents
     */
    public function addAddressComponents(array $addressComponents)
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    /**
     * @param GeocoderAddressComponent $addressComponent
     *
     * @return bool
     */
    public function hasAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        return in_array($addressComponent, $this->addressComponents, true);
    }

    /**
     * @param GeocoderAddressComponent $addressComponent
     */
    public function addAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        if (!$this->hasAddressComponent($addressComponent)) {
            $this->addressComponents[] = $addressComponent;
        }
    }

    /**
     * @param GeocoderAddressComponent $addressComponent
     */
    public function removeAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        unset($this->addressComponents[array_search($addressComponent, $this->addressComponents, true)]);
        $this->addressComponents = array_values($this->addressComponents);
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
