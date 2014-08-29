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
 * Zoom control style which describes a google map zoom control style.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlStyle
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyle
{
    const DEFAULT_ = 'default';
    const LARGE = 'large';
    const SMALL = 'small';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available map zoom control styles.
     *
     * @return array The map zoom control styles.
     */
    public static function getZoomControlStyles()
    {
        return array(
            self::DEFAULT_,
            self::LARGE,
            self::SMALL,
        );
    }
}
