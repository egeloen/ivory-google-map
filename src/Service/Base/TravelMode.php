<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#TravelMode
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class TravelMode
{
    public const BICYCLING = 'BICYCLING';
    public const DRIVING = 'DRIVING';
    public const WALKING = 'WALKING';
    public const TRANSIT = 'TRANSIT';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
