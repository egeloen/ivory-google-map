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

use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Marker shape renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeRenderer extends AbstractJsonRenderer
{
    /**
     * Renders a marker shape.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $markerShape The marker shape.
     *
     * @return string The rendered marker shape.
     */
    public function render(MarkerShape $markerShape)
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue('[type]', $markerShape->getType())
            ->setValue('[coords]', $markerShape->getCoordinates())
            ->build();
    }
}
