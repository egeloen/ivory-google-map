<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceSearchRequest implements PlaceSearchRequestInterface
{
    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @var float|null
     */
    private $radius;

    /**
     * @var int|null
     */
    private $minPrice;

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var bool|null
     */
    private $openNow;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return $this->location !== null;
    }

    /**
     * @return Coordinate|null
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
     * @return bool
     */
    public function hasRadius()
    {
        return $this->radius !== null;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return bool
     */
    public function hasMinPrice()
    {
        return $this->minPrice !== null;
    }

    /**
     * @return int|null
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param int|null $minPrice
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return bool
     */
    public function hasMaxPrice()
    {
        return $this->maxPrice !== null;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return bool
     */
    public function hasOpenNow()
    {
        return $this->openNow !== null;
    }

    /**
     * @return bool|null
     */
    public function isOpenNow()
    {
        return $this->openNow;
    }

    /**
     * @param bool|null $openNow
     */
    public function setOpenNow($openNow)
    {
        $this->openNow = $openNow;
    }

    /**
     * @return bool
     */
    public function hasType()
    {
        return $this->type !== null;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = [];

        if ($this->hasLocation()) {
            $query['location'] = $this->buildCoordinate($this->location);
        }

        if ($this->hasRadius()) {
            $query['radius'] = $this->radius;
        }

        if ($this->hasMinPrice()) {
            $query['minprice'] = $this->minPrice;
        }

        if ($this->hasMaxPrice()) {
            $query['maxprice'] = $this->maxPrice;
        }

        if ($this->hasOpenNow()) {
            $query['opennow'] = $this->openNow;
        }

        if ($this->hasType()) {
            $query['type'] = $this->type;
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
    private function buildCoordinate(Coordinate $place)
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
