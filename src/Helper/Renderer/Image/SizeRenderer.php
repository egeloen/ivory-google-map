<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeRenderer
{
    /**
     * @param Map $map
     *
     * @return string
     */
    public function render(Map $map)
    {
        return $this->getDimension($map, 'width').'x'.$this->getDimension($map, 'height');
    }

    /**
     * @param Map    $map
     * @param string $side
     *
     * @return string
     */
    private function getDimension(Map $map, $side)
    {
        return $map->hasStaticOption($side) ? $map->getStaticOption($side) : '300';
    }
}
