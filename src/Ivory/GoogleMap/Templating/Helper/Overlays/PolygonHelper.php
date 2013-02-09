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
    Ivory\GoogleMap\Overlays\Polygon,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper;

/**
 * Polygon helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /**
     * Creates a polygon helper.
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
     * Renders a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     * @param \Ivory\GoogleMapl\Map             $map     The map.
     *
     * @return string Ths JS output.
     */
    public function render(Polygon $polygon, Map $map)
    {
        $polygonOptions = $polygon->getOptions();

        $polygonCoordinates = array();
        foreach ($polygon->getCoordinates() as $coordinate) {
            $polygonCoordinates[] = $this->coordinateHelper->render($coordinate);
        }

        $polygonJSONOptions = sprintf('{"map":%s,"paths":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polygonCoordinates).']'
        );

        if (!empty($polygonOptions)) {
            $polygonJSONOptions .= ','.substr(json_encode($polygonOptions), 1);
        } else {
            $polygonJSONOptions .= '}';
        }

        return sprintf('var %s = new google.maps.Polygon(%s);'.PHP_EOL,
            $polygon->getJavascriptVariable(),
            $polygonJSONOptions
        );
    }
}
