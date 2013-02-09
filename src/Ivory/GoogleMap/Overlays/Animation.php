<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

/**
 * Animation which describes a google map animation.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Animation
 * @author GeLo <geloen.eric@gmail.com>
 */
class Animation
{
    const BOUNCE = 'bounce';
    const DROP = 'drop';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available animations.
     *
     * @return array The animations.
     */
    public static function getAnimations()
    {
        return array(
            self::BOUNCE,
            self::DROP,
        );
    }
}
