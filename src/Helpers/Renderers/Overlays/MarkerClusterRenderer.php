<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\MarkerCluster;

/**
 * Marker cluster renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a marker cluster.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     * @param string                                  $markers       The markers.
     *
     * @return string The rendered marker cluster.
     */
    public function render(MarkerCluster $markerCluster, Map $map, $markers)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValues($markerCluster->getOptions());

        return sprintf(
            'new MarkerClusterer(%s,%s,%s)',
            $map->getVariable(),
            $markers,
            $this->getJsonBuilder()->build()
        );
    }

    /**
     * Renders the marker cluster source.
     *
     * @return string The marker cluster source.
     */
    public function renderSource()
    {
        return '//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js';
    }
}
