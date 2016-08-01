<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundRenderer extends AbstractRenderer
{
    /**
     * @param Map $map
     *
     * @return string
     */
    public function render(Map $map)
    {
        return $this->getFormatter()->renderObjectCall(
            $map,
            'fitBounds',
            [$map->getBound()->getVariable()]
        );
    }
}
