<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Helpers test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts an api helper instance.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiHelper $apiHelper The api helper.
     */
    protected function assertApiHelperInstance($apiHelper)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\ApiHelper', $apiHelper);
    }

    /**
     * Asserts an autocomplete bound aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator $boundAggregator The bound aggregator.
     */
    protected function assertAutocompleteBoundAggregatorInstance($boundAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator',
            $boundAggregator
        );
    }

    /**
     * Asserts an autocomplete helper instance.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper $autocompleteHelper The autocomplete helper.
     */
    protected function assertAutocompleteHelperInstance($autocompleteHelper)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper', $autocompleteHelper);
    }

    /**
     * Asserts a bound aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator $boundAggregator The bound aggregator.
     */
    protected function assertBoundAggregatorInstance($boundAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator', $boundAggregator);
    }

    /**
     * Asserts a circle aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator $circleAggregator The circle aggregator.
     */
    protected function assertCircleAggregatorInstance($circleAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator', $circleAggregator);
    }

    /**
     * Asserts a control position renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer $controlPositionRenderer The control position renderer.
     */
    protected function assertControlPositionRendererInstance($controlPositionRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer',
            $controlPositionRenderer
        );
    }

    /**
     * Asserts an event dispatcher instance.
     *
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher The event dispatcher.
     */
    protected function assertEventDispatcherInstance($eventDispatcher)
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventDispatcherInterface', $eventDispatcher);
    }

    /**
     * Asserts a formatter instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter $formatter The formatter.
     */
    protected function assertFormatterInstance($formatter)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Subscribers\Formatter', $formatter);
    }

    /**
     * Asserts a ground overlay aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator $groundOverlayAggregator The ground overlay aggregator.
     */
    protected function assertGroundOverlayAggregatorInstance($groundOverlayAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator',
            $groundOverlayAggregator
        );
    }

    /**
     * Asserts an helper event instance.
     *
     * @param \Ivory\GoogleMap\Helpers\AbstractEvent $event The helper event.
     */
    protected function assertHelperEventInstance($event)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\AbstractEvent', $event);
    }

    /**
     * Asserts an helper instance.
     *
     * @param \Ivory\GoogleMap\Helpers\AbstractHelper $helper The helper.
     */
    protected function assertHelperInstance($helper)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\AbstractHelper', $helper);
    }

    /**
     * Asserts an icon aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator $iconAggregator The icon aggregator.
     */
    protected function assertIconAggregatorInstance($iconAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator', $iconAggregator);
    }

    /**
     * Asserts an info window aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator $infoWindowAggregator The info window aggregator.
     */
    protected function assertInfoWindowAggregatorInstance($infoWindowAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator',
            $infoWindowAggregator
        );
    }

    /**
     * Asserts an info window open renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer $infoWindowOpenRenderer The info window open renderer.
     */
    protected function assertInfoWindowOpenRendererInstance($infoWindowOpenRenderer)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer',
            $infoWindowOpenRenderer
        );
    }

    /**
     * Asserts a json builder instance.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    protected function assertJsonBuilderInstance($jsonBuilder)
    {
        $this->assertInstanceOf('Ivory\JsonBuilder\JsonBuilder', $jsonBuilder);
    }

    /**
     * Asserts a map helper instance.
     *
     * @param \Ivory\GoogleMap\Helpers\MapHelper $mapHelper The map helper.
     */
    protected function assertMapHelperInstance($mapHelper)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\MapHelper', $mapHelper);
    }

    /**
     * Asserts a map type id renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer $mapTypeIdRenderer The map type id renderer.
     */
    protected function assertMapTypeIdRendererInstance($mapTypeIdRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer', $mapTypeIdRenderer);
    }

    /**
     * Asserts a marker aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator $markerAggregator The marker aggregator.
     */
    protected function assertMarkerAggregatorInstance($markerAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator', $markerAggregator);
    }

    /**
     * Asserts a polygon aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator $polygonAggregator The polygon aggregatir.
     */
    protected function assertPolygonAggregatorInstance($polygonAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator', $polygonAggregator);
    }

    /**
     * Asserts a polyline aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator $polylineAggregator The polyline aggregator.
     */
    protected function assertPolylineAggregatorInstance($polylineAggregator)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator', $polylineAggregator);
    }

    /**
     * Asserts a rectangle aggregator instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator $rectangleAggregator The rectangle aggregator.
     */
    protected function assertRectangleAggregatorInstance($rectangleAggregator)
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator',
            $rectangleAggregator
        );
    }

    /**
     * Asserts a symfony dependency injection compiler pass instance.
     *
     * @param \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface $compilerPass The symfony dependency injection compiler pass.
     */
    protected function assertSymfonyCompilerPassInstance($compilerPass)
    {
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface', $compilerPass);
    }

    /**
     * Asserts a symfony event instance.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event The symfony event.
     */
    protected function assertSymfonyEventInstance($event)
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $event);
    }

    /**
     * Asserts a symfony dependency injection extension instance.
     *
     * @param \Symfony\Component\DependencyInjection\Extension\ExtensionInterface $extension The symfony dependency injection extension.
     */
    protected function assertSymfonyExtensionInstance($extension)
    {
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Extension\ExtensionInterface', $extension);
    }

    /**
     * Creates an animation renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer|\PHPUnit_Framework_MockObject_MockObject The animation renderer mock.
     */
    protected function createAnimationRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer');
    }

    /**
     * Creates an autocomplete bound aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator|\PHPUnit_Framework_MockObject_MockObject The autocomplete bound aggregator mock.
     */
    protected function createAutocompleteBoundAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator');
    }

    /**
     * Creates an autocomplete container renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer|\PHPUnit_Framework_MockObject_MockObject The autocomplete container renderer mock.
     */
    protected function createAutocompleteContainerRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer');
    }

    /**
     * Creates an autocomplete coordinate aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator|\PHPUnit_Framework_MockObject_MockObject The autocomplete coordinate aggregator mock.
     */
    protected function createAutocompleteCoordinateAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator');
    }

    /**
     * Creates an autocomplete renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer|\PHPUnit_Framework_MockObject_MockObject The autocomplete renderer mock.
     */
    protected function createAutocompleteRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer');
    }

    /**
     * Creates an autocomplete mock.
     *
     * @return \Ivory\GoogleMap\Places\Autocomplete|\PHPUnit_Framework_MockObject_MockObject The autocomplete mock.
     */
    protected function createAutocompleteMock()
    {
        return $this->getMock('Ivory\GoogleMap\Places\Autocomplete');
    }

    /**
     * Creates a bound aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator|\PHPUnit_Framework_MockObject_MockObject The bound aggregator mock.
     */
    protected function createBoundAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator');
    }

    /**
     * Creates a bound renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer|\PHPUnit_Framework_MockObject_MockObject The bound renderer mock.
     */
    protected function createBoundRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer');
    }

    /**
     * Creates a circle aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator|\PHPUnit_Framework_MockObject_MockObject The circle aggregator mock.
     */
    protected function createCircleAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator');
    }

    /**
     * Creates a circle renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer|\PHPUnit_Framework_MockObject_MockObject The circle renderer mock.
     */
    protected function createCircleRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\CircleRenderer');
    }

    /**
     * Creates a controls renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer|\PHPUnit_Framework_MockObject_MockObject The controls renderer mock.
     */
    protected function createControlsRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer');
    }

    /**
     * Creates a control position renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer|\PHPUnit_Framework_MockObject_MockObject The control position renderer mock.
     */
    protected function createControlPositionRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer');
    }

    /**
     * Creates a coordinate aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator|\PHPUnit_Framework_MockObject_MockObject The coordinate aggregator mock.
     */
    protected function createCoordinateAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator');
    }

    /**
     * Creates a coordinate renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer|\PHPUnit_Framework_MockObject_MockObject The coordinate renderer mock.
     */
    protected function createCoordinateRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer');
    }

    /**
     * Creates a dom event aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator|\PHPUnit_Framework_MockObject_MockObject The dom event aggregator mock.
     */
    protected function createDomEventAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator');
    }

    /**
     * Creates a dom event once aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator|\PHPUnit_Framework_MockObject_MockObject The dom event once aggregator mock.
     */
    protected function createDomEventOnceAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator');
    }

    /**
     * Creates a dom event once renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer|\PHPUnit_Framework_MockObject_MockObject The dom event once renderer mock.
     */
    protected function createDomEventOnceRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Events\DomEventOnceRenderer');
    }

    /**
     * Creates a dom event renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer|\PHPUnit_Framework_MockObject_MockObject The dom event renderer mock.
     */
    protected function createDomEventRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Events\DomEventRenderer');
    }

    /**
     * Creates an encoded polyline aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator|\PHPUnit_Framework_MockObject_MockObject The encoded polyline aggregator mock.
     */
    protected function createEncodedPolylineAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator');
    }

    /**
     * Creates an encoded polyline renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer|\PHPUnit_Framework_MockObject_MockObject The encoded polyline renderer mock.
     */
    protected function createEncodedPolylineRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\EncodedPolylineRenderer');
    }

    /**
     * Creates an encoding renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer|\PHPUnit_Framework_MockObject_MockObject The encoding renderer mock.
     */
    protected function createEncodingRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer');
    }

    /**
     * Creates an event aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator|\PHPUnit_Framework_MockObject_MockObject The event aggregator mock.
     */
    protected function createEventAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator');
    }

    /**
     * Creates an event once aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator|\PHPUnit_Framework_MockObject_MockObject The event once aggregator mock.
     */
    protected function createEventOnceAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator');
    }

    /**
     * Creates an event once renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer|\PHPUnit_Framework_MockObject_MockObject The event once renderer mock.
     */
    protected function createEventOnceRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Events\EventOnceRenderer');
    }

    /**
     * Creates an event renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer|\PHPUnit_Framework_MockObject_MockObject The event renderer mock.
     */
    protected function createEventRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Events\EventRenderer');
    }

    /**
     * Creates an extendable aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator|\PHPUnit_Framework_MockObject_MockObject The extendable aggregator mock.
     */
    protected function createExtendableAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\ExtendableAggregator');
    }

    /**
     * Creates an extendable renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer|\PHPUnit_Framework_MockObject_MockObject The extendable renderer mock.
     */
    protected function createExtendableRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\ExtendableRenderer');
    }

    /**
     * Creates a formatter mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Subscribers\Formatter|\PHPUnit_Framework_MockObject_MockObject The formatter mock.
     */
    protected function createFormatterMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Subscribers\Formatter');
    }

    /**
     * Creates a ground overlay aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator|\PHPUnit_Framework_MockObject_MockObject The ground overlay aggregator mock.
     */
    protected function createGroundOverlayAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator');
    }

    /**
     * Creates a ground overlay renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer|\PHPUnit_Framework_MockObject_MockObject The ground overlay renderer mock.
     */
    protected function createGroundOverlayRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\GroundOverlayRenderer');
    }

    /**
     * Creates an helper event mock.
     *
     * @return \Ivory\GoogleMap\Helpers\AbstractEvent|\PHPUnit_Framework_MockObject_MockObject The helper event mock.
     */
    protected function createHelperEventMock()
    {
        return $this->getMockForAbstractClass('Ivory\GoogleMap\Helpers\AbstractEvent');
    }

    /**
     * Creates an helper mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The helper mock builder.
     */
    protected function createHelperMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Helpers\AbstractHelper');
    }

    /**
     * Creates an icon aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator|\PHPUnit_Framework_MockObject_MockObject The icon aggregator mock.
     */
    protected function createIconAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator');
    }

    /**
     * Creates an icon renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer|\PHPUnit_Framework_MockObject_MockObject The icon renderer mock.
     */
    protected function createIconRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer');
    }

    /**
     * Creates an info box renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer|\PHPUnit_Framework_MockObject_MockObject The info box render mock.
     */
    protected function createInfoBoxRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoBoxRenderer');
    }

    /**
     * Creates an info window aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject The info window aggregator mock.
     */
    protected function createInfoWindowAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator');
    }

    /**
     * Creates an info window close renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer|\PHPUnit_Framework_MockObject_MockObject The info window close renderer mock.
     */
    protected function createInfoWindowCloseRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer');
    }

    /**
     * Creates an info window open renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer|\PHPUnit_Framework_MockObject_MockObject The info window open renderer mock.
     */
    protected function createInfoWindowOpenRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer');
    }

    /**
     * Creates an info window renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer|\PHPUnit_Framework_MockObject_MockObject The info window render mock.
     */
    protected function createInfoWindowRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowRenderer');
    }

    /**
     * Creates a json builder mock.
     *
     * @return \Ivory\JsonBuilder\JsonBuilder|\PHPUnit_Framework_MockObject_MockObject The json renderer mock.
     */
    protected function createJsonBuilderMock()
    {
        return $this->getMock('Ivory\JsonBuilder\JsonBuilder');
    }

    /**
     * Creates a kml layer aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator|\PHPUnit_Framework_MockObject_MockObject The kml layer aggregator mock.
     */
    protected function createKmlLayerAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator');
    }

    /**
     * Creates a kml layer renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer|\PHPUnit_Framework_MockObject_MockObject The kml layer renderer mock.
     */
    protected function createKmlLayerRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer');
    }

    /**
     * Creates a loader renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer|\PHPUnit_Framework_MockObject_MockObject The loader renderer mock.
     */
    protected function createLoaderRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer');
    }

    /**
     * Creates a map bound renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer|\PHPUnit_Framework_MockObject_MockObject The map bound renderer mock.
     */
    protected function createMapBoundRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer');
    }

    /**
     * Creates a map center renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer|\PHPUnit_Framework_MockObject_MockObject The map center renderer mock.
     */
    protected function createMapCenterRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer');
    }

    /**
     * Creates a map container renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer|\PHPUnit_Framework_MockObject_MockObject The map container renderer mock.
     */
    protected function createMapContainerRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer');
    }

    /**
     * Creates a map mock.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock()
    {
        return $this->getMock('Ivory\GoogleMap\Map');
    }

    /**
     * Creates a map renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapRenderer|\PHPUnit_Framework_MockObject_MockObject The map renderer mock.
     */
    protected function createMapRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\MapRenderer');
    }

    /**
     * Creates a map type control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer|\PHPUnit_Framework_MockObject_MockObject The map type control renderer mock.
     */
    protected function createMapTypeControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer');
    }

    /**
     * Creates a map type control style renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer|\PHPUnit_Framework_MockObject_MockObject The map type control style renderer mock.
     */
    protected function createMapTypeControlStyleRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer');
    }

    /**
     * Creates a map type id renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer|\PHPUnit_Framework_MockObject_MockObject The map type id renderer mock.
     */
    protected function createMapTypeIdRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer');
    }

    /**
     * Creates a marker aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject The marker aggregator mock.
     */
    protected function createMarkerAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator');
    }

    /**
     * Creates a marker cluster renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer|\PHPUnit_Framework_MockObject_MockObject The marker cluster renderer mock.
     */
    protected function createMarkerClusterRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer');
    }

    /**
     * Creates a marker renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer|\PHPUnit_Framework_MockObject_MockObject The marker renderer mock.
     */
    protected function createMarkerRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerRenderer');
    }

    /**
     * Creates a marker shape aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator|\PHPUnit_Framework_MockObject_MockObject The marker shape aggregator mock.
     */
    protected function createMarkerShapeAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator');
    }

    /**
     * Creates a marker shape renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer|\PHPUnit_Framework_MockObject_MockObject The marker shape renderer mock.
     */
    protected function createMarkerShapeRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerShapeRenderer');
    }

    /**
     * Creates an overview map control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer|\PHPUnit_Framework_MockObject_MockObject The overview map control renderer mock.
     */
    protected function createOverviewMapControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer');
    }

    /**
     * Creates a pan control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer|\PHPUnit_Framework_MockObject_MockObject The pan control renderer mock.
     */
    protected function createPanControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer');
    }

    /**
     * Creates a point aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator|\PHPUnit_Framework_MockObject_MockObject The point aggregator mock.
     */
    protected function createPointAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator');
    }

    /**
     * Creates a point renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer|\PHPUnit_Framework_MockObject_MockObject The point renderer mock.
     */
    protected function createPointRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Base\PointRenderer');
    }

    /**
     * Creates a polygon aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator|\PHPUnit_Framework_MockObject_MockObject The polygon aggregator mock.
     */
    protected function createPolygonAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator');
    }

    /**
     * Creates a polygon renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer|\PHPUnit_Framework_MockObject_MockObject The polygon renderer mock.
     */
    protected function createPolygonRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\PolygonRenderer');
    }

    /**
     * Creates a polyline aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator|\PHPUnit_Framework_MockObject_MockObject The polyline aggregator mock.
     */
    protected function createPolylineAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator');
    }

    /**
     * Creates a polyline renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer|\PHPUnit_Framework_MockObject_MockObject The polyline renderer mock.
     */
    protected function createPolylineRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\PolylineRenderer');
    }

    /**
     * Creates a rectangle aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator|\PHPUnit_Framework_MockObject_MockObject The rectangle aggregator mock.
     */
    protected function createRectangleAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator');
    }

    /**
     * Creates a rectangle renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer|\PHPUnit_Framework_MockObject_MockObject The rectangle renderer mock.
     */
    protected function createRectangleRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Overlays\RectangleRenderer');
    }

    /**
     * Creates a rotate control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer|\PHPUnit_Framework_MockObject_MockObject The rotate control renderer mock.
     */
    protected function createRotateControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer');
    }

    /**
     * Creates a scale control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer|\PHPUnit_Framework_MockObject_MockObject The scale control renderer mock.
     */
    protected function createScaleControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer');
    }

    /**
     * Creates a scale control style renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer|\PHPUnit_Framework_MockObject_MockObject The scale control style renderer mock.
     */
    protected function createScaleControlStyleRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer');
    }

    /**
     * Creates a size aggregator mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator|\PHPUnit_Framework_MockObject_MockObject The size aggregator mock.
     */
    protected function createSizeAggregatorMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Aggregators\Base\SizeAggregator');
    }

    /**
     * Creates a size renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer|\PHPUnit_Framework_MockObject_MockObject The size renderer mock.
     */
    protected function createSizeRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Base\SizeRenderer');
    }

    /**
     * Creates a street view control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer|\PHPUnit_Framework_MockObject_MockObject The street view control renderer mock.
     */
    protected function createStreetViewControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer');
    }

    /**
     * Creates a symfony compiler pass mock.
     *
     * @return \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface|\PHPUnit_Framework_MockObject_MockObject The symfony compiler pass mock.
     */
    protected function createSymfonyCompilerPassMock()
    {
        return $this->getMock('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    /**
     * Creates a symfony dependency injection extension mock.
     *
     * @return \Symfony\Component\DependencyInjection\Extension\ExtensionInterface|\PHPUnit_Framework_MockObject_MockObject The symfony dependency injection extension mock.
     */
    protected function createSymfonyExtensionMock()
    {
        return $this->getMock('Symfony\Component\DependencyInjection\Extension\ExtensionInterface');
    }

    /**
     * Creates a symfony event subscriber mock.
     *
     * @return \Symfony\Component\EventDispatcher\EventSubscriberInterface|\PHPUnit_Framework_MockObject_MockObject The symfony event subscriber mock.
     */
    protected function createSymfonyEventSubscriberMock()
    {
        return $this->getMock('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    /**
     * Creates a zoom control renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer|\PHPUnit_Framework_MockObject_MockObject The zoom control renderer mock.
     */
    protected function createZoomControlRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer');
    }

    /**
     * Creates a zoom control style renderer mock.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer|\PHPUnit_Framework_MockObject_MockObject The zoom control style renderer mock.
     */
    protected function createZoomControlStyleRendererMock()
    {
        return $this->getMock('Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer');
    }
}
