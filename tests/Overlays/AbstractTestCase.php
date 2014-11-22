<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Overlays test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a circle instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle.
     */
    protected function assertCircleInstance($circle)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Circle', $circle);
    }

    /**
     * Asserts an encoded polyline instance.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     */
    protected function assertEncodedPolylineInstance($encodedPolyline)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\EncodedPolyline', $encodedPolyline);
    }

    /**
     * Asserts an extendable instance.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extendable The extendable.
     */
    protected function assertExtendableInstance($extendable)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\ExtendableInterface', $extendable);
    }

    /**
     * Asserts a ground overlay instance.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     */
    protected function assertGroundOverlayInstance($groundOverlay)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\GroundOverlay', $groundOverlay);
    }

    /**
     * Asserts an icon instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon $icon The icon.
     */
    protected function assertIconInstance($icon)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Icon', $icon);
    }

    /**
     * Asserts an info window instance.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    protected function assertInfoWindowInstance($infoWindow)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\InfoWindow', $infoWindow);
    }

    /**
     * Asserts a marker cluster instance.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     */
    protected function assertMarkerClusterInstance($markerCluster)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\MarkerCluster', $markerCluster);
    }

    /**
     * Asserts a marker instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     */
    protected function assertMarkerInstance($marker)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Marker', $marker);
    }

    /**
     * Asserts a marker shape instance.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $markerShape The marker shape.
     */
    protected function assertMarkerShapeInstance($markerShape)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\MarkerShape', $markerShape);
    }

    /**
     * Asserts a point instance.
     *
     * @param \Ivory\GoogleMap\Base\Point $point The point.
     */
    protected function assertPointInstance($point)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Point', $point);
    }

    /**
     * Asserts a polygon instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon.
     */
    protected function assertPolygonInstance($polygon)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Polygon', $polygon);
    }

    /**
     * Asserts a polyline instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline The polyline.
     */
    protected function assertPolylineInstance($polyline)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Polyline', $polyline);
    }

    /**
     * Asserts a rectangle instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     */
    protected function assertRectangleInstance($rectangle)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Rectangle', $rectangle);
    }
}
