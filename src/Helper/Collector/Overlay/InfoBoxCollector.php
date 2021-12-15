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
class InfoBoxCollector extends InfoWindowCollector
{
    public function __construct(MarkerCollector $markerCollector)
    {
        parent::__construct($markerCollector, InfoWindowType::INFO_BOX);
    }
}
