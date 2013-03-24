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

use Ivory\GoogleMap\Exception\ControlException;
use Ivory\GoogleMap\MapTypeId;

/**
 * Map type control options describes a google map type control options.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControl
{
    /** @var array */
    protected $mapTypeIds;

    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $mapTypeControlStyle;

    /**
     * Create a map type control.
     *
     * @param array  $mapTypeIds          The map type IDs.
     * @param string $controlPosition     The control position.
     * @param string $mapTypeControlStyle The map type control style.
     */
    public function __construct(
        array $mapTypeIds = array(MapTypeId::ROADMAP, MapTypeId::SATELLITE),
        $controlPosition = ControlPosition::TOP_RIGHT,
        $mapTypeControlStyle = MapTypeControlStyle::DEFAULT_
    ) {
        $this->setMapTypeIds($mapTypeIds);
        $this->setControlPosition($controlPosition);
        $this->setMapTypeControlStyle($mapTypeControlStyle);
    }

    /**
     * Gets the map type IDs.
     *
     * @return array The map type IDs.
     */
    public function getMapTypeIds()
    {
        return $this->mapTypeIds;
    }

    /**
     * Sets the map type IDs.
     *
     * @param array $mapTypeIds The map type IDs.
     */
    public function setMapTypeIds($mapTypeIds)
    {
        $this->mapTypeIds = array();

        foreach ($mapTypeIds as $mapTypeId) {
            $this->addMapTypeId($mapTypeId);
        }
    }

    /**
     * Add a map type ID.
     *
     * @param string $mapTypeId The map type ID to add.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the map type ID is not valid.
     */
    public function addMapTypeId($mapTypeId)
    {
        if (!in_array($mapTypeId, MapTypeId::getMapTypeIds())) {
            throw ControlException::invalidMapTypeId();
        }

        if (!in_array($mapTypeId, $this->mapTypeIds)) {
            $this->mapTypeIds[] = $mapTypeId;
        }
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
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the control position is not valid.
     */
    public function setControlPosition($controlPosition)
    {
        if (!in_array($controlPosition, ControlPosition::getControlPositions())) {
            throw ControlException::invalidControlPosition();
        }

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
     * @param type $mapTypeControlStyle The map type control style.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the map type control style is not valid.
     */
    public function setMapTypeControlStyle($mapTypeControlStyle)
    {
        if (!in_array($mapTypeControlStyle, MapTypeControlStyle::getMapTypeControlStyles())) {
            throw ControlException::invalidMapTypeControlStyle();
        }

        $this->mapTypeControlStyle = $mapTypeControlStyle;
    }
}
