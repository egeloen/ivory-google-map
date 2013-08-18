<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays\MarkerCluster;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\MarkerCluster;

/**
 * Marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface MarkerClusterHelperInterface
{
    /**
     * Renders a marker cluster with the js map container.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Ivory\GoogleMap\Map                    $map           The map
     *
     * @return string The JS output.
     */
    public function render(MarkerCluster $markerCluster, Map $map);

    /**
     * Renders the markers of a marker cluster with the js container.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     *
     * @return string The JS output.
     */
    public function renderMarkers(MarkerCluster $markerCluster, Map $map);

    /**
     * Renders the marker cluster libraries.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     *
     * @return string The html output.
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map);
}
