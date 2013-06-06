<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

/**
 * A distance matrix status which describes the google map distance matrix status.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixStatus
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixStatus
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const MAX_DIMENSIONS_EXCEEDED = 'MAX_DIMENSIONS_EXCEEDED';
    const MAX_ELEMENTS_EXCEEDED = 'MAX_ELEMENTS_EXCEEDED';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available distance matrix status.
     *
     * @return array The available distance matrix status.
     */
    public static function getDistanceMatrixStatus()
    {
        return array(
            self::INVALID_REQUEST,
            self::MAX_DIMENSIONS_EXCEEDED,
            self::MAX_ELEMENTS_EXCEEDED,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::UNKNOWN_ERROR,
        );
    }
}
