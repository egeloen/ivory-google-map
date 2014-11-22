<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layers;

/**
 * Layers.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Layers
{
    /** @var array */
    private $kmlLayers = array();

    /**
     * Resets the kml layers.
     */
    public function resetKmlLayers()
    {
        $this->kmlLayers = array();
    }

    /**
     * Checks if there are kml layers.
     *
     * @return boolean TRUE if the are kml layers else FALSE.
     */
    public function hasKmlLayers()
    {
        return !empty($this->kmlLayers);
    }

    /**
     * Gets the kml layers.
     *
     * @return array The kml layers.
     */
    public function getKmlLayers()
    {
        return $this->kmlLayers;
    }

    /**
     * Sets the kml layers.
     *
     * @param array $kmlLayers The kml layers.
     */
    public function setKmlLayers(array $kmlLayers)
    {
        $this->resetKmlLayers();
        $this->addKmlLayers($kmlLayers);
    }

    /**
     * Adds the kml layers.
     *
     * @param array $kmlLayers The kml layers.
     */
    public function addKmlLayers(array $kmlLayers)
    {
        foreach ($kmlLayers as $kmlLayer) {
            $this->addKmlLayer($kmlLayer);
        }
    }

    /**
     * Removes the kml layers.
     *
     * @param array $kmlLayers The kml layers.
     */
    public function removeKmlLayers(array $kmlLayers)
    {
        foreach ($kmlLayers as $kmlLayer) {
            $this->removeKmlLayer($kmlLayer);
        }
    }

    /**
     * Checks if there is a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     *
     * @return boolean TRUE if there is the kml layer else FALSE.
     */
    public function hasKmlLayer(KmlLayer $kmlLayer)
    {
        return in_array($kmlLayer, $this->kmlLayers, true);
    }

    /**
     * Adds a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     */
    public function addKmlLayer(KmlLayer $kmlLayer)
    {
        if (!$this->hasKmlLayer($kmlLayer)) {
            $this->kmlLayers[] = $kmlLayer;
        }
    }

    /**
     * Removes a kml layer.
     *
     * @param \Ivory\GoogleMap\Layers\KmlLayer $kmlLayer The kml layer.
     */
    public function removeKmlLayer(KmlLayer $kmlLayer)
    {
        unset($this->kmlLayers[array_search($kmlLayer, $this->kmlLayers, true)]);
    }
}
