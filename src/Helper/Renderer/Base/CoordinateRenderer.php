<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateRenderer extends AbstractRenderer
{
    /**
     * @param Coordinate $coordinate
     *
     * @return string
     */
    public function render(Coordinate $coordinate)
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectAssignment($coordinate, $formatter->renderObject('LatLng', [
            $coordinate->getLatitude(),
            $coordinate->getLongitude(),
            $formatter->renderEscape($coordinate->isNoWrap()),
        ]));
    }
}
