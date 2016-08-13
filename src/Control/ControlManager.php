<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlManager
{
    /**
     * @var MapTypeControl|null
     */
    private $mapTypeControl;

    /**
     * @var RotateControl|null
     */
    private $rotateControl;

    /**
     * @var ScaleControl|null
     */
    private $scaleControl;

    /**
     * @var StreetViewControl|null
     */
    private $streetViewControl;

    /**
     * @var ZoomControl|null
     */
    private $zoomControl;

    /**
     * @return bool
     */
    public function hasMapTypeControl()
    {
        return $this->mapTypeControl !== null;
    }

    /**
     * @return MapTypeControl|null
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }

    /**
     * @param MapTypeControl|null $mapTypeControl
     */
    public function setMapTypeControl(MapTypeControl $mapTypeControl = null)
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    /**
     * @return bool
     */
    public function hasRotateControl()
    {
        return $this->rotateControl !== null;
    }

    /**
     * @return RotateControl|null
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }

    /**
     * @param RotateControl|null $rotateControl
     */
    public function setRotateControl(RotateControl $rotateControl = null)
    {
        $this->rotateControl = $rotateControl;
    }

    /**
     * @return bool
     */
    public function hasScaleControl()
    {
        return $this->scaleControl !== null;
    }

    /**
     * @return ScaleControl|null
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }

    /**
     * @param ScaleControl|null $scaleControl
     */
    public function setScaleControl(ScaleControl $scaleControl = null)
    {
        $this->scaleControl = $scaleControl;
    }

    /**
     * @return bool
     */
    public function hasStreetViewControl()
    {
        return $this->streetViewControl !== null;
    }

    /**
     * @return StreetViewControl|null
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }

    /**
     * @param StreetViewControl|null $streetViewControl
     */
    public function setStreetViewControl(StreetViewControl $streetViewControl = null)
    {
        $this->streetViewControl = $streetViewControl;
    }

    /**
     * @return bool
     */
    public function hasZoomControl()
    {
        return $this->zoomControl !== null;
    }

    /**
     * @return ZoomControl|null
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }

    /**
     * @param ZoomControl|null $zoomControl
     */
    public function setZoomControl(ZoomControl $zoomControl = null)
    {
        $this->zoomControl = $zoomControl;
    }
}
