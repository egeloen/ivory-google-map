<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Directions;

/**
 * A directions status which describes the google map direction status.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStatus
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const MAX_WAYPOINTS_EXCEEDED = 'MAX_WAYPOINTS_EXCEEDED';
    const NOT_FOUND = 'NOT_FOUND';
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
     * Gets the available directions status.
     *
     * @return array The available directions status.
     */
    public static function getDirectionsStatus()
    {
        return array(
            self::INVALID_REQUEST,
            self::MAX_WAYPOINTS_EXCEEDED,
            self::NOT_FOUND,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::UNKNOWN_ERROR,
            self::ZERO_RESULTS,
        );
    }
}
