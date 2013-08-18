<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Map;

/**
 * Abstract map helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMapHelper
{
    /**
     * Gets the javascript container name according to the map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The javascript container name.
     */
    protected function getJsContainerName(Map $map)
    {
        return $map->getJavascriptVariable().'_container';
    }
}
