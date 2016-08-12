<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowRenderer extends AbstractInfoWindowRenderer
{
    /**
     * {@inheritdoc}
     */
    protected function getClass()
    {
        return 'InfoWindow';
    }
}
