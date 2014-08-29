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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixElementStatus
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixElementStatus
{
    const NOT_FOUND = 'NOT_FOUND';
    const OK = 'OK';
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
     * Gets the available distance matrix status.
     *
     * @return array The available distance matrix status.
     */
    public static function getDistanceMatrixElementStatus()
    {
        return array(
            self::NOT_FOUND,
            self::OK,
            self::ZERO_RESULTS,
        );
    }
}
