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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ControlRendererInterface
{
    /**
     * @param object $control
     *
     * @return string
     */
    public function render($control);
}
