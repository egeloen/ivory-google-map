<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;

/**
 * Marker cluster.
 *
 * @link http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/docs/reference.html
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCluster extends AbstractOptionsAsset
{
    /** @var array */
    private $markers = array();

    /** @var string */
    private $type = MarkerClusterType::DEFAULT_;

    /**
     * Creates a marker cluster.
     */
    public function __construct()
    {
        parent::__construct('marker_cluster_');
    }

    /**
     * Resets the markers.
     */
    public function resetMarkers()
    {
        $this->markers = array();
    }

    /**
     * Checks if there are markers.
     *
     * @return boolean TRUE if there are markers else FALSE.
     */
    public function hasMarkers()
    {
        return !empty($this->markers);
    }

    /**
     * Gets the markers.
     *
     * @return array The markers.
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Sets the markers.
     *
     * @param array $markers The markers.
     */
    public function setMarkers(array $markers)
    {
        $this->resetMarkers();
        $this->addMarkers($markers);
    }

    /**
     * Adds the markers.
     *
     * @param array $markers The markers.
     */
    public function addMarkers(array $markers)
    {
        foreach ($markers as $marker) {
            $this->addMarker($marker);
        }
    }

    /**
     * Removes the markers.
     *
     * @param array $markers The markers.
     */
    public function removeMarkers(array $markers)
    {
        foreach ($markers as $marker) {
            $this->removeMarker($marker);
        }
    }

    /**
     * Checks if there is a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     *
     * @return boolean TRUE if there is the marker else FALSE.
     */
    public function hasMarker(Marker $marker)
    {
        return in_array($marker, $this->markers, true);
    }

    /**
     * Adds a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    public function addMarker(Marker $marker)
    {
        if (!$this->hasMarker($marker)) {
            $this->markers[] = $marker;
        }
    }

    /**
     * Removes a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    public function removeMarker(Marker $marker)
    {
        unset($this->markers[array_search($marker, $this->markers, true)]);
    }

    /**
     * Gets the type.
     *
     * @return string The type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type The type.
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
