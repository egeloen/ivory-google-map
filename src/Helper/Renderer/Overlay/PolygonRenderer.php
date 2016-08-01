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
use Ivory\GoogleMap\Overlay\Polygon;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonRenderer extends AbstractJsonRenderer
{
    /**
     * @param Polygon $polygon
     * @param Map     $map
     *
     * @return string
     */
    public function render(Polygon $polygon, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[paths]', []);

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $jsonBuilder->setValue('[paths]['.$index.']', $coordinate->getVariable(), false);
        }

        $jsonBuilder->setValues($polygon->getOptions());

        return $formatter->renderObjectAssignment($polygon, $formatter->renderObject('Polygon', [
            $jsonBuilder->build(),
        ]));
    }
}
