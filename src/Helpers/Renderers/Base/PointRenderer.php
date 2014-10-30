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

use Ivory\GoogleMap\Base\Point;

/**
 * Point renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointRenderer
{
    /**
     * Renders a point.
     *
     * @param \Ivory\GoogleMap\Base\Point $point The point.
     *
     * @return string The rendered point.
     */
    public function render(Point $point)
    {
        return sprintf('new google.maps.Point(%s,%s)', $point->getX(), $point->getY());
    }
}
