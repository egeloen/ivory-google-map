<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Layer;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerRenderer extends AbstractJsonRenderer
{
    /**
     * @param KmlLayer $kmlLayer
     * @param Map      $map
     *
     * @return string
     */
    public function render(KmlLayer $kmlLayer, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValues($kmlLayer->getOptions());

        return $formatter->renderObjectAssignment($kmlLayer, $formatter->renderObject('KmlLayer', [
            $formatter->renderEscape($kmlLayer->getUrl()),
            $jsonBuilder->build(),
        ]));
    }
}
