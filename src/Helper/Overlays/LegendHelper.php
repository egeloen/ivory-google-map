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

use Ivory\GoogleMap\Helper\AbstractHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Legend;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Legend helper.
 *
 * @author Elie CHARRA <elie.charra@gmail.com>
 */
class LegendHelper extends AbstractHelper
{

    /**
     * Renders a legend.
     *
     * @param Ivory\GoogleMap\Overlays\Legend $legend The legend.
     *
     * @return string The JS output.
     */
    public function render(Map $map)
    {
        return sprintf('google.maps.event.addListenerOnce(%s, \'idle\', function(){document.getElementById(\'%s\').style.display = "block";});' . PHP_EOL . '%s.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById(\'%s\'));'.PHP_EOL, $map->getJavascriptVariable(), $map->getLegend()->getName(), $map->getJavascriptVariable(), $map->getLegend()->getName());
    }

    /**
     * Renders a legend HTML container.
     *
     * @param Ivory\GoogleMap\Overlays\Legend $legend The legend.
     *
     * @return string The HTML output.
     */
    public function renderHtmlContainer(Map $map)
    {
        $legendStyles = '';
        foreach ($map->getLegend()->getStyles() as $styleName => $styleValue)
        {
            $legendStyles .= $styleName . ': ' . $styleValue . ';';
        }

        $legendContent = '';
        /* @var $marker Ivory\GoogleMap\Overlays\Marker */
        foreach ($map->getMarkerCluster()->getMarkers() as $marker)
        {
            $legendContent .= '<div><img style="vertical-align:middle" src="' . $marker->getIcon()->getUrl() . '" alt="' . $marker->getIcon()->getName() . '" /><span>' . $marker->getIcon()->getName() . '</span></div>';
        }

        return sprintf('<div id="%s" style="display:none; %s">%s</div>', $map->getLegend()->getName(), $legendStyles, $legendContent);
    }

}
