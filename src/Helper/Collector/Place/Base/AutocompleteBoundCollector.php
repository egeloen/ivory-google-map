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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundCollector extends AbstractCollector
{
    /**
     * @param Autocomplete $autocomplete
     * @param Bound[]      $bounds
     *
     * @return Bound[]
     */
    public function collect(Autocomplete $autocomplete, array $bounds = [])
    {
        if ($autocomplete->hasBound()) {
            $bounds = $this->collectValue($autocomplete->getBound(), $bounds);
        }

        return $bounds;
    }
}
