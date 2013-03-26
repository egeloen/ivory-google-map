<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Base;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * Coordinate templating helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateHelper
{
    /**
     * Renders a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     *
     * @return string The JS output.
     */
    public function render(Coordinate $coordinate)
    {
        return sprintf(
            '%s = new google.maps.LatLng(%s, %s, %s);'.PHP_EOL,
            $coordinate->getJavascriptVariable(),
            $coordinate->getLatitude(),
            $coordinate->getLongitude(),
            json_encode($coordinate->isNoWrap())
        );
    }
}
