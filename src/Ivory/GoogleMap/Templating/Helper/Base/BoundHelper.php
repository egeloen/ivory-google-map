<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Base;

use Ivory\GoogleMap\Base\Bound,
    Ivory\GoogleMap\Overlays\Circle,
    Ivory\GoogleMap\Overlays\EncodedPolyline,
    Ivory\GoogleMap\Overlays\GroundOverlay,
    Ivory\GoogleMap\Overlays\InfoWindow,
    Ivory\GoogleMap\Overlays\Marker,
    Ivory\GoogleMap\Overlays\Polyline,
    Ivory\GoogleMap\Overlays\Polygon,
    Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Bound helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /**
     * Creates a bound helper.
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
     * @return \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper
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
     * Renders the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The JS output.
     */
    public function render(Bound $bound)
    {
        $html = array();

        if ($bound->hasExtends() || !$bound->hasCoordinates()) {
            $html[] = sprintf('var %s = new google.maps.LatLngBounds();'.PHP_EOL, $bound->getJavascriptVariable());

            if ($bound->hasExtends()) {
                $html[] = $this->renderExtends($bound);
            }
        } else {
            $html[] = sprintf('var %s = new google.maps.LatLngBounds(%s, %s);'.PHP_EOL,
                $bound->getJavascriptVariable(),
                $this->coordinateHelper->render($bound->getSouthWest()),
                $this->coordinateHelper->render($bound->getNorthEast())
            );
        }

        return implode('', $html);
    }

    /**
     * Renders the bound's extend of a marker.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The JS output.
     */
    public function renderExtends(Bound $bound)
    {
        $html = array();

        foreach ($bound->getExtends() as $extend) {
            if (($extend instanceof Marker) || ($extend instanceof InfoWindow)) {
                $html[] = sprintf('%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            } else if(($extend instanceof Polyline) || ($extend instanceof EncodedPolyline) || ($extend instanceof Polygon)) {
                $html[] = sprintf('%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $extend->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            } else if(($extend instanceof Rectangle) || ($extend instanceof GroundOverlay)) {
                $html[] = sprintf('%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getBound()->getJavascriptVariable()
                );
            } else if($extend instanceof Circle) {
                $html[] = sprintf('%s.union(%s.getBounds());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            }
        }

        return implode('', $html);
    }
}
