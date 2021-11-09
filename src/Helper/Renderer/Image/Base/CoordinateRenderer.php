<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image\Base;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRenderer
{
    public function render(Coordinate $coordinate): string
    {
        return round($coordinate->getLatitude(), 6).','.round($coordinate->getLongitude(), 6);
    }
}
