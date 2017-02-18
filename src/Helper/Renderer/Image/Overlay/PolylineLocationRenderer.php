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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\CoordinateRenderer;
use Ivory\GoogleMap\Overlay\Polyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineLocationRenderer
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
     * @param Polyline $polyline
     *
     * @return string
     */
    public function render(Polyline $polyline)
    {
        if ($polyline->hasStaticOption('locations')) {
            $locations = $polyline->getStaticOption('locations');
        } else {
            $locations = $polyline->getCoordinates();
        }

        return implode('|', array_map(function ($location) {
            return $location instanceof Coordinate ? $this->coordinateRenderer->render($location) : $location;
        }, $locations));
    }
}
