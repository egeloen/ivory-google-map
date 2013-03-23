<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\OverviewMapControl;

/**
 * Overview map control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelper
{
    /**
     * Renders an overview map control.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl The overview map control.
     *
     * @return string The JS output.
     */
    public function render(OverviewMapControl $overviewMapControl)
    {
        return sprintf('{"opened":%s}', json_encode($overviewMapControl->isOpened()));
    }
}
