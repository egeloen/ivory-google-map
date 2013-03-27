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
use Ivory\GoogleMap\Overlays\GroundOverlay;

/**
 * Ground overlay helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelper
{
    /**
     * Renders a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     *
     * @return string The JS output.
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $groundOverlayOptions = $groundOverlay->getOptions();
        $groundOverlayJSONOptions = sprintf('{"map":%s', $map->getJavascriptVariable());

        if (!empty($groundOverlayOptions)) {
            $groundOverlayJSONOptions .= ','.substr(json_encode($groundOverlayOptions), 1);
        } else {
            $groundOverlayJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.GroundOverlay("%s", %s, %s);'.PHP_EOL,
            $groundOverlay->getJavascriptVariable(),
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getJavascriptVariable(),
            $groundOverlayJSONOptions
        );
    }
}
