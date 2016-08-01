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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointRenderer extends AbstractRenderer
{
    /**
     * @param Point $point
     *
     * @return string
     */
    public function render(Point $point)
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectAssignment($point, $formatter->renderObject('Point', [
            $point->getX(),
            $point->getY(),
        ]));
    }
}
