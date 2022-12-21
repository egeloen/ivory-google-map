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
    public const BOTTOM_CENTER = 'bottom_center';
    public const BOTTOM_LEFT = 'bottom_left';
    public const BOTTOM_RIGHT = 'bottom_right';
    public const LEFT_BOTTOM = 'left_bottom';
    public const LEFT_CENTER = 'left_center';
    public const LEFT_TOP = 'left_top';
    public const RIGHT_BOTTOM = 'right_bottom';
    public const RIGHT_CENTER = 'right_center';
    public const RIGHT_TOP = 'right_top';
    public const TOP_CENTER = 'top_center';
    public const TOP_LEFT = 'top_left';
    public const TOP_RIGHT = 'top_right';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
