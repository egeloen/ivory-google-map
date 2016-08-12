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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerManager
{
    /**
     * @var Map|null
     */
    private $map;

    /**
     * @var KmlLayer[]
     */
    private $kmlLayers = [];

    /**
     * @return bool
     */
    public function hasMap()
    {
        return $this->map !== null;
    }

    /**
     * @return Map|null
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param Map $map
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        if ($map->getLayerManager() !== $this) {
            $map->setLayerManager($this);
        }
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
