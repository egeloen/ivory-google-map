<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Base;

use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeCollector extends AbstractCollector
{
    /**
     * @var InfoWindowCollector
     */
    private $infoWindowCollector;

    /**
     * @var IconCollector
     */
    private $iconCollector;

    /**
     * @param InfoWindowCollector $infoWindowCollector
     * @param IconCollector       $iconCollector
     */
    public function __construct(InfoWindowCollector $infoWindowCollector, IconCollector $iconCollector)
    {
        $this->setInfoWindowCollector($infoWindowCollector);
        $this->setIconCollector($iconCollector);
    }

    /**
     * @return InfoWindowCollector
     */
    public function getInfoWindowCollector()
    {
        return $this->infoWindowCollector;
    }

    /**
     * @param InfoWindowCollector $infoWindowCollector
     */
    public function setInfoWindowCollector(InfoWindowCollector $infoWindowCollector)
    {
        $this->infoWindowCollector = $infoWindowCollector;
    }

    /**
     * @return IconCollector
     */
    public function getIconCollector()
    {
        return $this->iconCollector;
    }

    /**
     * @param IconCollector $iconCollector
     */
    public function setIconCollector(IconCollector $iconCollector)
    {
        $this->iconCollector = $iconCollector;
    }

    /**
     * @param Map    $map
     * @param Size[] $sizes
     *
     * @return Size[]
     */
    public function collect(Map $map, array $sizes = [])
    {
        foreach ($this->infoWindowCollector->collect($map) as $infoWindow) {
            if ($infoWindow->hasPixelOffset()) {
                $sizes = $this->collectValue($infoWindow->getPixelOffset(), $sizes);
            }
        }

        foreach ($this->iconCollector->collect($map) as $icon) {
            if ($icon->hasSize()) {
                $sizes = $this->collectValue($icon->getSize(), $sizes);
            }

            if ($icon->hasScaledSize()) {
                $sizes = $this->collectValue($icon->getScaledSize(), $sizes);
            }
        }

        return $sizes;
    }
}
