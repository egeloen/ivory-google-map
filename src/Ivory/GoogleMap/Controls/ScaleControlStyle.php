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
 * Scale control style which describes a google map scale control style.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlStyle
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyle
{
    const DEFAULT_ = 'default';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available map scale control styles
     *
     * @return array The map scale constrol styles.
     */
    public static function getScaleControlStyles()
    {
        return array(
            self::DEFAULT_,
        );
    }
}
