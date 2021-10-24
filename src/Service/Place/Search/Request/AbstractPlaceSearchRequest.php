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
    private ?Coordinate $location = null;

    private ?float $radius = null;

    private ?int $minPrice = null;

    private ?int $maxPrice = null;

    private ?bool $openNow = null;

    private ?string $type = null;

    private ?string $language = null;

    public function hasLocation(): bool
    {
        return $this->location !== null;
    }

    public function getLocation(): ?Coordinate
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

    public function hasRadius(): bool
    {
        return $this->radius !== null;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(?float $radius): void
    {
        $this->radius = $radius;
    }

    public function hasMinPrice(): bool
    {
        return $this->minPrice !== null;
    }

    public function getMinPrice(): ?int
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

    public function hasMaxPrice(): bool
    {
        return $this->maxPrice !== null;
    }

    public function getMaxPrice(): ?int
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

    public function hasOpenNow(): bool
    {
        return $this->openNow !== null;
    }

    public function isOpenNow(): ?bool
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

    public function hasType(): bool
    {
        return $this->type !== null;
    }

    public function getType(): ?string
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

    public function hasLanguage(): bool
    {
        return $this->language !== null;
    }

    public function getLanguage(): ?string
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

    public function buildQuery(): array
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

    private function buildCoordinate(Coordinate $place): string
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
