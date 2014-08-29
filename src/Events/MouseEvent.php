<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Events;

/**
 * Mouse event describes the google map mouse event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MouseEvent
{
    const CLICK = 'click';
    const DBLCLICK = 'dblclick';
    const MOUSEUP = 'mouseup';
    const MOUSEDOWN = 'mousedown';
    const MOUSEOVER = 'mouseover';
    const MOUSEOUT = 'mouseout';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available mouse events.
     *
     * @return array The mouse events.
     */
    public static function getMouseEvents()
    {
        return array(
            self::CLICK,
            self::DBLCLICK,
            self::MOUSEUP,
            self::MOUSEDOWN,
            self::MOUSEOVER,
            self::MOUSEOUT,
        );
    }
}
