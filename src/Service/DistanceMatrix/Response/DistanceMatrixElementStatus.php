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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixElementStatus
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class DistanceMatrixElementStatus
{
    const NOT_FOUND = 'NOT_FOUND';
    const OK = 'OK';
    const ZERO_RESULTS = 'ZERO_RESULTS';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
