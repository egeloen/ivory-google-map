<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Exception\TemplatingException,
    Ivory\GoogleMap\Overlays\Animation;

/**
 * Animation helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationHelper
{
    /**
     * Renders an animation.
     *
     * @param string $animation The animation.
     *
     * @throws \Ivory\GoogleMap\Exception\TemplatingException If the animation is not valid.
     *
     * @return string The JS output.
     */
    public function render($animation)
    {
        switch ($animation) {
            case Animation::BOUNCE:
            case Animation::DROP:
                return sprintf('google.maps.Animation.%s', strtoupper($animation));
            break;

            default:
                throw TemplatingException::invalidAnimation();
            break;
        }
    }
}
