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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderLocationType
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class GeometryLocationType
{
    const APPROXIMATE = 'APPROXIMATE';
    const GEOMETRIC_CENTER = 'GEOMETRIC_CENTER';
    const RANGE_INTERPOLATED = 'RANGE_INTERPOLATED';
    const ROOFTOP = 'ROOFTOP';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
