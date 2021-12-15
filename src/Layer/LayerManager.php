<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layer;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerManager
{
    private ?Map $map = null;

    /**
     * @var GeoJsonLayer[]
     */
    private array $geoJsonLayers = [];

    /**
     * @var HeatmapLayer[]
     */
    private array $heatmapLayers = [];

    /**
     * @var KmlLayer[]
     */
    private array $kmlLayers = [];

    public function hasMap(): bool
    {
        return $this->map !== null;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(Map $map): void
    {
        $this->map = $map;

        if ($map->getLayerManager() !== $this) {
            $map->setLayerManager($this);
        }
    }

    public function hasGeoJsonLayers(): bool
    {
        return !empty($this->geoJsonLayers);
    }

    /**
     * @return GeoJsonLayer[]
     */
    public function getGeoJsonLayers(): array
    {
        return $this->geoJsonLayers;
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     */
    public function setGeoJsonLayers(array $geoJsonLayers): void
    {
        $this->geoJsonLayers = [];
        $this->addGeoJsonLayers($geoJsonLayers);
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     */
    public function addGeoJsonLayers(array $geoJsonLayers): void
    {
        foreach ($geoJsonLayers as $geoJsonLayer) {
            $this->addGeoJsonLayer($geoJsonLayer);
        }
    }

    public function hasGeoJsonLayer(GeoJsonLayer $geoJsonLayer): bool
    {
        return in_array($geoJsonLayer, $this->geoJsonLayers, true);
    }

    public function addGeoJsonLayer(GeoJsonLayer $geoJsonLayer): void
    {
        if (!$this->hasGeoJsonLayer($geoJsonLayer)) {
            $this->geoJsonLayers[] = $geoJsonLayer;
        }
    }

    public function removeGeoJsonLayer(GeoJsonLayer $geoJsonLayer): void
    {
        unset($this->geoJsonLayers[array_search($geoJsonLayer, $this->geoJsonLayers, true)]);
        $this->geoJsonLayers = empty($this->geoJsonLayers) ? [] : array_values($this->geoJsonLayers);
    }

    public function hasHeatmapLayers(): bool
    {
        return !empty($this->heatmapLayers);
    }

    /**
     * @return HeatmapLayer[]
     */
    public function getHeatmapLayers(): array
    {
        return $this->heatmapLayers;
    }

    /**
     * @param HeatmapLayer[] $heatmapLayers
     */
    public function setHeatmapLayers(array $heatmapLayers): void
    {
        foreach ($this->heatmapLayers as $heatmapLayer) {
            $this->removeHeatmapLayer($heatmapLayer);
        }

        $this->addHeatmapLayers($heatmapLayers);
    }

    /**
     * @param HeatmapLayer[] $heatmapLayers
     */
    public function addHeatmapLayers(array $heatmapLayers): void
    {
        foreach ($heatmapLayers as $heatmapLayer) {
            $this->addHeatmapLayer($heatmapLayer);
        }
    }

    public function hasHeatmapLayer(HeatmapLayer $heatmapLayer): bool
    {
        return in_array($heatmapLayer, $this->heatmapLayers, true);
    }

    public function addHeatmapLayer(HeatmapLayer $heatmapLayer): void
    {
        if (!$this->hasHeatmapLayer($heatmapLayer)) {
            $this->heatmapLayers[] = $heatmapLayer;
        }

        $this->addExtendable($heatmapLayer);
    }

    public function removeHeatmapLayer(HeatmapLayer $heatmapLayer): void
    {
        unset($this->heatmapLayers[array_search($heatmapLayer, $this->heatmapLayers, true)]);
        $this->heatmapLayers = empty($this->heatmapLayers) ? [] : array_values($this->heatmapLayers);
        $this->removeExtendable($heatmapLayer);
    }

    public function hasKmlLayers(): bool
    {
        return !empty($this->kmlLayers);
    }

    /**
     * @return KmlLayer[]
     */
    public function getKmlLayers(): array
    {
        return $this->kmlLayers;
    }

    /**
     * @param KmlLayer[] $kmlLayers
     */
    public function setKmlLayers(array $kmlLayers): void
    {
        foreach ($this->kmlLayers as $kmlLayer) {
            $this->removeKmlLayer($kmlLayer);
        }

        $this->addKmlLayers($kmlLayers);
    }

    /**
     * @param KmlLayer[] $kmlLayers
     */
    public function addKmlLayers(array $kmlLayers): void
    {
        foreach ($kmlLayers as $kmlLayer) {
            $this->addKmlLayer($kmlLayer);
        }
    }

    public function hasKmlLayer(KmlLayer $kmlLayer): bool
    {
        return in_array($kmlLayer, $this->kmlLayers, true);
    }

    public function addKmlLayer(KmlLayer $kmlLayer): void
    {
        if (!$this->hasKmlLayer($kmlLayer)) {
            $this->kmlLayers[] = $kmlLayer;
        }

        $this->addExtendable($kmlLayer);
    }

    public function removeKmlLayer(KmlLayer $kmlLayer): void
    {
        unset($this->kmlLayers[array_search($kmlLayer, $this->kmlLayers, true)]);
        $this->kmlLayers = empty($this->kmlLayers) ? [] : array_values($this->kmlLayers);
        $this->removeExtendable($kmlLayer);
    }

    private function addExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->addExtendable($extendable);
        }
    }

    private function removeExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    private function isAutoZoom(): bool
    {
        return $this->hasMap() && $this->getMap()->isAutoZoom();
    }
}
