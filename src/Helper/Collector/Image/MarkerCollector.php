<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Image;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerStyleRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCollector extends AbstractCollector
{
    /**
     * @var MarkerStyleRenderer
     */
    private $markerStyleRenderer;

    /**
     * @param MarkerStyleRenderer $markerStyleRenderer
     */
    public function __construct(MarkerStyleRenderer $markerStyleRenderer)
    {
        $this->markerStyleRenderer = $markerStyleRenderer;
    }

    /**
     * @param Map      $map
     * @param Marker[] $markers
     *
     * @return Marker[][]
     */
    public function collect(Map $map, array $markers = [])
    {
        $result = [];

        foreach (array_merge($markers, $map->getOverlayManager()->getMarkers()) as $marker) {
            $hash = md5($this->markerStyleRenderer->render($marker));
            $result[$hash] = $this->collectValue($marker, isset($result[$hash]) ? $result[$hash] : []);
        }

        return array_values($result);
    }
}
