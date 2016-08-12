<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventRenderer extends AbstractEventRenderer
{
    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'addListener';
    }

    /**
     * {@inheritdoc}
     */
    protected function hasCapture()
    {
        return false;
    }
}
