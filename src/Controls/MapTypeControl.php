<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

use Ivory\GoogleMap\MapTypeId;

/**
 * Map type control.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControl
{
    /** @var array */
    private $mapTypeIds = array();

    /** @var string */
    private $controlPosition;

    /** @var string */
    private $mapTypeControlStyle;

    /**
     * Creates a map type control.
     *
     * @param array  $mapTypeIds          The map type ids.
     * @param string $controlPosition     The control position.
     * @param string $mapTypeControlStyle The map type control style.
     */
    public function __construct(
        array $mapTypeIds = array(MapTypeId::ROADMAP, MapTypeId::SATELLITE),
        $controlPosition = ControlPosition::TOP_RIGHT,
        $mapTypeControlStyle = MapTypeControlStyle::DEFAULT_
    ) {
        $this->addMapTypeIds($mapTypeIds);
        $this->setControlPosition($controlPosition);
        $this->setMapTypeControlStyle($mapTypeControlStyle);
    }

    /**
     * Resets the map types ids.
     */
    public function resetMapTypeIds()
    {
        $this->mapTypeIds = array();
    }

    /**
     * Checks if there are map types ids.
     *
     * @return boolean TRUE if there are map type ids else FALSE.
     */
    public function hasMapTypeIds()
    {
        return !empty($this->mapTypeIds);
    }

    /**
     * Gets the map type ids.
     *
     * @return array The map type ids.
     */
    public function getMapTypeIds()
    {
        return $this->mapTypeIds;
    }

    /**
     * Sets the map type ids.
     *
     * @param array $mapTypeIds The map type ids.
     */
    public function setMapTypeIds(array $mapTypeIds)
    {
        $this->resetMapTypeIds();
        $this->addMapTypeIds($mapTypeIds);
    }

    /**
     * Adds the map type ids.
     *
     * @param array $mapTypeIds The map type ids.
     */
    public function addMapTypeIds(array $mapTypeIds)
    {
        foreach ($mapTypeIds as $mapTypeId) {
            $this->addMapTypeId($mapTypeId);
        }
    }

    /**
     * Removes the map type ids.
     *
     * @param array $mapTypeIds The map type ids.
     */
    public function removeMapTypeIds(array $mapTypeIds)
    {
        foreach ($mapTypeIds as $mapTypeId) {
            $this->removeMapTypeId($mapTypeId);
        }
    }

    /**
     * Checks if there is a map type id.
     *
     * @param string $mapTypeId The map type id.
     *
     * @return boolean TRUE if there is the map type id else FALSE.
     */
    public function hasMapTypeId($mapTypeId)
    {
        return in_array($mapTypeId, $this->mapTypeIds, true);
    }

    /**
     * Adds a map type id.
     *
     * @param string $mapTypeId The map type id.
     */
    public function addMapTypeId($mapTypeId)
    {
        if (!$this->hasMapTypeId($mapTypeId)) {
            $this->mapTypeIds[] = $mapTypeId;
        }
    }

    /**
     * Removes a map type id.
     *
     * @param string $mapTypeId The map type id.
     */
    public function removeMapTypeId($mapTypeId)
    {
        unset($this->mapTypeIds[array_search($mapTypeId, $this->mapTypeIds, true)]);
    }

    /**
     * Gets the control position.
     *
     * @return string The control position.
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }

    /**
     * Sets the control position.
     *
     * @param string $controlPosition The control position.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;
    }

    /**
     * Gets the map type control style.
     *
     * @return string The map type control style.
     */
    public function getMapTypeControlStyle()
    {
        return $this->mapTypeControlStyle;
    }

    /**
     * Sets the map type control style.
     *
     * @param string $mapTypeControlStyle The map type control style.
     */
    public function setMapTypeControlStyle($mapTypeControlStyle)
    {
        $this->mapTypeControlStyle = $mapTypeControlStyle;
    }
}
