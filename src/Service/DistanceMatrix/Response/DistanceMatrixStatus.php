<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixStatus
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class DistanceMatrixStatus
{
    public const INVALID_REQUEST = 'INVALID_REQUEST';
    public const MAX_DIMENSIONS_EXCEEDED = 'MAX_DIMENSIONS_EXCEEDED';
    public const MAX_ELEMENTS_EXCEEDED = 'MAX_ELEMENTS_EXCEEDED';
    public const OK = 'OK';
    public const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    public const REQUEST_DENIED = 'REQUEST_DENIED';
    public const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
