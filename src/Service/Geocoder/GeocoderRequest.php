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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequest
{
    /**
     * @var Coordinate|string
     */
    private $address;

    /**
     * @var Bound|null
     */
    private $bound;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @param Coordinate|string $address
     */
    public function __construct($address)
    {
        $this->setAddress($address);
    }

    /**
     * @return Coordinate|string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Coordinate|string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return bool
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
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
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
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
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * @return mixed[]
     */
    public function buildQuery()
    {
        $query = [];

        if ($this->address instanceof Coordinate) {
            $query['latlng'] = $this->buildPlace($this->address);
        } else {
            $query['address'] = $this->address;
        }

        if ($this->hasBound()) {
            $query['bound'] = implode('|', [
                $this->buildPlace($this->bound->getSouthWest()),
                $this->buildPlace($this->bound->getNorthEast()),
            ]);
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    /**
     * @param Coordinate $place
     *
     * @return string
     */
    private function buildPlace(Coordinate $place)
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
