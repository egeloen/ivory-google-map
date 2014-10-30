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
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Circle renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The rendered circle.
     */
    public function render(Circle $circle, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[center]', $circle->getCenter()->getVariable(), false)
            ->setValue('[radius]', $circle->getRadius())
            ->setValues($circle->getOptions());

        return sprintf('new google.maps.Circle(%s)', $this->getJsonBuilder()->build());
    }
}
