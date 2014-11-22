<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Map type id.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeId extends AbstractUninstantiableAsset
{
    const HYBRID = 'hybrid';
    const ROADMAP = 'roadmap';
    const SATELLITE = 'satellite';
    const TERRAIN = 'terrain';
}
