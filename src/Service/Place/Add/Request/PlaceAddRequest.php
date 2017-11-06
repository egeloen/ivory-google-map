<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Add\Request;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author TeLiXj <telixj@gmail.com>
 */
class PlaceAddRequest implements PlaceAddRequestInterface
{
    /**
     * @var string|null
     */
    private $accuracy;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @var Coordinate
     */
    private $location;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $phoneNumber;

    /**
     * @var array|null
     */
    private $types;

    /**
     * @var string|null
     */
    private $website;

    /**
     * @param string $location
     * @param string $name
     * @param string $types
     */
    public function __construct($location, $name, $types)
    {
        $this->setLocation($location);
        $this->setName($name);
        $this->setTypes([$types]);
    }

    /**
     * @return bool
     */
    public function hasAccuracy()
    {
        return $this->accuracy !== null;
    }

    /**
     * @return string
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return bool
     */
    public function hasAddress()
    {
        return $this->address !== null;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $accuracy
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;
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
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Coordinate|null $location
     */
    public function setLocation(Coordinate $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function hasPhoneNumber()
    {
        return $this->phoneNumber !== null;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return bool
     */
    public function hasTypes()
    {
        return $this->types !== null;
    }

    /**
     * @return array|null
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param array|null $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    /**
     * @return bool
     */
    public function hasWebsite()
    {
        return $this->website !== null;
    }

    /**
     * @return string|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = [
            'location' => [
                "lat" => $this->location->getLatitude(),
                "lng" => $this->location->getLongitude()
            ],
            'name' => $this->name
        ];

        if ($this->hasAccuracy()) {
            $query['accuracy'] = $this->accuracy;
        }

        if ($this->hasAddress()) {
            $query['address'] = $this->address;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        if ($this->hasPhoneNumber()) {
            $query['phone_number'] = $this->phoneNumber;
        }

        if ($this->hasTypes()) {
            $query['types'] = $this->types;
        }

        if ($this->hasWebsite()) {
            $query['website'] = $this->website;
        }

        return $query;
    }
}
