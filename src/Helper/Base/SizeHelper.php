<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Base;

use Ivory\GoogleMap\Base\Size;

/**
 * Size helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeHelper
{
    /**
     * Renders a size.
     *
     * @param \Ivory\GoogleMap\Base\Size $size The size.
     *
     * @return string The JS output.
     */
    public function render(Size $size)
    {
        if ($size->hasUnits()) {
            return sprintf(
                '%s = new google.maps.Size(%s, %s, "%s", "%s");'.PHP_EOL,
                $size->getJavascriptVariable(),
                $size->getWidth(),
                $size->getHeight(),
                $size->getWidthUnit(),
                $size->getHeightUnit()
            );
        }

        return sprintf(
            '%s = new google.maps.Size(%s, %s);'.PHP_EOL,
            $size->getJavascriptVariable(),
            $size->getWidth(), $size->getHeight()
        );
    }
}
