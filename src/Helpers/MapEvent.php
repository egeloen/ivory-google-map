<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Map;

/**
 * Map event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEvent extends AbstractEvent
{
    /** @var \Ivory\GoogleMap\Map */
    private $map;

    /**
     * Creates a map event.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     */
    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    /**
     * Gets the map.
     *
     * @return \Ivory\GoogleMap\Map The map.
     */
    public function getMap()
    {
        return $this->map;
    }
}
