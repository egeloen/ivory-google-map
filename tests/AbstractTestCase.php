<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap;

/**
 * Abstract test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Asserts a bound instance.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    protected function assertBoundInstance($bound)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Bound', $bound);
    }

    /**
     * Asserts a controls instance.
     *
     * @param \Ivory\GoogleMap\Controls\Controls $controls The controls.
     */
    protected function assertControlsInstance($controls)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\Controls', $controls);
    }

    /**
     * Asserts a controls renderer instance.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer $controlsRenderer The controls renderer.
     */
    protected function assertControlsRendererInstance($controlsRenderer)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer', $controlsRenderer);
    }

    /**
     * Asserts the coordinate instance.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    protected function assertCoordinateInstance($coordinate)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $coordinate);
    }

    /**
     * Asserts an events instance.
     *
     * @param \Ivory\GoogleMap\Events\Events $events The events.
     */
    protected function assertEventsInstance($events)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Events\Events', $events);
    }

    /**
     * Asserts a layers instance.
     *
     * @param \Ivory\GoogleMap\Layers\Layers $layers The layers.
     */
    protected function assertLayersInstance($layers)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Layers\Layers', $layers);
    }

    /**
     * Asserts an options asset instance.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractOptionsAsset $optionsAsset The options asset.
     */
    protected function assertOptionsAssetInstance($optionsAsset)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Assets\AbstractOptionsAsset', $optionsAsset);
    }

    /**
     * Asserts an overlays instance.
     *
     * @param \Ivory\GoogleMap\Overlays\Overlays $overlays The overlays.
     */
    protected function assertOverlaysInstance($overlays)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Overlays', $overlays);
    }

    /**
     * Asserts a size instance.
     *
     * @param \Ivory\GoogleMap\Base\Size $size The size.
     */
    protected function assertSizeInstance($size)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Size', $size);
    }

    /**
     * Asserts an uninstantiable asset instance.
     *
     * @param string $uninstantiableAsset The uninstantiable asset class.
     */
    protected function assertUninstantiableAssetInstance($uninstantiableAsset)
    {
        $this->assertTrue(is_subclass_of($uninstantiableAsset, 'Ivory\GoogleMap\Assets\AbstractUninstantiableAsset'));
    }

    /**
     * Asserts a variable asset instance.
     *
     * @param \Ivory\GoogleMap\Assets\AbstractVariableAsset $variableAsset The varable asset.
     */
    protected function assertVariableAssetInstance($variableAsset)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Assets\AbstractVariableAsset', $variableAsset);
    }

    /**
     * Creates a bound mock.
     *
     * @return \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject The bound mock.
     */
    protected function createBoundMock()
    {
        return $this->getMock('Ivory\GoogleMap\Base\Bound');
    }

    /**
     * Creates a circle mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Circle|\PHPUnit_Framework_MockObject_MockObject The circle mock.
     */
    protected function createCircleMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Circle')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a controls mock.
     *
     * @return \Ivory\GoogleMap\Controls\Controls|\PHPUnit_Framework_MockObject_MockObject The controls mock.
     */
    protected function createControlsMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\Controls');
    }

    /**
     * Creates a coordinate mock.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject The coordinate mock.
     */
    protected function createCoordinateMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Base\Coordinate')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a dom event mock.
     *
     * @return \Ivory\GoogleMap\Events\DomEvent|\PHPUnit_Framework_MockObject_MockObject The dom event mock.
     */
    protected function createDomEventMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Events\DomEvent')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an encoded polyline mock.
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline|\PHPUnit_Framework_MockObject_MockObject The encoded polyline mock.
     */
    protected function createEncodedPolylineMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\EncodedPolyline')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a symfony event dispatcher mock.
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface|\PHPUnit_Framework_MockObject_MockObject The symfony event dispatcher mock.
     */
    protected function createSymfonyEventDispatcherMock()
    {
        return $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }

    /**
     * Creates an event mock.
     *
     * @return \Ivory\GoogleMap\Events\Event|\PHPUnit_Framework_MockObject_MockObject The event mock.
     */
    protected function createEventMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Events\Event')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an events mock.
     *
     * @return \Ivory\GoogleMap\Events\Events|\PHPUnit_Framework_MockObject_MockObject The events mock.
     */
    protected function createEventsMock()
    {
        return $this->getMock('Ivory\GoogleMap\Events\Events');
    }

    /**
     * Creates an extendable mock.
     *
     * @return \Ivory\GoogleMap\Overlays\ExtendableInterface|\PHPUnit_Framework_MockObject_MockObject The extendable mock.
     */
    protected function createExtendableMock()
    {
        return $this->getMock('Ivory\GoogleMap\Overlays\ExtendableInterface');
    }

    /**
     * Creates a ground overlay mock.
     *
     * @return \Ivory\GoogleMap\Overlays\GroundOverlay|\PHPUnit_Framework_MockObject_MockObject The ground overlay mock.
     */
    protected function createGroundOverlayMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\GroundOverlay')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an icon mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|\PHPUnit_Framework_MockObject_MockObject The icon mock.
     */
    protected function createIconMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Icon')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an info window mock.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\InfoWindow')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a kml layer mock.
     *
     * @return \Ivory\GoogleMap\Layers\KmlLayer|\PHPUnit_Framework_MockObject_MockObject The kml layer mock.
     */
    protected function createKmlLayerMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Layers\KmlLayer')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a layers mock.
     *
     * @return \Ivory\GoogleMap\Layers\Layers|\PHPUnit_Framework_MockObject_MockObject The layers mock.
     */
    protected function createLayersMock()
    {
        return $this->getMock('Ivory\GoogleMap\Layers\Layers');
    }

    /**
     * Creates a map type control mock.
     *
     * @return \Ivory\GoogleMap\Controls\MapTypeControl|\PHPUnit_Framework_MockObject_MockObject The map type control mock.
     */
    protected function createMapTypeControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\MapTypeControl');
    }

    /**
     * Creates a marker cluster mock.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster|\PHPUnit_Framework_MockObject_MockObject The marker cluster mock.
     */
    protected function createMarkerClusterMock()
    {
        return $this->getMock('Ivory\GoogleMap\Overlays\MarkerCluster');
    }

    /**
     * Creates a marker mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Marker')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a marker shape mock.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerShape|\PHPUnit_Framework_MockObject_MockObject The marker shape mock.
     */
    protected function createMarkerShapeMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\MarkerShape')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates an overlays mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock()
    {
        return $this->getMock('Ivory\GoogleMap\Overlays\Overlays');
    }

    /**
     * Creates an overview map control mock.
     *
     * @return \Ivory\GoogleMap\Controls\OverviewMapControl|\PHPUnit_Framework_MockObject_MockObject The overview map control mock.
     */
    protected function createOverviewMapControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl');
    }

    /**
     * Creates a pan control mock.
     *
     * @return \Ivory\GoogleMap\Controls\PanControl|\PHPUnit_Framework_MockObject_MockObject The pan control mock.
     */
    protected function createPanControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\PanControl');
    }

    /**
     * Creates a point mock.
     *
     * @return \Ivory\GoogleMap\Base\Point|\PHPUnit_Framework_MockObject_MockObject The point mock.
     */
    protected function createPointMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Base\Point')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a polygon mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Polygon|\PHPUnit_Framework_MockObject_MockObject The polygon mock.
     */
    protected function createPolygonMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Polygon')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a polyline mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Polyline|\PHPUnit_Framework_MockObject_MockObject The polyline mock.
     */
    protected function createPolylineMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Polyline')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a rectangle mock.
     *
     * @return \Ivory\GoogleMap\Overlays\Rectangle|\PHPUnit_Framework_MockObject_MockObject The rectangle mock.
     */
    protected function createRectangleMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Overlays\Rectangle')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a rotate control mock.
     *
     * @return \Ivory\GoogleMap\Controls\RotateControl|\PHPUnit_Framework_MockObject_MockObject The rotate control mock.
     */
    protected function createRotateControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\RotateControl');
    }

    /**
     * Creates a scale control mock.
     *
     * @return \Ivory\GoogleMap\Controls\ScaleControl|\PHPUnit_Framework_MockObject_MockObject The scale control mock.
     */
    protected function createScaleControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\ScaleControl');
    }

    /**
     * Creates a size mock.
     *
     * @return \Ivory\GoogleMap\Base\Size|\PHPUnit_Framework_MockObject_MockObject The size mock.
     */
    protected function createSizeMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Base\Size')->disableOriginalConstructor()->getMock();
    }

    /**
     * Creates a street view control mock.
     *
     * @return \Ivory\GoogleMap\Controls\StreetViewControl|\PHPUnit_Framework_MockObject_MockObject The street view control mock.
     */
    protected function createStreetViewControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\StreetViewControl');
    }

    /**
     * Creates a variable asset mock.
     *
     * @return \Ivory\GoogleMap\Assets\AbstractVariableAsset|\PHPUnit_Framework_MockObject_MockObject The variable asset mock.
     */
    protected function createVariableAssetMock()
    {
        return $this->createVariableAssetMockBuilder()->getMock();
    }

    /**
     * Creates a variable asset mock builder.
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder The variable asset mock builder.
     */
    protected function createVariableAssetMockBuilder()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Assets\AbstractVariableAsset');
    }

    /**
     * Creates a zoom control mock.
     *
     * @return \Ivory\GoogleMap\Controls\ZoomControl|\PHPUnit_Framework_MockObject_MockObject The zoom control mock.
     */
    protected function createZoomControlMock()
    {
        return $this->getMock('Ivory\GoogleMap\Controls\ZoomControl');
    }
}
