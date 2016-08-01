<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\GroundOverlay;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayRenderer extends AbstractJsonRenderer
{
    /**
     * @param GroundOverlay $groundOverlay
     * @param Map           $map
     *
     * @return string
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($groundOverlay->getOptions());

        return $formatter->renderObjectAssignment($groundOverlay, $formatter->renderObject('GroundOverlay', [
            $formatter->renderEscape($groundOverlay->getUrl()),
            $groundOverlay->getBound()->getVariable(),
            $jsonBuilder->build(),
        ]));
    }
}
