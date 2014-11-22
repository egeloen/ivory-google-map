<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers;

/**
 * Map container renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a map container.
     *
     * @param array $functions the functions.
     *
     * @return string The rendered map container.
     */
    public function render(array $functions = array())
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[base][coordinates]', array())
            ->setValue('[base][bounds]', array())
            ->setValue('[base][points]', array())
            ->setValue('[base][sizes]', array())
            ->setValue('[map]', null)
            ->setValue('[overlays][circles]', array())
            ->setValue('[overlays][encoded_polylines]', array())
            ->setValue('[overlays][ground_overlays]', array())
            ->setValue('[overlays][polygons]', array())
            ->setValue('[overlays][polylines]', array())
            ->setValue('[overlays][rectangles]', array())
            ->setValue('[overlays][info_windows]', array())
            ->setValue('[overlays][info_boxes]', array())
            ->setValue('[overlays][icons]', array())
            ->setValue('[overlays][marker_shapes]', array())
            ->setValue('[overlays][markers]', array())
            ->setValue('[overlays][marker_cluster]', null)
            ->setValue('[layers][kml_layers]', array())
            ->setValue('[events][dom_events]', array())
            ->setValue('[events][dom_events_once]', array())
            ->setValue('[events][events]', array())
            ->setValue('[events][events_once]', array())
            ->build();

        foreach ($functions as $name => $function) {
            $this->getJsonBuilder()->setValue('[functions]'.$name, $function, false);
        }

        return $this->getJsonBuilder()->build();
    }
}
