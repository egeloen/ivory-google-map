<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Exception\HelperException;

/**
 * Scale control style helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleHelper
{
    /**
     * Renders a scale control style.
     *
     * @param string $scaleControlStyle The scale control style.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the scale control style is not valid.
     *
     * @return string The JS output.
     */
    public function render($scaleControlStyle)
    {
        switch ($scaleControlStyle) {
            case ScaleControlStyle::DEFAULT_:
                return sprintf('google.maps.ScaleControlStyle.%s', strtoupper($scaleControlStyle));
            default:
                throw HelperException::invalidScaleControlStyle();
        }
    }
}
