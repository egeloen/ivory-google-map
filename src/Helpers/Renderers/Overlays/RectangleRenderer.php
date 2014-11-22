<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Rectangle;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Rectangle renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     * @param \Ivory\GoogleMap\Map                $map       The map.
     *
     * @return string The rendered rectangle.
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[bounds]', $rectangle->getBound()->getVariable(), false)
            ->setValues($rectangle->getOptions());

        return sprintf('new google.maps.Rectangle(%s)', $this->getJsonBuilder()->build());
    }
}
