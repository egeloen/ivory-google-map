<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Place\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateCollector extends AbstractCollector
{
    /**
     * @var AutocompleteBoundCollector
     */
    private $boundCollector;

    /**
     * @param AutocompleteBoundCollector $boundCollector
     */
    public function __construct(AutocompleteBoundCollector $boundCollector)
    {
        $this->setBoundCollector($boundCollector);
    }

    /**
     * @return AutocompleteBoundCollector
     */
    public function getBoundCollector()
    {
        return $this->boundCollector;
    }

    /**
     * @param AutocompleteBoundCollector $boundCollector
     */
    public function setBoundCollector(AutocompleteBoundCollector $boundCollector)
    {
        $this->boundCollector = $boundCollector;
    }

    /**
     * @param Autocomplete $autocomplete
     * @param Coordinate[] $coordinates
     *
     * @return Coordinate[]
     */
    public function collect(Autocomplete $autocomplete, array $coordinates = [])
    {
        foreach ($this->boundCollector->collect($autocomplete) as $bound) {
            if ($bound->hasSouthWest()) {
                $coordinates = $this->collectValue($bound->getSouthWest(), $coordinates);
            }

            if ($bound->hasNorthEast()) {
                $coordinates = $this->collectValue($bound->getNorthEast(), $coordinates);
            }
        }

        return $coordinates;
    }
}
