<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Base;

use Ivory\GoogleMap\Base\Size;

/**
 * Size renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeRenderer
{
    /**
     * Renders a size.
     *
     * @param \Ivory\GoogleMap\Base\Size $size The size.
     *
     * @return string The rendered size.
     */
    public function render(Size $size)
    {
        return sprintf(
            'new google.maps.Size(%s,%s,%s,%s)',
            $size->getWidth(),
            $size->getHeight(),
            $size->hasWidthUnit() ? '"'.$size->getWidthUnit().'"' : 'null',
            $size->hasHeightUnit() ? '"'.$size->getHeightUnit().'"' : 'null'
        );
    }
}
