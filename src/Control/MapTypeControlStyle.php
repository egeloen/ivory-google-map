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
final class MapTypeControlStyle
{
    const DEFAULT_ = 'default';
    const DROPDOWN_MENU = 'dropdown_menu';
    const HORIZONTAL_BAR = 'horizontal_bar';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
