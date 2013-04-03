<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\InfoWindow;

/**
 * Info window helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelper
{
   /**
     * Renders an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow     The info window.
     * @param boolean                              $renderPosition TRUE if the position is rendered else FALSE.
     *
     * @return string The JS output.
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        if ($renderPosition) {
            $infoWindowJSONOptions = sprintf('{"position":%s,', $infoWindow->getPosition()->getJavascriptVariable());
        } else {
            $infoWindowJSONOptions = '{';
        }

        if ($infoWindow->hasPixelOffset()) {
            $infoWindowJSONOptions .= '"pixelOffset":'.$infoWindow->getPixelOffset()->getJavascriptVariable().',';
        }

        $infoWindowOptions = array_merge(
            array('content' => $infoWindow->getContent()),
            $infoWindow->getOptions()
        );

        $infoWindowJSONOptions .= substr(json_encode($infoWindowOptions), 1);

        return sprintf(
            '%s = new google.maps.InfoWindow(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $infoWindowJSONOptions
        );
    }

    /**
     * Renders the info window open flag.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     * @param \Ivory\GoogleMap\Map                 $map        The map.
     * @param \Ivory\GoogleMap\Overlays\Marker     $marker     The marker.
     *
     * @return string The JS output.
     */
    public function renderOpen(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        if ($marker !== null) {
            return sprintf(
                '%s.open(%s, %s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        }

        return sprintf('%s.open(%s);'.PHP_EOL, $infoWindow->getJavascriptVariable(), $map->getJavascriptVariable());
    }
}
