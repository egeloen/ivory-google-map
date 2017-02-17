<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerRenderer extends AbstractJsonRenderer
{
    /**
     * @return string
     */
    public function render()
    {
        return $this->getJsonBuilder()
            ->setValue('[base][coordinates]', [])
            ->setValue('[base][bounds]', [])
            ->setValue('[base][points]', [])
            ->setValue('[base][sizes]', [])
            ->setValue('[map]', null)
            ->setValue('[overlays][icons]', [])
            ->setValue('[overlays][symbols]', [])
            ->setValue('[overlays][icon_sequences]', [])
            ->setValue('[overlays][circles]', [])
            ->setValue('[overlays][encoded_polylines]', [])
            ->setValue('[overlays][ground_overlays]', [])
            ->setValue('[overlays][polygons]', [])
            ->setValue('[overlays][polylines]', [])
            ->setValue('[overlays][rectangles]', [])
            ->setValue('[overlays][info_windows]', [])
            ->setValue('[overlays][info_boxes]', [])
            ->setValue('[overlays][marker_shapes]', [])
            ->setValue('[overlays][markers]', [])
            ->setValue('[overlays][marker_cluster]', null)
            ->setValue('[layers][heatmap_layers]', [])
            ->setValue('[layers][kml_layers]', [])
            ->setValue('[events][dom_events]', [])
            ->setValue('[events][dom_events_once]', [])
            ->setValue('[events][events]', [])
            ->setValue('[events][events_once]', [])
            ->setValue('[functions]', [])
            ->build();
    }
}
