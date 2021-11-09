<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEvent extends AbstractEvent
{
    private Map $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function getMap(): Map
    {
        return $this->map;
    }
}
