<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Directions;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class DirectionsAvoid
{
    const TOLLS = 'tolls';
    const HIGHWAYS = 'highways';
    const FERRIES = 'ferries';
    const INDOOR = 'indoor';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
