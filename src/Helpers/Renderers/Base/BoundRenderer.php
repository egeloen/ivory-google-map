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

use Ivory\GoogleMap\Base\Bound;

/**
 * Bound renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundRenderer
{
    /**
     * Renders a bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The rendered bound.
     */
    public function render(Bound $bound)
    {
        if (!$bound->hasCoordinates()) {
            return 'new google.maps.LatLngBounds()';
        }

        return sprintf(
            'new google.maps.LatLngBounds(%s,%s)',
            $bound->getSouthWest()->getVariable(),
            $bound->getNorthEast()->getVariable()
        );
    }
}
