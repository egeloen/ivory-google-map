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
 * Marker Cluster.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCluster extends AbstractOptionsAsset
{
    /** @const string The default marker cluster type */
    const _DEFAULT = 'default';

    /** @const string The javascript marker cluster type */
    const MARKER_CLUSTER = 'marker_cluster';

    /** @var string */
    protected $type;

    /** @var array */
    protected $markers;

    /**
     * Creates a marker cluster.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('marker_cluster_');
        $this->setType(self::_DEFAULT);
        $this->markers = array();
    }

    /**
     * Gets the marker cluster type.
     *
     * @return string The marker cluster type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the marker cluster type.
     *
     * @param string $type The marker cluster type.
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Checks if the cluster has marker.
     *
     * @return boolean TRUE if the cluster has marker else FALSE.
     */
    public function hasMarkers()
    {
        return !empty($this->markers);
    }

    /**
     * Gets the cluster markers.
     *
     * @return array The cluster markers.
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Sets the cluster markers.
     *
     * @param array $markers The cluster markers.
     */
    public function setMarkers($markers)
    {
        $this->markers = array();

        foreach ($markers as $marker) {
            $this->addMarker($marker);
        }
    }

    /**
     * Adds a marker to the cluster.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker to add.
     */
    public function addMarker(Marker $marker)
    {
        $this->markers[] = $marker;
    }
}
