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

/**
 * Controls.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Controls
{
    /** @var \Ivory\GoogleMap\Controls\MapTypeControl|null */
    private $mapTypeControl;

    /** @var \Ivory\GoogleMap\Controls\OverviewMapControl|null */
    private $overviewMapControl;

    /** @var \Ivory\GoogleMap\Controls\PanControl|null */
    private $panControl;

    /** @var \Ivory\GoogleMap\Controls\RotateControl|null */
    private $rotateControl;

    /** @var \Ivory\GoogleMap\Controls\ScaleControl|null */
    private $scaleControl;

    /** @var \Ivory\GoogleMap\Controls\StreetViewControl|null */
    private $streetViewControl;

    /** @var \Ivory\GoogleMap\Controls\ZoomControl|null */
    private $zoomControl;

    /**
     * Checks if there is a map type control.
     *
     * @return boolean TRUE if there is a map type control else FALSE.
     */
    public function hasMapTypeControl()
    {
        return $this->mapTypeControl !== null;
    }

    /**
     * Gets the map type control.
     *
     * @return \Ivory\GoogleMap\Controls\MapTypeControl|null The map type control.
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }

    /**
     * Sets the map type control.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl|null $mapTypeControl The map type control.
     */
    public function setMapTypeControl(MapTypeControl $mapTypeControl = null)
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    /**
     * Checks if there is an overview map control.
     *
     * @return boolean TRUE if there is an overview map control else FALSE.
     */
    public function hasOverviewMapControl()
    {
        return $this->overviewMapControl !== null;
    }

    /**
     * Gets the overview map control.
     *
     * @return \Ivory\GoogleMap\Controls\OverviewMapControl|null The overview map control.
     */
    public function getOverviewMapControl()
    {
        return $this->overviewMapControl;
    }

    /**
     * Sets the overview map control.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl|null $overviewMapControl The overview map control.
     */
    public function setOverviewMapControl(OverviewMapControl $overviewMapControl = null)
    {
        $this->overviewMapControl = $overviewMapControl;
    }

    /**
     * Checks if there is a pan control.
     *
     * @return boolean TRUE if there is a pan control else FALSE.
     */
    public function hasPanControl()
    {
        return $this->panControl !== null;
    }

    /**
     * Gets the pan control.
     *
     * @return \Ivory\GoogleMap\Controls\PanControl|null The pan control.
     */
    public function getPanControl()
    {
        return $this->panControl;
    }

    /**
     * Sets the pan control.
     *
     * @param \Ivory\GoogleMap\Controls\PanControl|null $panControl The pan control.
     */
    public function setPanControl(PanControl $panControl = null)
    {
        $this->panControl = $panControl;
    }

    /**
     * Checks if there is a rotate control.
     *
     * @return boolean TRUE if there is a rotate control else FALSE.
     */
    public function hasRotateControl()
    {
        return $this->rotateControl !== null;
    }

    /**
     * Gets the rotate control.
     *
     * @return \Ivory\GoogleMap\Controls\RotateControl|null The rotate control.
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }

    /**
     * Sets the rotate control.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl|null $rotateControl The rotate control.
     */
    public function setRotateControl(RotateControl $rotateControl = null)
    {
        $this->rotateControl = $rotateControl;
    }

    /**
     * Checks if there is a scale control else FALSE.
     *
     * @return boolean TRUE if there is a scale control else FALSE.
     */
    public function hasScaleControl()
    {
        return $this->scaleControl !== null;
    }

    /**
     * Gets the scale control.
     *
     * @return \Ivory\GoogleMap\Controls\ScaleControl|null The scale control.
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }

    /**
     * Sets the scale control.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl|null $scaleControl The scale control.
     */
    public function setScaleControl(ScaleControl $scaleControl = null)
    {
        $this->scaleControl = $scaleControl;
    }

    /**
     * Checks if there is a street view control.
     *
     * @return boolean TRUE if there is a street view control else FALSE.
     */
    public function hasStreetViewControl()
    {
        return $this->streetViewControl !== null;
    }

    /**
     * Gets the street view control.
     *
     * @return \Ivory\GoogleMap\Controls\StreetViewControl|null The street view control.
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }

    /**
     * Sets the street view control.
     *
     * @param \Ivory\GoogleMap\Controls\StreetViewControl|null $streetViewControl The street view control.
     */
    public function setStreetViewControl(StreetViewControl $streetViewControl = null)
    {
        $this->streetViewControl = $streetViewControl;
    }

    /**
     * Checks if there is a zoom control.
     *
     * @return boolean TRUE if there is a zoom control else FALSE.
     */
    public function hasZoomControl()
    {
        return $this->zoomControl !== null;
    }

    /**
     * Gets the zoom control.
     *
     * @return \Ivory\GoogleMap\Controls\ZoomControl|null The zoom control.
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }

    /**
     * Sets the zoom control.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl|null $zoomControl The zoom control.
     */
    public function setZoomControl(ZoomControl $zoomControl = null)
    {
        $this->zoomControl = $zoomControl;
    }
}
