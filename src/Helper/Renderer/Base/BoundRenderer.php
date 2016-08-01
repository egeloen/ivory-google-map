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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundRenderer extends AbstractRenderer
{
    /**
     * @param Bound $bound
     *
     * @return string
     */
    public function render(Bound $bound)
    {
        $arguments = [];
        $formatter = $this->getFormatter();

        if (!$bound->hasExtendables() && $bound->hasCoordinates()) {
            $arguments[] = $bound->getSouthWest()->getVariable();
            $arguments[] = $bound->getNorthEast()->getVariable();
        }

        return $formatter->renderObjectAssignment($bound, $formatter->renderObject('LatLngBounds', $arguments));
    }
}
