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

use Ivory\GoogleMap\Helper\AbstractHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\GroundOverlay;

/**
 * Ground overlay helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelper extends AbstractHelper
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
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValues($groundOverlay->getOptions());

        return sprintf(
            '%s = new google.maps.GroundOverlay("%s", %s, %s);'.PHP_EOL,
            $groundOverlay->getJavascriptVariable(),
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
