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
use Ivory\GoogleMap\Overlay\Symbol;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolCollector extends AbstractCollector
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * @var IconSequenceCollector
     */
    private $iconSequenceCollector;

    /**
     * @param MarkerCollector       $markerCollector
     * @param IconSequenceCollector $iconSequenceCollector
     */
    public function __construct(MarkerCollector $markerCollector, IconSequenceCollector $iconSequenceCollector)
    {
        $this->setMarkerCollector($markerCollector);
        $this->setIconSequenceCollector($iconSequenceCollector);
    }

    /**
     * @return MarkerCollector
     */
    public function getMarkerCollector()
    {
        return $this->markerCollector;
    }

    /**
     * @param MarkerCollector $markerCollector
     */
    public function setMarkerCollector(MarkerCollector $markerCollector)
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @return IconSequenceCollector
     */
    public function getIconSequenceCollector()
    {
        return $this->iconSequenceCollector;
    }

    /**
     * @param IconSequenceCollector $iconSequenceCollector
     */
    public function setIconSequenceCollector(IconSequenceCollector $iconSequenceCollector)
    {
        $this->iconSequenceCollector = $iconSequenceCollector;
    }

    /**
     * @param Map      $map
     * @param Symbol[] $symbols
     *
     * @return Symbol[]
     */
    public function collect(Map $map, array $symbols = [])
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasSymbol()) {
                $symbols = $this->collectValue($marker->getSymbol(), $symbols);
            }
        }

        foreach ($this->iconSequenceCollector->collect($map) as $icon) {
            $symbols = $this->collectValue($icon->getSymbol(), $symbols);
        }

        return $symbols;
    }
}
