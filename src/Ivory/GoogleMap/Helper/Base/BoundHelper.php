<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Bound helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelper
{
    /**
     * Renders the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The JS output.
     */
    public function render(Bound $bound)
    {
        if ($bound->hasExtends() || !$bound->hasCoordinates()) {
            return sprintf('%s = new google.maps.LatLngBounds();'.PHP_EOL, $bound->getJavascriptVariable());
        }

        return sprintf(
            '%s = new google.maps.LatLngBounds(%s, %s);'.PHP_EOL,
            $bound->getJavascriptVariable(),
            $bound->getSouthWest()->getJavascriptVariable(),
            $bound->getNorthEast()->getJavascriptVariable()
        );
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
        $output = array();

        foreach ($bound->getExtends() as $extend) {
            if (($extend instanceof Marker) || ($extend instanceof InfoWindow)) {
                $output[] = sprintf(
                    '%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            } elseif (($extend instanceof Polyline)
                || ($extend instanceof EncodedPolyline)
                || ($extend instanceof Polygon)
            ) {
                $output[] = sprintf(
                    '%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $extend->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            } elseif (($extend instanceof Rectangle) || ($extend instanceof GroundOverlay)) {
                $output[] = sprintf(
                    '%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getBound()->getJavascriptVariable()
                );
            } elseif ($extend instanceof Circle) {
                $output[] = sprintf(
                    '%s.union(%s.getBounds());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            }
        }

        return implode('', $output);
    }
}
