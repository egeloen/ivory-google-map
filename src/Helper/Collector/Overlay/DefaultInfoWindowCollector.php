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

use Ivory\GoogleMap\Overlay\InfoWindowType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DefaultInfoWindowCollector extends InfoWindowCollector
{
    /**
     * @param MarkerCollector $markerCollector
     */
    public function __construct(MarkerCollector $markerCollector)
    {
        parent::__construct($markerCollector, InfoWindowType::DEFAULT_);
    }
}
