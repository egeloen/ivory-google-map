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
use Ivory\GoogleMap\Overlays\Circle;

/**
 * Circle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelper
{
   /**
     * Renders a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    public function render(Circle $circle, Map $map)
    {
        $circleOptions = array_merge(array('radius' => $circle->getRadius()), $circle->getOptions());

        $circleJSONOptions = sprintf(
            '{"map":%s,"center":%s,',
            $map->getJavascriptVariable(),
            $circle->getCenter()->getJavascriptVariable()
        );

        $circleJSONOptions .= substr(json_encode($circleOptions), 1);

        return sprintf(
            '%s = new google.maps.Circle(%s);'.PHP_EOL,
            $circle->getJavascriptVariable(),
            $circleJSONOptions
        );
    }
}
