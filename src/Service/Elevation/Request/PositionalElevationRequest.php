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
    private $locations = [];

    /**
     * @param LocationInterface[] $locations
     */
    public function __construct(array $locations)
    {
        $this->setLocations($locations);
    }

    /**
     * @return bool
     */
    public function hasLocations()
    {
        return !empty($this->locations);
    }

    /**
     * @return LocationInterface[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param LocationInterface[] $locations
     */
    public function setLocations(array $locations)
    {
        $this->locations = [];
        $this->addLocations($locations);
    }

    /**
     * @param LocationInterface[] $locations
     */
    public function addLocations(array $locations)
    {
        foreach ($locations as $location) {
            $this->addLocation($location);
        }
    }

    /**
     * @param LocationInterface $location
     *
     * @return bool
     */
    public function hasLocation(LocationInterface $location)
    {
        return in_array($location, $this->locations, true);
    }

    /**
     * @param LocationInterface $location
     */
    public function addLocation(LocationInterface $location)
    {
        if (!$this->hasLocation($location)) {
            $this->locations[] = $location;
        }
    }

    /**
     * @param LocationInterface $location
     */
    public function removeLocation(LocationInterface $location)
    {
        unset($this->locations[array_search($location, $this->locations, true)]);
        $this->locations = array_values($this->locations);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        return ['locations' => implode('|', array_map(function (LocationInterface $location) {
            return $location->buildQuery();
        }, $this->locations))];
    }
}
