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
 * Distance matrix element status.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixElementStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixElementStatus extends AbstractUninstantiableAsset
{
    const NOT_FOUND = 'NOT_FOUND';
    const OK = 'OK';
    const ZERO_RESULTS = 'ZERO_RESULTS';
}
