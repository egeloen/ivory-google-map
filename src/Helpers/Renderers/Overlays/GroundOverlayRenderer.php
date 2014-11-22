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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Ground overlay renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     *
     * @return string The rendered ground overlay.
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($groundOverlay->getOptions());

        return sprintf(
            'new google.maps.GroundOverlay("%s",%s,%s)',
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getVariable(),
            $this->getJsonBuilder()->build()
        );
    }
}
