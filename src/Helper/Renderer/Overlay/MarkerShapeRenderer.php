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
use Ivory\GoogleMap\Overlay\MarkerShape;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeRenderer extends AbstractJsonRenderer
{
    /**
     * @param MarkerShape $markerShape
     *
     * @return string
     */
    public function render(MarkerShape $markerShape)
    {
        return $this->getJsonBuilder()
            ->setValue('[type]', $markerShape->getType())
            ->setValue('[coords]', $markerShape->getCoordinates())
            ->build();
    }
}
