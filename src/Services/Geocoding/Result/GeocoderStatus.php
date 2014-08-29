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
 * Geocoder status which describes a google map geocoder status.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderStatus
{
    const ERROR = 'ERROR';
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const ZERO_RESULTS = 'ZERO_RESULTS';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available geocoder status.
     *
     * @return array The available geocoder status.
     */
    public static function getGeocoderStatus()
    {
        return array(
            self::ERROR,
            self::INVALID_REQUEST,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::UNKNOWN_ERROR,
            self::ZERO_RESULTS,
        );
    }
}
