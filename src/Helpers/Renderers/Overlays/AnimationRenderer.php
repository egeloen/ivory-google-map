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

/**
 * Animation renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationRenderer
{
    /**
     * Renders an animation.
     *
     * @param string $animation The animation.
     *
     * @return string The rendered animation.
     */
    public function render($animation)
    {
        return 'google.maps.Animation.'.strtoupper($animation);
    }
}
