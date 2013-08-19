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
use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelper extends AbstractHelper
{
    /**
     * Renders a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     * @param \Ivory\GoogleMapl\Map             $map     The map.
     *
     * @return string Ths JS output.
     */
    public function render(Polygon $polygon, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[paths]', array());

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $this->jsonBuilder->setValue(sprintf('[paths][%d]', $index), $coordinate->getJavascriptVariable(), false);
        }

        $this->jsonBuilder->setValues($polygon->getOptions());

        return sprintf(
            '%s = new google.maps.Polygon(%s);'.PHP_EOL,
            $polygon->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
