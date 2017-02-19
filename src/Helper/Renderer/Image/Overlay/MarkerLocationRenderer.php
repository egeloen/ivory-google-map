<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image\Overlay;

use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerLocationRenderer
{
    /**
     * @var CoordinateRenderer
     */
    private $coordinateRenderer;

    /**
     * @param CoordinateRenderer $coordinateRenderer
     */
    public function __construct(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    /**
     * @param Marker $marker
     *
     * @return string
     */
    public function render(Marker $marker)
    {
        return $marker->hasStaticOption('location')
            ? $marker->getStaticOption('location')
            : $this->coordinateRenderer->render($marker->getPosition());
    }
}
