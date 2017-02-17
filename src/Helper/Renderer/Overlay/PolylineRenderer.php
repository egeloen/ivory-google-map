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
use Ivory\GoogleMap\Overlay\Polyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineRenderer extends AbstractJsonRenderer
{
    /**
     * @param Polyline $polyline
     * @param Map      $map
     *
     * @return string
     */
    public function render(Polyline $polyline, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[path]', []);

        foreach ($polyline->getCoordinates() as $index => $coordinate) {
            $jsonBuilder->setValue('[path]['.$index.']', $coordinate->getVariable(), false);
        }

        foreach ($polyline->getIconSequences() as $index => $icon) {
            $jsonBuilder->setValue('[icons]['.$index.']', $icon->getVariable(), false);
        }

        $jsonBuilder->setValues($polyline->getOptions());

        return $formatter->renderObjectAssignment($polyline, $formatter->renderObject('Polyline', [
            $jsonBuilder->build(),
        ]));
    }
}
