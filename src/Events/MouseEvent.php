<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Events;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Mouse event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MouseEvent extends AbstractUninstantiableAsset
{
    const CLICK = 'click';
    const DBLCLICK = 'dblclick';
    const MOUSEUP = 'mouseup';
    const MOUSEDOWN = 'mousedown';
    const MOUSEOVER = 'mouseover';
    const MOUSEOUT = 'mouseout';
}
