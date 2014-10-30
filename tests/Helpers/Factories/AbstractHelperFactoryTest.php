<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Factories;

use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Helper factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelperFactoryTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Factories\HelperFactoryInterface */
    protected $helperFactory;

    /** @var array */
    private $apiFormatterSubscribers;

    /** @var array */
    private $mapFormatterSubscribers;

    /** @var array */
    private $placesAutocompleteFormatterSubscribers;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helperFactory = $this->createHelperFactory();
        $this->apiFormatterSubscribers = array(
            ApiEvents::JAVASCRIPT,
            ApiEvents::JAVASCRIPT_MAP,
            ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE,
            ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW,
            ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER,
            ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE,
        );

        $this->mapFormatterSubscribers = array(
            MapEvents::JAVASCRIPT_BASE_BOUND,
            MapEvents::JAVASCRIPT_BASE_COORDINATE,
            MapEvents::JAVASCRIPT_BASE_POINT,
            MapEvents::JAVASCRIPT_BASE_SIZE,
            MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT,
            MapEvents::JAVASCRIPT_EVENTS_DOM_EVENT_ONCE,
            MapEvents::JAVASCRIPT_EVENTS_EVENT,
            MapEvents::JAVASCRIPT_EVENTS_EVENT_ONCE,
            MapEvents::JAVASCRIPT_LAYERS_KML_LAYER,
            MapEvents::JAVASCRIPT_FINISH_MAP_BOUND,
            MapEvents::JAVASCRIPT_FINISH_MAP_CENTER,
            MapEvents::JAVASCRIPT_INIT_CONTAINER,
            MapEvents::HTML,
            MapEvents::JAVASCRIPT,
            MapEvents::STYLESHEET,
            MapEvents::JAVASCRIPT_MAP,
            MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE,
            MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE,
            MapEvents::JAVASCRIPT_FINISH_EXTENDABLE,
            MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY,
            MapEvents::JAVASCRIPT_OVERLAYS_ICON,
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE,
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN,
            MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW,
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER,
            MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT,
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE,
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER,
            MapEvents::JAVASCRIPT_OVERLAYS_POLYGON,
            MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE,
            MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE,
        );

        $this->placesAutocompleteFormatterSubscribers = array(
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND,
            PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER,
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE,
            PlacesAutocompleteEvents::HTML,
            PlacesAutocompleteEvents::JAVASCRIPT,
            PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE,
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->helperFactory);
    }

    /**
     * Creates the helper factory.
     *
     * @return \Ivory\GoogleMap\Helpers\Factories\HelperFactoryInterface The helper factory.
     */
    abstract protected function createHelperFactory();

    public function testCreateApiHelper()
    {
        $this->assertApiHelperInstance($apiHelper = $this->helperFactory->createApiHelper());
        $this->assertEventDispatcherInstance($eventDispatcher = $apiHelper->getEventDispatcher());
        $this->assertTrue($eventDispatcher->hasListeners());
    }

    public function testCreateMapHelper()
    {
        $this->assertMapHelperInstance($mapHelper = $this->helperFactory->createMapHelper());
        $this->assertEventDispatcherInstance($eventDispatcher = $mapHelper->getEventDispatcher());
        $this->assertTrue($eventDispatcher->hasListeners());
    }

    public function testCreatePlacesAutocompleteHelper()
    {
        $this->assertAutocompleteHelperInstance(
            $autocompleteHelper = $this->helperFactory->createPlacesAutocompleteHelper()
        );

        $this->assertEventDispatcherInstance($eventDispatcher = $autocompleteHelper->getEventDispatcher());
        $this->assertTrue($eventDispatcher->hasListeners());
    }

    public function testSetDebug()
    {
        $this->helperFactory->setDebug(true);

        $this->assertTrue($this->helperFactory->isDebug());

        foreach ($this->getFormatters() as $formatter) {
            $this->assertTrue($formatter->isDebug());
        }
    }

    public function testSetIndentation()
    {
        $this->helperFactory->setIndentation($indentation = 2);

        $this->assertSame($indentation, $this->helperFactory->getIndentation());

        foreach ($this->getFormatters() as $formatter) {
            $this->assertSame($indentation, $formatter->getIndentation());
        }
    }

    public function testEventDispatcherInstances()
    {
        $apiHelper = $this->helperFactory->createApiHelper();
        $mapHelper = $this->helperFactory->createMapHelper();
        $placesAutocompleteHelper = $this->helperFactory->createPlacesAutocompleteHelper();

        $this->assertNotSame($apiHelper->getEventDispatcher(), $mapHelper->getEventDispatcher());
        $this->assertNotSame($apiHelper->getEventDispatcher(), $placesAutocompleteHelper->getEventDispatcher());
        $this->assertNotSame($mapHelper->getEventDispatcher(), $placesAutocompleteHelper->getEventDispatcher());
    }

    public function testFormatterUnicity()
    {
        $formatters = $this->getFormatters();
        $formattersCount = count($formatters);

        for ($i = 1; $i < $formattersCount; $i++) {
            $this->assertFormatterInstance($formatters[$i - 1]);
            $this->assertFormatterInstance($formatters[$i]);
            $this->assertSame($formatters[$i - 1], $formatters[$i]);
        }
    }

    public function testJsonBuilderUnicity()
    {
        $jsonBuilders = $this->getJsonBuilders();
        $jsonBuildersCount = count($jsonBuilders);

        for ($i = 1; $i < $jsonBuildersCount; $i++) {
            $this->assertJsonBuilderInstance($jsonBuilders[$i - 1]);
            $this->assertJsonBuilderInstance($jsonBuilders[$i]);
            $this->assertSame($jsonBuilders[$i - 1], $jsonBuilders[$i]);
        }
    }

    public function testBoundAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $boundSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_BOUND);
        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);

        $boundAggregators = array(
            $boundSubscribers[0][0]->getBoundAggregator(),
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getBoundAggregator(),
        );

        $boundAggregatorsCount = count($boundAggregators);

        for ($i = 1; $i < $boundAggregatorsCount; $i++) {
            $this->assertBoundAggregatorInstance($boundAggregators[$i - 1]);
            $this->assertBoundAggregatorInstance($boundAggregators[$i]);
            $this->assertSame($boundAggregators[$i - 1], $boundAggregators[$i]);
        }
    }

    public function testGroundOverlayAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $boundSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_BOUND);

        $groundOverlaySubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY
        );

        $groundOverlayAggregators = array(
            $boundSubscribers[0][0]->getBoundAggregator()->getGroundOverlayAggregator(),
            $groundOverlaySubscribers[0][0]->getGroundOverlayAggregator(),
        );

        $groundOverlayAggregatorsCount = count($groundOverlayAggregators);

        for ($i = 1; $i < $groundOverlayAggregatorsCount; $i++) {
            $this->assertGroundOverlayAggregatorInstance($groundOverlayAggregators[$i - 1]);
            $this->assertGroundOverlayAggregatorInstance($groundOverlayAggregators[$i]);
            $this->assertSame($groundOverlayAggregators[$i - 1], $groundOverlayAggregators[$i]);
        }
    }

    public function testRectangleAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $boundSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_BOUND);

        $rectangleSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE
        );

        $rectangleAggregators = array(
            $boundSubscribers[0][0]->getBoundAggregator()->getRectangleAggregator(),
            $rectangleSubscribers[0][0]->getRectangleAggregator(),
        );

        $rectangleAggregatorsCount = count($rectangleAggregators);

        for ($i = 1; $i < $rectangleAggregatorsCount; $i++) {
            $this->assertRectangleAggregatorInstance($rectangleAggregators[$i - 1]);
            $this->assertRectangleAggregatorInstance($rectangleAggregators[$i]);
            $this->assertSame($rectangleAggregators[$i - 1], $rectangleAggregators[$i]);
        }
    }

    public function testCircleAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $circleSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE);

        $circleAggregators = array(
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getCircleAggregator(),
            $circleSubscribers[0][0]->getCircleAggregator(),
        );

        $circleAggregatorsCount = count($circleAggregators);

        for ($i = 1; $i < $circleAggregatorsCount; $i++) {
            $this->assertCircleAggregatorInstance($circleAggregators[$i - 1]);
            $this->assertCircleAggregatorInstance($circleAggregators[$i]);
            $this->assertSame($circleAggregators[$i - 1], $circleAggregators[$i]);
        }
    }

    public function testInfoWindowAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $sizeSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_SIZE);

        $infoWindowCloseSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE
        );

        $infoWindowOpenSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN
        );

        $infoWindowSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW
        );

        $infoWindowAggregators = array(
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getInfoWindowAggregator(),
            $sizeSubscribers[0][0]->getSizeAggregator()->getInfoWindowAggregator(),
            $infoWindowCloseSubscribers[0][0]->getInfoWindowAggregator(),
            $infoWindowOpenSubscribers[0][0]->getInfoWindowAggregator(),
            $infoWindowSubscribers[0][0]->getInfoWindowAggregator(),
        );

        $infoWindowAggregatorsCount = count($infoWindowAggregators);

        for ($i = 1; $i < $infoWindowAggregatorsCount; $i++) {
            $this->assertInfoWindowAggregatorInstance($infoWindowAggregators[$i - 1]);
            $this->assertInfoWindowAggregatorInstance($infoWindowAggregators[$i]);
            $this->assertSame($infoWindowAggregators[$i - 1], $infoWindowAggregators[$i]);
        }
    }

    public function testMarkerAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $pointSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_POINT);

        $markerOpenEventSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT
        );

        $markerSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_MARKER);

        $markerShapeSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE
        );

        $markerAggregators = array(
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getMarkerAggregator(),
            $pointSubscribers[0][0]->getPointAggregator()->getMarkerAggregator(),
            $markerOpenEventSubscribers[0][0]->getMarkerAggregator(),
            $markerSubscribers[0][0]->getMarkerAggregator(),
            $markerShapeSubscribers[0][0]->getMarkerShapeAggregator()->getMarkerAggregator(),
        );

        $markerAggregatorsCount = count($markerAggregators);

        for ($i = 1; $i < $markerAggregatorsCount; $i++) {
            $this->assertMarkerAggregatorInstance($markerAggregators[$i - 1]);
            $this->assertMarkerAggregatorInstance($markerAggregators[$i]);
            $this->assertSame($markerAggregators[$i - 1], $markerAggregators[$i]);
        }
    }

    public function testPolygonAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $polygonSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON);

        $polygonAggregators = array(
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getPolygonAggregator(),
            $polygonSubscribers[0][0]->getPolygonAggregator(),
        );

        $polygonAggregatorsCount = count($polygonAggregators);

        for ($i = 1; $i < $polygonAggregatorsCount; $i++) {
            $this->assertPolygonAggregatorInstance($polygonAggregators[$i - 1]);
            $this->assertPolygonAggregatorInstance($polygonAggregators[$i]);
            $this->assertSame($polygonAggregators[$i - 1], $polygonAggregators[$i]);
        }
    }

    public function testPolylineAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $coordinateSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_COORDINATE);
        $polylineSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE);

        $polylineAggregators = array(
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getPolylineAggregator(),
            $polylineSubscribers[0][0]->getPolylineAggregator(),
        );

        $polylineAggregatorsCount = count($polylineAggregators);

        for ($i = 1; $i < $polylineAggregatorsCount; $i++) {
            $this->assertPolylineAggregatorInstance($polylineAggregators[$i - 1]);
            $this->assertPolylineAggregatorInstance($polylineAggregators[$i]);
            $this->assertSame($polylineAggregators[$i - 1], $polylineAggregators[$i]);
        }
    }

    public function testIconAggregatorUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $sizeSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_BASE_SIZE);
        $iconSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_ICON);

        $iconAggregators = array(
            $sizeSubscribers[0][0]->getSizeAggregator()->getIconAggregator(),
            $iconSubscribers[0][0]->getIconAggregator(),
        );

        $iconAggregatorsCount = count($iconAggregators);

        for ($i = 1; $i < $iconAggregatorsCount; $i++) {
            $this->assertIconAggregatorInstance($iconAggregators[$i - 1]);
            $this->assertIconAggregatorInstance($iconAggregators[$i]);
            $this->assertSame($iconAggregators[$i - 1], $iconAggregators[$i]);
        }
    }

    public function testAutocompleteBoundAggregatorUnicity()
    {
        $autocompleteHelper = $this->helperFactory->createPlacesAutocompleteHelper();

        $boundSubscribers = $autocompleteHelper->getEventDispatcher()->getListeners(
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND
        );

        $coordinateSubscribers = $autocompleteHelper->getEventDispatcher()->getListeners(
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE
        );

        $boundAggregators = array(
            $boundSubscribers[0][0]->getBoundAggregator(),
            $coordinateSubscribers[0][0]->getCoordinateAggregator()->getBoundAggregator(),
        );

        $boundAggregatorsCount = count($boundAggregators);

        for ($i = 1; $i < $boundAggregatorsCount; $i++) {
            $this->assertAutocompleteBoundAggregatorInstance($boundAggregators[$i - 1]);
            $this->assertAutocompleteBoundAggregatorInstance($boundAggregators[$i]);
            $this->assertSame($boundAggregators[$i - 1], $boundAggregators[$i]);
        }
    }

    public function testInfoWindowOpenRendererUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $infoWindowOpenSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN
        );

        $markerOpenEventSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_INIT_MARKER_OPEN_EVENT
        );

        $infoWindowOpenRenderers = array(
            $infoWindowOpenSubscribers[0][0]->getInfoWindowOpenRenderer(),
            $markerOpenEventSubscribers[0][0]->getInfoWindowOpenRenderer(),
        );

        $infoWindowOpenRenderersCount = count($infoWindowOpenRenderers);

        for ($i = 1; $i < $infoWindowOpenRenderersCount; $i++) {
            $this->assertInfoWindowOpenRendererInstance($infoWindowOpenRenderers[$i - 1]);
            $this->assertInfoWindowOpenRendererInstance($infoWindowOpenRenderers[$i]);
            $this->assertSame($infoWindowOpenRenderers[$i - 1], $infoWindowOpenRenderers[$i]);
        }
    }

    public function testMapTypeIdRendererUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $mapSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_MAP);
        $controlsRenderer = $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer();

        $mapTypeIdRenderers = array(
            $mapSubscribers[0][0]->getMapRenderer()->getMapTypeIdRenderer(),
            $controlsRenderer->getMapTypeControlRenderer()->getMapTypeIdRenderer(),
        );

        $mapTypeIdRenderersCount = count($mapTypeIdRenderers);

        for ($i = 1; $i < $mapTypeIdRenderersCount; $i++) {
            $this->assertMapTypeIdRendererInstance($mapTypeIdRenderers[$i - 1]);
            $this->assertMapTypeIdRendererInstance($mapTypeIdRenderers[$i]);
            $this->assertSame($mapTypeIdRenderers[$i - 1], $mapTypeIdRenderers[$i]);
        }
    }

    public function testControlPositionRendererUnicity()
    {
        $mapHelper = $this->helperFactory->createMapHelper();

        $mapSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_MAP);
        $controlsRenderer = $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer();

        $controlPositionRenderers = array(
            $controlsRenderer->getMapTypeControlRenderer()->getControlPositionRenderer(),
            $controlsRenderer->getPanControlRenderer()->getControlPositionRenderer(),
            $controlsRenderer->getRotateControlRenderer()->getControlPositionRenderer(),
            $controlsRenderer->getStreetViewControlRenderer()->getControlPositionRenderer(),
            $controlsRenderer->getZoomControlRenderer()->getControlPositionRenderer(),
        );

        $controlPositionRenderersCount = count($controlPositionRenderers);

        for ($i = 1; $i < $controlPositionRenderersCount; $i++) {
            $this->assertControlPositionRendererInstance($controlPositionRenderers[$i - 1]);
            $this->assertControlPositionRendererInstance($controlPositionRenderers[$i]);
            $this->assertSame($controlPositionRenderers[$i - 1], $controlPositionRenderers[$i]);
        }
    }

    /**
     * Gets the formatters.
     *
     * @return array The formatters.
     */
    protected function getFormatters()
    {
        $formatterSubscribers = array();

        foreach ($this->apiFormatterSubscribers as $apiFormatterSubscribers) {
            $formatterSubscribers = array_merge(
                $formatterSubscribers,
                $this->helperFactory->createApiHelper()->getEventDispatcher()->getListeners($apiFormatterSubscribers)
            );
        }

        foreach ($this->mapFormatterSubscribers as $mapFormatterSubscribers) {
            $formatterSubscribers = array_merge(
                $formatterSubscribers,
                $this->helperFactory->createMapHelper()->getEventDispatcher()->getListeners($mapFormatterSubscribers)
            );
        }

        foreach ($this->placesAutocompleteFormatterSubscribers as $placesAutocompleteFormatterSubscribers) {
            $formatterSubscribers = array_merge(
                $formatterSubscribers,
                $this->helperFactory->createPlacesAutocompleteHelper()->getEventDispatcher()->getListeners(
                    $placesAutocompleteFormatterSubscribers
                )
            );
        }

        $formatters = array();

        foreach ($formatterSubscribers as $formatterSubscriber) {
            $formatters[] = $formatterSubscriber[0]->getFormatter();
        }

        return $formatters;
    }

    /**
     * Gets the json builders.
     *
     * @return array The json builders.
     */
    protected function getJsonBuilders()
    {
        $apiHelper = $this->helperFactory->createApiHelper();
        $mapHelper = $this->helperFactory->createMapHelper();

        $javascriptSubscribers = $apiHelper->getEventDispatcher()->getListeners(ApiEvents::JAVASCRIPT);

        $mapEncodedPolylineSubscribers = $apiHelper->getEventDispatcher()->getListeners(
            ApiEvents::JAVASCRIPT_MAP_ENCODED_POLYLINE
        );

        $mapInfoWindowSubscribers = $apiHelper->getEventDispatcher()->getListeners(
            ApiEvents::JAVASCRIPT_MAP_INFO_WINDOW
        );

        $mapMarkerClusterSubscribers = $apiHelper->getEventDispatcher()->getListeners(
            ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER
        );

        $containerSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_INIT_CONTAINER);
        $kmlLayerSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_LAYERS_KML_LAYER);
        $mapSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_MAP);
        $circleSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_CIRCLE);

        $encodedPolylineSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_ENCODED_POLYLINE
        );

        $groundOverlaySubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_GROUND_OVERLAY
        );

        $iconSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_ICON);

        $infoWindowSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_INFO_WINDOW
        );

        $markerSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_MARKER);

        $markerClusterSubscribers =  $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER
        );

        $markerShapeSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_SHAPE
        );

        $polygonSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_POLYGON);
        $polylineSubscribers = $mapHelper->getEventDispatcher()->getListeners(MapEvents::JAVASCRIPT_OVERLAYS_POLYLINE);

        $rectangleSubscribers = $mapHelper->getEventDispatcher()->getListeners(
            MapEvents::JAVASCRIPT_OVERLAYS_RECTANGLE
        );

        $jsonBuilderRenderers = array(
            $javascriptSubscribers[0][0]->getLoaderRenderer(),
            $mapEncodedPolylineSubscribers[0][0]->getEncodedPolylineRenderer(),
            $mapInfoWindowSubscribers[0][0]->getInfoWindowRenderer(),
            $mapInfoWindowSubscribers[0][0]->getInfoBoxRenderer(),
            $mapMarkerClusterSubscribers[0][0]->getMarkerClusterRenderer(),
            $containerSubscribers[0][0]->getContainerRenderer(),
            $kmlLayerSubscribers[0][0]->getKmlLayerRenderer(),
            $mapSubscribers[0][0]->getMapRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getMapTypeControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getOverviewMapControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getPanControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getRotateControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getScaleControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getStreetViewControlRenderer(),
            $mapSubscribers[0][0]->getMapRenderer()->getControlsRenderer()->getZoomControlRenderer(),
            $circleSubscribers[0][0]->getCircleRenderer(),
            $encodedPolylineSubscribers[0][0]->getEncodedPolylineRenderer(),
            $groundOverlaySubscribers[0][0]->getGroundOverlayRenderer(),
            $iconSubscribers[0][0]->getIconRenderer(),
            $infoWindowSubscribers[0][0]->getInfoWindowRenderer(),
            $infoWindowSubscribers[0][0]->getInfoBoxRenderer(),
            $markerSubscribers[0][0]->getMarkerRenderer(),
            $markerClusterSubscribers[0][0]->getMarkerClusterRenderer(),
            $markerShapeSubscribers[0][0]->getMarkerShapeRenderer(),
            $polygonSubscribers[0][0]->getPolygonRenderer(),
            $polylineSubscribers[0][0]->getPolylineRenderer(),
            $rectangleSubscribers[0][0]->getRectangleRenderer(),
        );

        $jsonBuilders = array();

        foreach ($jsonBuilderRenderers as $jsonBuilderRenderer) {
            $jsonBuilders[] = $jsonBuilderRenderer->getJsonBuilder();
        }

        return $jsonBuilders;
    }
}
