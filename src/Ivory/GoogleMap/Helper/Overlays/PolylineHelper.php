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
use Ivory\GoogleMap\Overlays\Polyline;

/**
 * Polyline helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelper extends AbstractHelper
{
    /**
     * Renders a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     * @param \Ivory\GoogleMap\Map               $map      The map.
     *
     * @return string The JS output.
     */
    public function render(Polyline $polyline, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[path]', array());

        foreach ($polyline->getCoordinates() as $index => $coordinate) {
            $this->jsonBuilder->setValue(sprintf('[path][%d]', $index), $coordinate->getJavascriptVariable(), false);
        }

        $this->jsonBuilder->setValues($polyline->getOptions());

        return sprintf(
            '%s = new google.maps.Polyline(%s);'.PHP_EOL,
            $polyline->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
