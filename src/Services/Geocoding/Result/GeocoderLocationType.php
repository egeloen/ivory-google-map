<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding\Result;

/**
 * GeocoderLocationType which describes a google map geocoder location type.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderLocationType
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderLocationType
{
    const APPROXIMATE = 'APPROXIMATE';
    const GEOMETRIC_CENTER = 'GEOMETRIC_CENTER';
    const RANGE_INTERPOLATED = 'RANGE_INTERPOLATED';
    const ROOFTOP = 'ROOFTOP';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available geocoder location types.
     *
     * @return array The availabel geocoder location types.
     */
    public static function getGeocoderLocationTypes()
    {
        return array(
            self::APPROXIMATE,
            self::GEOMETRIC_CENTER,
            self::RANGE_INTERPOLATED,
            self::ROOFTOP,
        );
    }
}
