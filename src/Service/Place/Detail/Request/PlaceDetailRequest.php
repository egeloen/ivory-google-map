<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailRequest implements PlaceDetailRequestInterface
{
    /**
     * A textual identifier that uniquely identifies a place, returned from a Place Search.
     *
     * @var string
     */
    private $placeId;

    /**
     * The language code, indicating in which language the results should be returned, if possible.
     * Note that some fields may not be available in the requested language.
     *
     * @var string|null
     */
    private $language;

    /**
     * The region code, specified as a ccTLD (country code top-level domain) two-character value.
     * Most ccTLD codes are identical to ISO 3166-1 codes, with some exceptions.
     * This parameter will only influence, not fully restrict, results.
     * If more relevant results exist outside of the specified region, they may be included.
     * When this parameter is used, the country name is omitted from the resulting formatted_address for results in the specified region.
     *
     * @var string|null
     */
    private $region;

    /**
     * A random string which identifies an autocomplete session for billing purposes.
     * Use this for Place Details requests that are called following an autocomplete request in the same user session.
     *
     * @var string|null
     */
    private $sessionToken;

    /**
     * The types of place data to return.
     * If you do not specify at least one field with a request, or if you omit the fields parameter from a request,
     * ALL possible fields will be returned, and you will be billed accordingly.
     *
     * @var string[]|null
     */
    private $fields;

    const FIELDS_BASIC = [
        'icon', 'name', 'url', 'photo', 'permanently_closed', 'utc_offset',
        'address_component', 'adr_address', 'formatted_address', 'geometry',
        'place_id', 'plus_code', 'type', 'vicinity'
    ];

    const FIELDS_CONTACT = [
        'formatted_phone_number', 'international_phone_number',
        'opening_hours', 'website'
    ];

    const FIELDS_ATMOSPHERE = [
        'price_level', 'rating', 'review', 'user_ratings_total'
    ];

    /**
     * @param string $placeId
     */
    public function __construct($placeId)
    {
        $this->setPlaceId($placeId);
    }

    /**
     * @return string
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     * @return static
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return static
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     * @return static
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSessionToken()
    {
        return $this->sessionToken !== null;
    }

    /**
     * @return string|null
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * @param string|null $sessionToken
     * @return static
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSpecificFields()
    {
        return !empty($this->fields);
    }

    /**
     * @return string[]|null
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string[] $fields
     * @param bool $intersect
     * @return string[]|null
     */
    private function prepareFields($fields, $intersect = true)
    {
        if (empty($fields) || !is_array($fields)) {
            return [];
        }

        $res = array_unique(array_filter(array_map('trim', array_filter($fields, 'is_string'))));

        return $intersect ? array_intersect($res, static::getAllAvailableFields()) : $res;
    }

    /**
     * @return string[]|null
     */
    public static function getAllAvailableFields()
    {
        return array_merge(static::FIELDS_BASIC, static::FIELDS_CONTACT, static::FIELDS_ATMOSPHERE);
    }

    /**
     * @param string|string[] $fields
     * @return static
     */
    public function withFields($fields)
    {
        if (is_string($fields)) {
            $fields = explode(',', $fields);
        }

        if (is_array($fields) && !empty($fields = $this->prepareFields($fields))) {
            $this->fields = empty($this->fields) ? $fields : array_unique(array_merge($this->fields, $fields));
        }

        return $this;
    }

    /**
     * @param string|string[] $fields
     * @return static
     */
    public function withOnlyFields($fields)
    {
        if (is_string($fields)) {
            $fields = explode(',', $fields);
        }

        if (is_array($fields) && !empty($fields = $this->prepareFields($fields))) {
            $this->fields = $fields;
        }

        return $this;
    }

    /**
     * @param string|string[] $fields
     * @return static
     */
    public function withoutFields($fields)
    {
        if (is_string($fields)) {
            $fields = explode(',', $fields);
        }

        if (is_array($fields) && !empty($fields = $this->prepareFields($fields, false))) {
            $fields = array_diff(empty($this->fields) ? static::getAllAvailableFields() : $this->fields, $fields);
            $this->fields = empty($fields) ? null : $fields;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function withoutBasicFields()
    {
        return $this->withoutFields(static::FIELDS_BASIC);
    }

    /**
     * @return static
     */
    public function withoutContactFields()
    {
        return $this->withoutFields(static::FIELDS_CONTACT);
    }

    /**
     * @return static
     */
    public function withoutAtmosphereFields()
    {
        return $this->withoutFields(static::FIELDS_ATMOSPHERE);
    }

    /**
     * @return static
     */
    public function withBasicFields()
    {
        return $this->withFields(static::FIELDS_BASIC);
    }

    /**
     * @return static
     */
    public function withContactFields()
    {
        return $this->withFields(static::FIELDS_CONTACT);
    }

    /**
     * @return static
     */
    public function withAtmosphereFields()
    {
        return $this->withFields(static::FIELDS_ATMOSPHERE);
    }

    /**
     * @return static
     */
    public function withAllFields()
    {
        $this->fields = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = ['placeid' => $this->placeId];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasSessionToken()) {
            $query['sessiontoken'] = $this->sessionToken;
        }

        if ($this->hasSpecificFields()) {
            $query['fields'] = join(',', $this->fields);
        }

        return $query;
    }
}
