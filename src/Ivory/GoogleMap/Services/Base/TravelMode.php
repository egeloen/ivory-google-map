<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Base;

/**
 * A travel mode which describes the google map travel mode.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#TravelMode
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelMode
{
    const BICYCLING = 'BICYCLING';
    const DRIVING = 'DRIVING';
    const WALKING = 'WALKING';
    const TRANSIT = 'TRANSIT';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available travel modes.
     *
     * @return array The available travel modes.
     */
    public static function getTravelModes()
    {
        return array(
            self::BICYCLING,
            self::DRIVING,
            self::WALKING,
            self::TRANSIT,
        );
    }
}
