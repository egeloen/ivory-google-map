<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase as TestCase;

/**
 * Subscriber test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts an autocomplete container renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer $containerRenderer The container renderer.
     */
    protected function assertAutocompleteContainerRendererInstance($containerRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer',
            $containerRenderer
        );
    }

    /**
     * Asserts an autocomplete coordinate aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator $coordinateAggregator The coordinate aggregator.
     */
    protected function assertAutocompleteCoordinateAggregatorInstance($coordinateAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator',
            $coordinateAggregator
        );
    }

    /**
     * Asserts an autocomplete renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer $autocompleteRenderer The autocomplete renderer.
     */
    protected function assertAutocompleteRendererInstance($autocompleteRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer',
            $autocompleteRenderer
        );
    }

    /**
     * Asserts a bound renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer $boundRenderer The bound renderer.
     */
    protected function assertBoundRendererInstance($boundRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer', $boundRenderer);
    }

    /**
     * Asserts a circle renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer $circleRenderer The circle renderer.
     */
    protected function assertCircleRendererInstance($circleRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer', $circleRenderer);
    }

    /**
     * Asserts the coordinate aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator $coordinateAggregator The coordinate aggregator.
     */
    protected function assertCoordinateAggregatorInstance($coordinateAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator', $coordinateAggregator);
    }

    /**
     * Asserts the coordinate renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer $coordinateRenderer The coordinate renderer.
     */
    protected function assertCoordinateRendererInstance($coordinateRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer', $coordinateRenderer);
    }

    /**
     * Asserts a dom event aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator $domEventAggregator The dom event aggregator.
     */
    protected function assertDomEventAggregatorInstance($domEventAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator', $domEventAggregator);
    }

    /**
     * Asserts a dom event renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer $domEventRenderer The dom event renderer.
     */
    protected function assertDomEventRendererInstance($domEventRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer', $domEventRenderer);
    }

    /**
     * Asserts a dom event once aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator $domEventOnceAggregator The dom event once aggregator.
     */
    protected function assertDomEventOnceAggregatorInstance($domEventOnceAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator',
            $domEventOnceAggregator
        );
    }

    /**
     * Asserts a dom event once renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer $domEventOnceRenderer The dom event once renderer.
     */
    protected function assertDomEventOnceRendererInstance($domEventOnceRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer', $domEventOnceRenderer);
    }

    /**
     * Asserts a encoded polyline aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator $encodedPolylineAggregator The encoded polyline aggregator.
     */
    protected function assertEncodedPolylineAggregatorInstance($encodedPolylineAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator',
            $encodedPolylineAggregator
        );
    }

    /**
     * Asserts a encoded polyline renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer $encodedPolylineRenderer The encoded polyline renderer.
     */
    protected function assertEncodedPolylineRendererInstance($encodedPolylineRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer',
            $encodedPolylineRenderer
        );
    }

    /**
     * Asserts an event aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator $eventAggregator The event aggregator.
     */
    protected function assertEventAggregatorInstance($eventAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator', $eventAggregator);
    }

    /**
     * Asserts an event once aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator $eventOnceAggregator The event once aggregator.
     */
    protected function assertEventOnceAggregatorInstance($eventOnceAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator', $eventOnceAggregator);
    }

    /**
     * Asserts an event once renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer $eventOnceRenderer The event once renderer.
     */
    protected function assertEventOnceRendererInstance($eventOnceRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer', $eventOnceRenderer);
    }

    /**
     * Asserts an event renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer $eventRenderer The event renderer.
     */
    protected function assertEventRendererInstance($eventRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer', $eventRenderer);
    }

    /**
     * Asserts an extendable aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator $extendableAggregator The extendable aggregator.
     */
    protected function assertExtendableAggregatorInstance($extendableAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator',
            $extendableAggregator
        );
    }

    /**
     * Asserts an extendable renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer $extendableRenderer The extendable renderer.
     */
    protected function assertExtendableRendererInstance($extendableRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer', $extendableRenderer);
    }

    /**
     * Asserts a formatter subscriber instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber $formatterSubscriber The formatter subscriber.
     */
    protected function assertFormatterSubscriberInstance($formatterSubscriber)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber',
            $formatterSubscriber
        );
    }

    /**
     * Asserts a ground overlay renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer $groundOverlayRenderer The ground overlay renderer.
     */
    protected function assertGroundOverlayRendererInstance($groundOverlayRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer',
            $groundOverlayRenderer
        );
    }

    /**
     * Asserts an icon renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer $iconRenderer The icon renderer.
     */
    protected function assertIconRendererInstance($iconRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer', $iconRenderer);
    }

    /**
     * Asserts an info box renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer $infoBoxRenderer The info box renderer.
     */
    protected function assertInfoBoxRendererInstance($infoBoxRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer', $infoBoxRenderer);
    }

    /**
     * Asserts an info window close renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer $infoWindowCloseRenderer The info window close renderer.
     */
    protected function assertInfoWindowCloseRendererInstance($infoWindowCloseRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer',
            $infoWindowCloseRenderer
        );
    }

    /**
     * Asserts an info window renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer $infoWindowRenderer The info window renderer.
     */
    protected function assertInfoWindowRendererInstance($infoWindowRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer', $infoWindowRenderer);
    }

    /**
     * Asserts a kml layer aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator $kmlLayerAggregator The kml layer aggregator.
     */
    protected function assertKmlLayerAggregatorInstance($kmlLayerAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator', $kmlLayerAggregator);
    }

    /**
     * Asserts a kml layer renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer $kmlLayerRenderer The kml layer renderer.
     */
    protected function assertKmlLayerRendererInstance($kmlLayerRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer', $kmlLayerRenderer);
    }

    /**
     * Asserts a loader renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer $loaderRenderer The loader renderer.
     */
    protected function assertLoaderRendererInstance($loaderRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer', $loaderRenderer);
    }

    /**
     * Asserts a map bound renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer $mapBoundRenderer The map bound renderer.
     */
    protected function assertMapBoundRendererInstance($mapBoundRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer', $mapBoundRenderer);
    }

    /**
     * Asserts a map center renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer $mapCenterRenderer The map center renderer.
     */
    protected function assertMapCenterRendererInstance($mapCenterRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer', $mapCenterRenderer);
    }

    /**
     * Asserts a map container renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer $mapContainerRenderer The map container renderer.
     */
    protected function assertMapContainerRendererInstance($mapContainerRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer', $mapContainerRenderer);
    }

    /**
     * Asserts a map renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapRenderer $mapRenderer The map renderer.
     */
    protected function assertMapRendererInstance($mapRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\MapRenderer', $mapRenderer);
    }

    /**
     * Asserts a marker cluster renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer $markerClusterRenderer The marker cluster renderer.
     */
    protected function assertMarkerClusterRendererInstance($markerClusterRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer',
            $markerClusterRenderer
        );
    }

    /**
     * Asserts a marker renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer $markerRenderer The marker renderer.
     */
    protected function assertMarkerRendererInstance($markerRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer', $markerRenderer);
    }

    /**
     * Asserts a marker shape aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator $markerShapeAggregator The marker shape aggregator.
     */
    protected function assertMarkerShapeAggregatorInstance($markerShapeAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator',
            $markerShapeAggregator
        );
    }

    /**
     * Asserts a marker shape renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer $markerShapeRenderer The marker shape renderer.
     */
    protected function assertMarkerShapeRendererInstance($markerShapeRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer', $markerShapeRenderer);
    }

    /**
     * Asserts a point aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator $pointAggregator The point aggregator.
     */
    protected function assertPointAggregatorInstance($pointAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator', $pointAggregator);
    }

    /**
     * Asserts a point renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer $pointRenderer The point renderer.
     */
    protected function assertPointRendererInstance($pointRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer', $pointRenderer);
    }

    /**
     * Asserts a polygon renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer $polygonRenderer The polygon renderer.
     */
    protected function assertPolygonRendererInstance($polygonRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer', $polygonRenderer);
    }

    /**
     * Asserts a polyline renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer $polylineRenderer The polyline renderer.
     */
    protected function assertPolylineRendererInstance($polylineRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer', $polylineRenderer);
    }

    /**
     * Asserts a rectangle renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer $rectangleRenderer The rectangle renderer.
     */
    protected function assertRectangleRendererInstance($rectangleRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer', $rectangleRenderer);
    }

    /**
     * Asserts a size aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator $sizeAggregator The size aggregator.
     */
    protected function assertSizeAggregatorInstance($sizeAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator', $sizeAggregator);
    }

    /**
     * Asserts a size renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer $sizeRenderer The size renderer.
     */
    protected function assertSizeRendererInstance($sizeRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer', $sizeRenderer);
    }

    /**
     * Creates an api event mock.
     *
     * @return \Ivory\GoogleMap\Helpers\ApiEvent|\PHPUnit_Framework_MockObject_MockObject The api event mock.
     */
    protected function createApiEventMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\ApiEvent')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a formatter subscriber mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber|\PHPUnit_Framework_MockObject_MockObject The formatter subscriber mock.
     */
    protected function createFormatterSubscriberMock()
    {
        return $this->createFormatterSubscriberMockBuilder()->getMockForAbstractClass();
    }

    /**
     * Creates a formatter subscriber mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The formatter subscriber mock builder.
     */
    protected function createFormatterSubscriberMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber');
    }

    /**
     * Creates a map event mock.
     *
     * @return \Ivory\GoogleMap\Helpers\MapEvent|\PHPUnit_Framework_MockObject_MockObject The map event mock.
     */
    protected function createMapEventMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\MapEvent')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an autocomplete event mock.
     *
     * @return \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent|\PHPUnit_Framework_MockObject_MockObject The autocomplete event mock.
     */
    protected function createPlacesAutocompleteEventMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
