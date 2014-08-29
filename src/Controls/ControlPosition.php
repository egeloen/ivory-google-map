<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

/**
 * Control position which describes a google map control position.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPosition
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
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available control positions.
     *
     * @return array The control positions.
     */
    public static function getControlPositions()
    {
        return array(
            self::BOTTOM_CENTER,
            self::BOTTOM_LEFT,
            self::BOTTOM_RIGHT,
            self::LEFT_BOTTOM,
            self::LEFT_CENTER,
            self::LEFT_TOP,
            self::RIGHT_BOTTOM,
            self::RIGHT_CENTER,
            self::RIGHT_TOP,
            self::TOP_CENTER,
            self::TOP_LEFT,
            self::TOP_RIGHT,
        );
    }
}
