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
 * Info window type.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowType extends AbstractUninstantiableAsset
{
    const DEFAULT_ = 'default';
    const INFOBOX = 'infobox';
}
