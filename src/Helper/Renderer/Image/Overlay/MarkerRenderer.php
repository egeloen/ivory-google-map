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

use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRenderer
{
    /**
     * @var MarkerStyleRenderer
     */
    private $markerStyleRenderer;

    /**
     * @var MarkerLocationRenderer
     */
    private $markerLocationRenderer;

    /**
     * @param MarkerStyleRenderer    $markerStyleRenderer
     * @param MarkerLocationRenderer $markerLocationRenderer
     */
    public function __construct(
        MarkerStyleRenderer $markerStyleRenderer,
        MarkerLocationRenderer $markerLocationRenderer
    ) {
        $this->markerStyleRenderer = $markerStyleRenderer;
        $this->markerLocationRenderer = $markerLocationRenderer;
    }

    /**
     * @param Marker[] $markers
     *
     * @return string
     */
    public function render(array $markers)
    {
        $result = [];
        $marker = current($markers);
        $style = $this->markerStyleRenderer->render($marker);

        if (!empty($style)) {
            $result[] = $style;
        }

        foreach ($markers as $marker) {
            $result[] = $this->markerLocationRenderer->render($marker);
        }

        return implode('|', $result);
    }
}
