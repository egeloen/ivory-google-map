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
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Polyline renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     * @param \Ivory\GoogleMap\Map               $map      The map.
     *
     * @return string The rendered polyline.
     */
    public function render(Polyline $polyline, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false);

        foreach ($polyline->getCoordinates() as $index => $coordinate) {
            $this->getJsonBuilder()->setValue(sprintf('[path][%d]', $index), $coordinate->getVariable(), false);
        }

        $this->getJsonBuilder()->setValues($polyline->getOptions());

        return sprintf('new google.maps.Polyline(%s)', $this->getJsonBuilder()->build());
    }
}
