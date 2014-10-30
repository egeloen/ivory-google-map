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
use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     * @param \Ivory\GoogleMap\Map              $map     The map.
     *
     * @return string The rendered polygon.
     */
    public function render(Polygon $polygon, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false);

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $this->getJsonBuilder()->setValue(sprintf('[paths][%d]', $index), $coordinate->getVariable(), false);
        }

        $this->getJsonBuilder()->setValues($polygon->getOptions());

        return sprintf('new google.maps.Polygon(%s)', $this->getJsonBuilder()->build());
    }
}
