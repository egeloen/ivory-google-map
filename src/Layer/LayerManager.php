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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerManager
{
    /**
     * @var GeoJsonLayer[]
     */
    private $geoJsonLayers = [];

    /**
     * @var KmlLayer[]
     */
    private $kmlLayers = [];

    /**
     * @return bool
     */
    public function hasGeoJsonLayers()
    {
        return !empty($this->geoJsonLayers);
    }

    /**
     * @return GeoJsonLayer[]
     */
    public function getGeoJsonLayers()
    {
        return $this->geoJsonLayers;
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     */
    public function setGeoJsonLayers(array $geoJsonLayers)
    {
        $this->geoJsonLayers = [];
        $this->addGeoJsonLayers($geoJsonLayers);
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     */
    public function addGeoJsonLayers(array $geoJsonLayers)
    {
        foreach ($geoJsonLayers as $geoJsonLayer) {
            $this->addGeoJsonLayer($geoJsonLayer);
        }
    }

    /**
     * @param GeoJsonLayer $geoJsonLayer
     *
     * @return bool
     */
    public function hasGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        return in_array($geoJsonLayer, $this->geoJsonLayers, true);
    }

    /**
     * @param GeoJsonLayer $geoJsonLayer
     */
    public function addGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        if (!$this->hasGeoJsonLayer($geoJsonLayer)) {
            $this->geoJsonLayers[] = $geoJsonLayer;
        }
    }

    /**
     * @param GeoJsonLayer $geoJsonLayer
     */
    public function removeGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        unset($this->geoJsonLayers[array_search($geoJsonLayer, $this->geoJsonLayers, true)]);
    }

    /**
     * @return bool
     */
    public function hasKmlLayers()
    {
        return !empty($this->kmlLayers);
    }

    /**
     * @return KmlLayer[]
     */
    public function getKmlLayers()
    {
        return $this->kmlLayers;
    }

    /**
     * @param KmlLayer[] $kmlLayers
     */
    public function setKmlLayers(array $kmlLayers)
    {
        $this->kmlLayers = [];
        $this->addKmlLayers($kmlLayers);
    }

    /**
     * @param KmlLayer[] $kmlLayers
     */
    public function addKmlLayers(array $kmlLayers)
    {
        foreach ($kmlLayers as $kmlLayer) {
            $this->addKmlLayer($kmlLayer);
        }
    }

    /**
     * @param KmlLayer $kmlLayer
     *
     * @return bool
     */
    public function hasKmlLayer(KmlLayer $kmlLayer)
    {
        return in_array($kmlLayer, $this->kmlLayers, true);
    }

    /**
     * @param KmlLayer $kmlLayer
     */
    public function addKmlLayer(KmlLayer $kmlLayer)
    {
        if (!$this->hasKmlLayer($kmlLayer)) {
            $this->kmlLayers[] = $kmlLayer;
        }
    }

    /**
     * @param KmlLayer $kmlLayer
     */
    public function removeKmlLayer(KmlLayer $kmlLayer)
    {
        unset($this->kmlLayers[array_search($kmlLayer, $this->kmlLayers, true)]);
    }
}
