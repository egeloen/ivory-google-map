<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Request;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractGeocoderReverseRequest extends AbstractGeocoderRequest
{
    /**
     * @var string[]
     */
    private $resultTypes = [];

    /**
     * @var string[]
     */
    private $locationTypes = [];

    /**
     * @return bool
     */
    public function hasResultTypes()
    {
        return !empty($this->resultTypes);
    }

    /**
     * @return string[]
     */
    public function getResultTypes()
    {
        return $this->resultTypes;
    }

    /**
     * @param string[] $resultTypes
     */
    public function setResultTypes(array $resultTypes)
    {
        $this->resultTypes = [];
        $this->addResultTypes($resultTypes);
    }

    /**
     * @param string[] $resultTypes
     */
    public function addResultTypes(array $resultTypes)
    {
        foreach ($resultTypes as $resultType) {
            $this->addResultType($resultType);
        }
    }

    /**
     * @param string $resultType
     *
     * @return bool
     */
    public function hasResultType($resultType)
    {
        return in_array($resultType, $this->resultTypes, true);
    }

    /**
     * @param string $resultType
     */
    public function addResultType($resultType)
    {
        if (!$this->hasResultType($resultType)) {
            $this->resultTypes[] = $resultType;
        }
    }

    /**
     * @param string $resultType
     */
    public function removeResultType($resultType)
    {
        unset($this->resultTypes[array_search($resultType, $this->resultTypes, true)]);
        $this->resultTypes = array_values($this->resultTypes);
    }

    /**
     * @return bool
     */
    public function hasLocationTypes()
    {
        return !empty($this->locationTypes);
    }

    /**
     * @return string[]
     */
    public function getLocationTypes()
    {
        return $this->locationTypes;
    }

    /**
     * @param string[] $locationTypes
     */
    public function setLocationTypes(array $locationTypes)
    {
        $this->locationTypes = [];
        $this->addLocationTypes($locationTypes);
    }

    /**
     * @param string[] $locationTypes
     */
    public function addLocationTypes(array $locationTypes)
    {
        foreach ($locationTypes as $locationType) {
            $this->addLocationType($locationType);
        }
    }

    /**
     * @param string $locationType
     *
     * @return bool
     */
    public function hasLocationType($locationType)
    {
        return in_array($locationType, $this->locationTypes, true);
    }

    /**
     * @param string $locationType
     */
    public function addLocationType($locationType)
    {
        if (!$this->hasLocationType($locationType)) {
            $this->locationTypes[] = $locationType;
        }
    }

    /**
     * @param string $locationType
     */
    public function removeLocationType($locationType)
    {
        unset($this->locationTypes[array_search($locationType, $this->locationTypes, true)]);
        $this->locationTypes = array_values($this->locationTypes);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = [];

        if ($this->hasResultTypes()) {
            $query['result_type'] = implode('|', $this->resultTypes);
        }

        if ($this->hasLocationTypes()) {
            $query['location_type'] = implode('|', $this->locationTypes);
        }

        return array_merge(parent::buildQuery(), $query);
    }
}
