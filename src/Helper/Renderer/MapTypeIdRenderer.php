<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdRenderer extends AbstractRenderer
{
    /**
     * @param string $id
     *
     * @return string
     */
    public function render($id)
    {
        return $this->getFormatter()->renderConstant('MapTypeId', $id);
    }
}
