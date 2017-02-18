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

use Ivory\GoogleMap\Overlay\EncodedPolyline;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRenderer
{
    /**
     * @var EncodedPolylineStyleRenderer
     */
    private $encodedPolylineStyleRenderer;

    /**
     * @var EncodedPolylineValueRenderer
     */
    private $encodedPolylineValueRenderer;

    /**
     * @param EncodedPolylineStyleRenderer $encodedPolylineStyleRenderer
     * @param EncodedPolylineValueRenderer $encodedPolylineValueRenderer
     */
    public function __construct(
        EncodedPolylineStyleRenderer $encodedPolylineStyleRenderer,
        EncodedPolylineValueRenderer $encodedPolylineValueRenderer
    ) {
        $this->encodedPolylineStyleRenderer = $encodedPolylineStyleRenderer;
        $this->encodedPolylineValueRenderer = $encodedPolylineValueRenderer;
    }

    /**
     * @param EncodedPolyline $encodedPolyline
     *
     * @return string
     */
    public function render(EncodedPolyline $encodedPolyline)
    {
        $result = [];
        $style = $this->encodedPolylineStyleRenderer->render($encodedPolyline);

        if (!empty($style)) {
            $result[] = $style;
        }

        $result[] = $this->encodedPolylineValueRenderer->render($encodedPolyline);

        return implode('|', $result);
    }
}
