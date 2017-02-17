<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\IconSequence;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequenceCollector extends AbstractCollector
{
    /**
     * @var PolylineCollector
     */
    private $polylineCollector;

    /**
     * @param PolylineCollector $polylineCollector
     */
    public function __construct(PolylineCollector $polylineCollector)
    {
        $this->setPolylineCollector($polylineCollector);
    }

    /**
     * @return PolylineCollector
     */
    public function getPolylineCollector()
    {
        return $this->polylineCollector;
    }

    /**
     * @param PolylineCollector $polylineCollector
     */
    public function setPolylineCollector(PolylineCollector $polylineCollector)
    {
        $this->polylineCollector = $polylineCollector;
    }

    /**
     * @param Map            $map
     * @param IconSequence[] $icons
     *
     * @return IconSequence[]
     */
    public function collect(Map $map, array $icons = [])
    {
        foreach ($this->polylineCollector->collect($map) as $polyline) {
            if ($polyline->hasIconSequences()) {
                $icons = $this->collectValues($polyline->getIconSequences());
            }
        }

        return $icons;
    }
}
