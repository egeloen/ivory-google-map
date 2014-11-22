<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\OverviewMapControl;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Overview map control renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlRenderer extends AbstractJsonRenderer
{
    /**
     * Renders an overview map control.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl The overview map control.
     *
     * @return string The rendered overview map control.
     */
    public function render(OverviewMapControl $overviewMapControl)
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue('[opened]', $overviewMapControl->isOpened())
            ->build();
    }
}
