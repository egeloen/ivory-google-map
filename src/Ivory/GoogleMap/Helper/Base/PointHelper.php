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

use Ivory\GoogleMap\Base\Point;

/**
 * Point helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointHelper
{
    /**
     * Renders a point.
     *
     * @param \Ivory\GoogleMap\Base\Point $point The point.
     *
     * @return string The JS output.
     */
    public function render(Point $point)
    {
        return sprintf(
            '%s = new google.maps.Point(%s, %s);'.PHP_EOL,
            $point->getJavascriptVariable(),
            $point->getX(),
            $point->getY()
        );
    }
}
