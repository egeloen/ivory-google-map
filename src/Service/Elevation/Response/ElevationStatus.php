<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class ElevationStatus
{
    const OK = 'OK';
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
