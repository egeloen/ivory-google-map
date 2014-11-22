<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Animation.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Animation
 * @author GeLo <geloen.eric@gmail.com>
 */
class Animation extends AbstractUninstantiableAsset
{
    const BOUNCE = 'bounce';
    const DROP = 'drop';
}
