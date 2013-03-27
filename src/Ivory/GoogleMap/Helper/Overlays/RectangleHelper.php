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
use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Rectangle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelper
{
    /**
     * Renders a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     * @param \Ivory\GoogleMap\Map                $map       The map.
     *
     * @return string The JS output.
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $rectangleOptions = $rectangle->getOptions();

        $rectangleJSONOptions = sprintf(
            '{"map":%s,"bounds":%s',
            $map->getJavascriptVariable(),
            $rectangle->getBound()->getJavascriptVariable()
        );

        if (!empty($rectangleOptions)) {
            $rectangleJSONOptions .= ','.substr(json_encode($rectangleOptions), 1);
        } else {
            $rectangleJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.Rectangle(%s);'.PHP_EOL,
            $rectangle->getJavascriptVariable(),
            $rectangleJSONOptions
        );
    }
}
