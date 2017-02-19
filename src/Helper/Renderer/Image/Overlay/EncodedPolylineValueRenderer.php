<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image\Overlay;

use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineValueRenderer
{
    /**
     * @param EncodedPolyline $encodedPolyline
     *
     * @return string
     */
    public function render(EncodedPolyline $encodedPolyline)
    {
        return 'enc:'.$encodedPolyline->getValue();
    }
}
