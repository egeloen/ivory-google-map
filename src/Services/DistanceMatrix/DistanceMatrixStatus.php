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

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Distance matrix status.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixStatus extends AbstractUninstantiableAsset
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const MAX_DIMENSIONS_EXCEEDED = 'MAX_DIMENSIONS_EXCEEDED';
    const MAX_ELEMENTS_EXCEEDED = 'MAX_ELEMENTS_EXCEEDED';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
}
