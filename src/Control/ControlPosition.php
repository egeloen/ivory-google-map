<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class ControlPosition
{
    const BOTTOM_CENTER = 'bottom_center';
    const BOTTOM_LEFT = 'bottom_left';
    const BOTTOM_RIGHT = 'bottom_right';
    const LEFT_BOTTOM = 'left_bottom';
    const LEFT_CENTER = 'left_center';
    const LEFT_TOP = 'left_top';
    const RIGHT_BOTTOM = 'right_bottom';
    const RIGHT_CENTER = 'right_center';
    const RIGHT_TOP = 'right_top';
    const TOP_CENTER = 'top_center';
    const TOP_LEFT = 'top_left';
    const TOP_RIGHT = 'top_right';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
