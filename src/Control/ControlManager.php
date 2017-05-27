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
     * @var FullscreenControl|null
     */
    private $fullscreenControl;

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
     * @var CustomControl[]
     */
    private $customControls = [];

    /**
     * @return bool
     */
    public function hasFullscreenControl()
    {
        return $this->fullscreenControl !== null;
    }

    /**
     * @return FullscreenControl|null
     */
    public function getFullscreenControl()
    {
        return $this->fullscreenControl;
    }

    /**
     * @param FullscreenControl|null $fullscreenControl
     */
    public function setFullscreenControl(FullscreenControl $fullscreenControl = null)
    {
        $this->fullscreenControl = $fullscreenControl;
    }

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

    /**
     * @return bool
     */
    public function hasCustomControls()
    {
        return !empty($this->customControls);
    }

    /**
     * @return CustomControl[]
     */
    public function getCustomControls()
    {
        return $this->customControls;
    }

    /**
     * @param CustomControl[] $customControls
     */
    public function setCustomControls(array $customControls)
    {
        $this->customControls = [];
        $this->addCustomControls($customControls);
    }

    /**
     * @param CustomControl[] $customControls
     */
    public function addCustomControls(array $customControls)
    {
        foreach ($customControls as $customControl) {
            $this->addCustomControl($customControl);
        }
    }

    /**
     * @param CustomControl $customControl
     *
     * @return bool
     */
    public function hasCustomControl(CustomControl $customControl)
    {
        return in_array($customControl, $this->customControls, true);
    }

    /**
     * @param CustomControl $customControl
     */
    public function addCustomControl(CustomControl $customControl)
    {
        if (!$this->hasCustomControl($customControl)) {
            $this->customControls[] = $customControl;
        }
    }

    /**
     * @param CustomControl $customControl
     */
    public function removeCustomControl(CustomControl $customControl)
    {
        unset($this->customControls[array_search($customControl, $this->customControls, true)]);
        $this->customControls = empty($this->customControls) ? [] : array_values($this->customControls);
    }
}
