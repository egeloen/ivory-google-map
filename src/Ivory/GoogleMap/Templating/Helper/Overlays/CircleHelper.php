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
    Ivory\GoogleMap\Overlays\Circle,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper;

/**
 * Circle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /**
     * Create a circle helper.
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
     * Gets the coordinate helper
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper The coordinate helper
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
     * Renders a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     * @param \Ivory\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    public function render(Circle $circle, Map $map)
    {
        $circleOptions = array_merge(array('radius' => $circle->getRadius()), $circle->getOptions());

        $circleJSONOptions = sprintf('{"map":%s,"center":%s,',
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($circle->getCenter())
        );

        $circleJSONOptions .= substr(json_encode($circleOptions), 1);

        return sprintf('var %s = new google.maps.Circle(%s);'.PHP_EOL,
            $circle->getJavascriptVariable(),
            $circleJSONOptions
        );
    }
}
