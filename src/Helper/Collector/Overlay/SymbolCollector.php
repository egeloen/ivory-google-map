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
    private ?MarkerCollector $markerCollector = null;

    private ?IconSequenceCollector $iconSequenceCollector = null;

    public function __construct(MarkerCollector $markerCollector, IconSequenceCollector $iconSequenceCollector)
    {
        $this->setMarkerCollector($markerCollector);
        $this->setIconSequenceCollector($iconSequenceCollector);
    }

    public function getMarkerCollector(): MarkerCollector
    {
        return $this->markerCollector;
    }

    public function setMarkerCollector(MarkerCollector $markerCollector): void
    {
        $this->markerCollector = $markerCollector;
    }

    public function getIconSequenceCollector(): IconSequenceCollector
    {
        return $this->iconSequenceCollector;
    }

    public function setIconSequenceCollector(IconSequenceCollector $iconSequenceCollector): void
    {
        $this->iconSequenceCollector = $iconSequenceCollector;
    }

    /**
     * @param Symbol[] $symbols
     * @return Symbol[]
     */
    public function collect(Map $map, array $symbols = []): array
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
