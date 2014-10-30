<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Base;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * Coordinate renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRenderer
{
    /**
     * Renders a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     *
     * @return string The rendered coordinate.
     */
    public function render(Coordinate $coordinate)
    {
        return sprintf(
            'new google.maps.LatLng(%s,%s,%s)',
            $coordinate->getLatitude(),
            $coordinate->getLongitude(),
            $coordinate->isNoWrap() ? 'true' : 'false'
        );
    }
}
