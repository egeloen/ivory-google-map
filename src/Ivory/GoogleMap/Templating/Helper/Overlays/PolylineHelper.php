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
    Ivory\GoogleMap\Overlays\Polyline,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper;

/**
 * Polyline helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /**
     * Creates a polyline helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function __construct(CoordinateHelper $coordinateHelper = null)
    {
        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        $this->setCoordinateHelper($coordinateHelper);
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     * @param \Ivory\GoogleMap\Map               $map      The map.
     *
     * @return string The JS output.
     */
    public function render(Polyline $polyline, Map $map)
    {
        $polylineOptions = $polyline->getOptions();

        $polylineCoordinates = array();
        foreach ($polyline->getCoordinates() as $coordinate) {
            $polylineCoordinates[] = $this->coordinateHelper->render($coordinate);
        }

        $polylineJSONOptions = sprintf('{"map":%s,"path":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polylineCoordinates).']'
        );

        if (!empty($polylineOptions)) {
            $polylineJSONOptions .= ','.substr(json_encode($polylineOptions), 1);
        } else {
            $polylineJSONOptions .= '}';
        }

        return sprintf('var %s = new google.maps.Polyline(%s);'.PHP_EOL,
            $polyline->getJavascriptVariable(),
            $polylineJSONOptions
        );
    }
}
