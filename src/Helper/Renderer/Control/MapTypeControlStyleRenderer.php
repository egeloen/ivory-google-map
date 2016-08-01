<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleRenderer extends AbstractRenderer
{
    /**
     * @param string $style
     *
     * @return string
     */
    public function render($style)
    {
        return $this->getFormatter()->renderConstant('MapTypeControlStyle', $style);
    }
}
