<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Base;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Travel mode.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#TravelMode
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelMode extends AbstractUninstantiableAsset
{
    const BICYCLING = 'BICYCLING';
    const DRIVING = 'DRIVING';
    const WALKING = 'WALKING';
    const TRANSIT = 'TRANSIT';
}
