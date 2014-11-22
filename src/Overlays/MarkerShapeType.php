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
 * Marker shape type.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeType extends AbstractUninstantiableAsset
{
    const CIRCLE = 'circle';
    const POLYGON = 'poly';
    const RECTANGLE = 'rect';
}
