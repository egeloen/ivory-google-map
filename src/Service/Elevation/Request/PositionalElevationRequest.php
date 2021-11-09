<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PositionalElevationRequest implements ElevationRequestInterface
{
    /**
     * @var LocationInterface[]
     */
    private array $locations = [];

    /**
     * @param LocationInterface[] $locations
     */
    public function __construct(array $locations)
    {
        $this->setLocations($locations);
    }

    public function hasLocations(): bool
    {
        return !empty($this->locations);
    }

    /**
     * @return LocationInterface[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    /**
     * @param LocationInterface[] $locations
     */
    public function setLocations(array $locations): void
    {
        $this->locations = [];
        $this->addLocations($locations);
    }

    /**
     * @param LocationInterface[] $locations
     */
    public function addLocations(array $locations): void
    {
        foreach ($locations as $location) {
            $this->addLocation($location);
        }
    }

    public function hasLocation(LocationInterface $location): bool
    {
        return in_array($location, $this->locations, true);
    }

    public function addLocation(LocationInterface $location): void
    {
        if (!$this->hasLocation($location)) {
            $this->locations[] = $location;
        }
    }

    public function removeLocation(LocationInterface $location): void
    {
        unset($this->locations[array_search($location, $this->locations, true)]);
        $this->locations = empty($this->locations) ? [] : array_values($this->locations);
    }

    public function buildQuery(): array
    {
        return ['locations' => implode('|', array_map(fn(LocationInterface $location) => $location->buildQuery(), $this->locations))];
    }
}
