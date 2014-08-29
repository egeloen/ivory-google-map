<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Exception\HelperException;
use Ivory\GoogleMap\Overlays\Animation;

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
     * @throws \Ivory\GoogleMap\Exception\HelperException If the animation is not valid.
     *
     * @return string The JS output.
     */
    public function render($animation)
    {
        switch ($animation) {
            case Animation::BOUNCE:
            case Animation::DROP:
                return sprintf('google.maps.Animation.%s', strtoupper($animation));
            default:
                throw HelperException::invalidAnimation();
        }
    }
}
