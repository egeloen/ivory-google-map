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
 * A unit system which describes the google map unit system.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#UnitSystem
 * @author GeLo <geloen.eric@gmail.com>
 */
class UnitSystem
{
    const IMPERIAL = 'IMPERIAL';
    const METRIC = 'METRIC';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available unit systems.
     *
     * @return array The available unit systems.
     */
    public static function getUnitSystems()
    {
        return array(
            self::IMPERIAL,
            self::METRIC,
        );
    }
}
