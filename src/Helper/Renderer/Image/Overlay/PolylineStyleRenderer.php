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

use Ivory\GoogleMap\Overlay\Polyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineStyleRenderer extends AbstractPolylineStyleRenderer
{
    /**
     * @param Polyline $polyline
     *
     * @return string
     */
    public function render(Polyline $polyline)
    {
        return $this->renderPolylineStyle(
            $polyline->hasStaticOption('styles') ? $polyline->getStaticOption('styles') : [],
            $polyline
        );
    }
}
