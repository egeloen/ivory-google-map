<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Zoom control style.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlStyle
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyle extends AbstractUninstantiableAsset
{
    const DEFAULT_ = 'default';
    const LARGE = 'large';
    const SMALL = 'small';
}
