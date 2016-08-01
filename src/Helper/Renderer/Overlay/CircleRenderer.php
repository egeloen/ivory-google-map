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
use Ivory\GoogleMap\Overlay\Circle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleRenderer extends AbstractJsonRenderer
{
    /**
     * @param Circle $circle
     * @param Map    $map
     *
     * @return string
     */
    public function render(Circle $circle, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[center]', $circle->getCenter()->getVariable(), false)
            ->setValue('[radius]', $circle->getRadius())
            ->setValues($circle->getOptions());

        return $formatter->renderObjectAssignment($circle, $formatter->renderObject('Circle', [
            $jsonBuilder->build(),
        ]));
    }
}
