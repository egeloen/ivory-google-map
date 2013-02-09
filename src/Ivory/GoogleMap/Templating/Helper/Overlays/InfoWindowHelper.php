<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Map,
    Ivory\GoogleMap\Overlays\Marker,
    Ivory\GoogleMap\Overlays\InfoWindow,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper,
    Ivory\GoogleMap\Templating\Helper\Base\SizeHelper;

/**
 * Info window helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper */
    protected $sizeHelper;

    /**
     * Creates an info window helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper       $sizeHelper       The size helper.
     */
    public function __construct(CoordinateHelper $coordinateHelper = null, SizeHelper $sizeHelper = null)
    {
        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($sizeHelper === null) {
            $sizeHelper = new SizeHelper();
        }

        $this->coordinateHelper = $coordinateHelper;
        $this->sizeHelper = $sizeHelper;
    }

    /**
     * Renders an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow     The info window.
     * @param boolean                              $renderPosition TRUE if the position is rendered else FALSE.
     *
     * @return string The JS output.
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        if ($renderPosition) {
            $infoWindowJSONOptions = sprintf('{"position":%s,',
                $this->coordinateHelper->render($infoWindow->getPosition())
            );
        } else {
            $infoWindowJSONOptions = '{';
        }

        if ($infoWindow->hasPixelOffset()) {
            $infoWindowJSONOptions .= '"pixelOffset":'.$this->sizeHelper->render($infoWindow->getPixelOffset()).',';
        }

        $infoWindowOptions = array_merge(
            array('content' => $infoWindow->getContent()),
            $infoWindow->getOptions()
        );

        $infoWindowJSONOptions .= substr(json_encode($infoWindowOptions), 1);

        return sprintf('var %s = new google.maps.InfoWindow(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $infoWindowJSONOptions
        );
    }

    /**
     * Renders the info window open flag.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     * @param \Ivory\GoogleMap\Map                 $map        The map.
     * @param \Ivory\GoogleMap\Overlays\Marker     $marker     The marker.
     *
     * @return string The JS output.
     */
    public function renderOpen(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        if ($marker !== null) {
            return sprintf('%s.open(%s, %s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        }

        return sprintf('%s.open(%s);'.PHP_EOL, $infoWindow->getJavascriptVariable(), $map->getJavascriptVariable());
    }
}
