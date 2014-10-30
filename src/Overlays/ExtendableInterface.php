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

use Ivory\GoogleMap\Base\Bound;

/**
 * Extend.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ExtendableInterface
{
    /**
     * Renders an extend.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The rendered extend.
     */
    public function renderExtend(Bound $bound);
}
