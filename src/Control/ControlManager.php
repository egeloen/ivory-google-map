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
    private ?FullscreenControl $fullscreenControl = null;

    private ?MapTypeControl $mapTypeControl = null;

    private ?RotateControl $rotateControl = null;

    private ?ScaleControl $scaleControl = null;

    private ?StreetViewControl $streetViewControl = null;

    private ?ZoomControl $zoomControl = null;

    /**
     * @var CustomControl[]
     */
    private array $customControls = [];

    public function hasFullscreenControl(): bool
    {
        return $this->fullscreenControl !== null;
    }

    public function getFullscreenControl(): ?FullscreenControl
    {
        return $this->fullscreenControl;
    }

    /**
     * @param FullscreenControl|null $fullscreenControl
     */
    public function setFullscreenControl(FullscreenControl $fullscreenControl = null): void
    {
        $this->fullscreenControl = $fullscreenControl;
    }

    public function hasMapTypeControl(): bool
    {
        return $this->mapTypeControl !== null;
    }

    public function getMapTypeControl(): ?MapTypeControl
    {
        return $this->mapTypeControl;
    }

    /**
     * @param MapTypeControl|null $mapTypeControl
     */
    public function setMapTypeControl(MapTypeControl $mapTypeControl = null): void
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    public function hasRotateControl(): bool
    {
        return $this->rotateControl !== null;
    }

    public function getRotateControl(): ?RotateControl
    {
        return $this->rotateControl;
    }

    /**
     * @param RotateControl|null $rotateControl
     */
    public function setRotateControl(RotateControl $rotateControl = null): void
    {
        $this->rotateControl = $rotateControl;
    }

    public function hasScaleControl(): bool
    {
        return $this->scaleControl !== null;
    }

    public function getScaleControl(): ?ScaleControl
    {
        return $this->scaleControl;
    }

    /**
     * @param ScaleControl|null $scaleControl
     */
    public function setScaleControl(ScaleControl $scaleControl = null): void
    {
        $this->scaleControl = $scaleControl;
    }

    public function hasStreetViewControl(): bool
    {
        return $this->streetViewControl !== null;
    }

    public function getStreetViewControl(): ?StreetViewControl
    {
        return $this->streetViewControl;
    }

    /**
     * @param StreetViewControl|null $streetViewControl
     */
    public function setStreetViewControl(StreetViewControl $streetViewControl = null): void
    {
        $this->streetViewControl = $streetViewControl;
    }

    public function hasZoomControl(): bool
    {
        return $this->zoomControl !== null;
    }

    public function getZoomControl(): ?ZoomControl
    {
        return $this->zoomControl;
    }

    /**
     * @param ZoomControl|null $zoomControl
     */
    public function setZoomControl(ZoomControl $zoomControl = null): void
    {
        $this->zoomControl = $zoomControl;
    }

    public function hasCustomControls(): bool
    {
        return !empty($this->customControls);
    }

    /**
     * @return CustomControl[]
     */
    public function getCustomControls(): array
    {
        return $this->customControls;
    }

    /**
     * @param CustomControl[] $customControls
     */
    public function setCustomControls(array $customControls): void
    {
        $this->customControls = [];
        $this->addCustomControls($customControls);
    }

    /**
     * @param CustomControl[] $customControls
     */
    public function addCustomControls(array $customControls): void
    {
        foreach ($customControls as $customControl) {
            $this->addCustomControl($customControl);
        }
    }

    public function hasCustomControl(CustomControl $customControl): bool
    {
        return in_array($customControl, $this->customControls, true);
    }

    public function addCustomControl(CustomControl $customControl): void
    {
        if (!$this->hasCustomControl($customControl)) {
            $this->customControls[] = $customControl;
        }
    }

    public function removeCustomControl(CustomControl $customControl): void
    {
        unset($this->customControls[array_search($customControl, $this->customControls, true)]);
        $this->customControls = empty($this->customControls) ? [] : array_values($this->customControls);
    }
}
