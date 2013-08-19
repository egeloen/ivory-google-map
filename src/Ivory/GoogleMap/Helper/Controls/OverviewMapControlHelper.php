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
use Ivory\GoogleMap\Helper\AbstractHelper;

/**
 * Overview map control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelper extends AbstractHelper
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
        return $this->jsonBuilder
            ->reset()
            ->setValue('[opened]', $overviewMapControl->isOpened())
            ->build();
    }
}
