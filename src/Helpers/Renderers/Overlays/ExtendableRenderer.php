<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlays\ExtendableInterface;

/**
 * Extendable renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableRenderer
{
    /**
     * Renders an extend.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The extend.
     * @param \Ivory\GoogleMap\Base\Bound                   $bound  The bound.
     *
     * @return string The rendered extend.
     */
    public function render(ExtendableInterface $extend, Bound $bound)
    {
        return $extend->renderExtend($bound);
    }
}
