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
    public const APPROXIMATE = 'APPROXIMATE';
    public const GEOMETRIC_CENTER = 'GEOMETRIC_CENTER';
    public const RANGE_INTERPOLATED = 'RANGE_INTERPOLATED';
    public const ROOFTOP = 'ROOFTOP';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
