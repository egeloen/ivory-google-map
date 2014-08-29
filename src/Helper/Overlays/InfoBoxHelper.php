<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Overlays\InfoWindow;

/**
 * InfoBox helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxHelper extends InfoWindowHelper
{
    /**
     * {@inheritdoc}
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        $this->doRender($infoWindow, $renderPosition);

        return sprintf(
            '%s = new InfoBox(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
