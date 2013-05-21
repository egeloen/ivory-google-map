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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\InfoBox;

/**
 * Info window helper.
 *
 * @author Radu Topala <radu.topala@trisoft.ro>
 */
class InfoBoxHelper
{
   /**
     * Renders an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoBox $infoBox     The info window.
     * @param boolean                              $renderPosition TRUE if the position is rendered else FALSE.
     *
     * @return string The JS output.
     */
    public function render(InfoBox $infoBox, $renderPosition = true)
    {
        if ($renderPosition) {
            $infoBoxJSONOptions = sprintf('{"position":%s,', $infoBox->getPosition()->getJavascriptVariable());
        } else {
            $infoBoxJSONOptions = '{';
        }

        if ($infoBox->hasPixelOffset()) {
            $infoBoxJSONOptions .= '"pixelOffset":'.$infoBox->getPixelOffset()->getJavascriptVariable().',';
        }

        $infoBoxOptions = array_merge(
            array('content' => $infoBox->getContent()),
            $infoBox->getOptions()
        );

        $infoBoxJSONOptions .= substr(json_encode($infoBoxOptions), 1);

        return sprintf(
            '%s = new InfoBox(%s);'.PHP_EOL,
            $infoBox->getJavascriptVariable(),
            $infoBoxJSONOptions
        );
    }

    /**
     * Renders the info box open flag.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoBox $infoBox The box window.
     * @param \Ivory\GoogleMap\Map                 $map        The map.
     * @param \Ivory\GoogleMap\Overlays\Marker     $marker     The marker.
     *
     * @return string The JS output.
     */
    public function renderOpen(InfoBox $infoBox, Map $map, Marker $marker = null)
    {
        if ($marker !== null) {
            return sprintf(
                '%s.open(%s, %s);'.PHP_EOL,
                $infoBox->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        }

        return sprintf('%s.open(%s);'.PHP_EOL, $infoBox->getJavascriptVariable(), $map->getJavascriptVariable());
    }

    /**
     * Renders the info box close flag.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoBox $infoBox The box window.
     *
     * @return string The JS output.
     */
    public function renderClose(InfoBox $infoBox)
    {
        return sprintf('%s.close();'.PHP_EOL, $infoBox->getJavascriptVariable());
    }
}
