<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeRenderer extends AbstractRenderer
{
    /**
     * @param Size $size
     *
     * @return string
     */
    public function render(Size $size)
    {
        $formatter = $this->getFormatter();
        $arguments = [
            $size->getWidth(),
            $size->getHeight(),
        ];

        if ($size->hasUnits()) {
            $arguments[] = $formatter->renderEscape($size->getWidthUnit());
            $arguments[] = $formatter->renderEscape($size->getHeightUnit());
        }

        return $formatter->renderObjectAssignment($size, $formatter->renderObject('Size', $arguments));
    }
}
