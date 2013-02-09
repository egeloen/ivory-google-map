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
 * Map type control style which describes a google map type control style.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyle
{
    const DEFAULT_ = 'default';
    const DROPDOWN_MENU = 'dropdown_menu';
    const HORIZONTAL_BAR = 'horizontal_bar';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available map type control styles.
     *
     * @return array The map type control styles.
     */
    public static function getMapTypeControlStyles()
    {
        return array(
            self::DEFAULT_,
            self::DROPDOWN_MENU,
            self::HORIZONTAL_BAR,
        );
    }
}
