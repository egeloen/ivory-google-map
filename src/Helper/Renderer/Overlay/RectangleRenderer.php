<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleRenderer extends AbstractJsonRenderer
{
    /**
     * @param Rectangle $rectangle
     * @param Map       $map
     *
     * @return string
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[bounds]', $rectangle->getBound()->getVariable(), false)
            ->setValues($rectangle->getOptions());

        return $formatter->renderObjectAssignment($rectangle, $formatter->renderObject('Rectangle', [
            $jsonBuilder->build(),
        ]));
    }
}
