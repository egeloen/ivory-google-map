<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Coordinate aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\CoordinateAggregator */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $circleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $polygonAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $polylineAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateAggregator = new CoordinateAggregator(
            $this->boundAggregator = $this->createBoundAggregatorMock(),
            $this->circleAggregator = $this->createCircleAggregatorMock(),
            $this->infoWindowAggregator = $this->createInfoWindowAggregatorMock(),
            $this->markerAggregator = $this->createMarkerAggregatorMock(),
            $this->polygonAggregator = $this->createPolygonAggregatorMock(),
            $this->polylineAggregator = $this->createPolylineAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polylineAggregator);
        unset($this->polygonAggregator);
        unset($this->markerAggregator);
        unset($this->infoWindowAggregator);
        unset($this->circleAggregator);
        unset($this->boundAggregator);
        unset($this->coordinateAggregator);
    }

    public function testDefaultState()
    {
        $this->coordinateAggregator = new CoordinateAggregator();

        $this->assertBoundAggregatorInstance($this->coordinateAggregator->getBoundAggregator());
        $this->assertCircleAggregatorInstance($this->coordinateAggregator->getCircleAggregator());
        $this->assertInfoWindowAggregatorInstance($this->coordinateAggregator->getInfoWindowAggregator());
        $this->assertMarkerAggregatorInstance($this->coordinateAggregator->getMarkerAggregator());
        $this->assertPolygonAggregatorInstance($this->coordinateAggregator->getPolygonAggregator());
        $this->assertPolylineAggregatorInstance($this->coordinateAggregator->getPolylineAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->boundAggregator, $this->coordinateAggregator->getBoundAggregator());
        $this->assertSame($this->circleAggregator, $this->coordinateAggregator->getCircleAggregator());
        $this->assertSame($this->infoWindowAggregator, $this->coordinateAggregator->getInfoWindowAggregator());
        $this->assertSame($this->markerAggregator, $this->coordinateAggregator->getMarkerAggregator());
        $this->assertSame($this->polygonAggregator, $this->coordinateAggregator->getPolygonAggregator());
        $this->assertSame($this->polylineAggregator, $this->coordinateAggregator->getPolylineAggregator());
    }

    public function testSetBoundAggregator()
    {
        $this->coordinateAggregator->setBoundAggregator($boundAggregator = $this->createBoundAggregatorMock());

        $this->assertSame($boundAggregator, $this->coordinateAggregator->getBoundAggregator());
    }

    public function testSetCircleAggregator()
    {
        $this->coordinateAggregator->setCircleAggregator($circleAggregator = $this->createCircleAggregatorMock());

        $this->assertSame($circleAggregator, $this->coordinateAggregator->getCircleAggregator());
    }

    public function testSetInfoWindowAggregator()
    {
        $this->coordinateAggregator->setInfoWindowAggregator(
            $infoWindowAggregator = $this->createInfoWindowAggregatorMock()
        );

        $this->assertSame($infoWindowAggregator, $this->coordinateAggregator->getInfoWindowAggregator());
    }

    public function testSetMarkerAggregator()
    {
        $this->coordinateAggregator->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->coordinateAggregator->getMarkerAggregator());
    }

    public function testSetPolygonAggregator()
    {
        $this->coordinateAggregator->setPolygonAggregator($polygonAggregator = $this->createPolygonAggregatorMock());

        $this->assertSame($polygonAggregator, $this->coordinateAggregator->getPolygonAggregator());
    }

    public function testSetPolylineAggregator()
    {
        $this->coordinateAggregator->setPolylineAggregator($polylineAggregator = $this->createPolylineAggregatorMock());

        $this->assertSame($polylineAggregator, $this->coordinateAggregator->getPolylineAggregator());
    }

    /**
     * @dataProvider aggregateBoundsProvider
     */
    public function testAggregateBounds(array $expected, array $bounds = array(), array $coordinates = array())
    {
        $map = $this->createMapMock();

        $this->boundAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($bounds));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregateBounds($map, $coordinates));
    }

    /**
     * @dataProvider aggregateCirclesProvider
     */
    public function testAggregateCircles(array $expected, array $circles = array(), array $coordinates = array())
    {
        $map = $this->createMapMock();

        $this->circleAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($circles));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregateCircles($map, $coordinates));
    }

    /**
     * @dataProvider aggregateInfoWindowsProvider
     */
    public function testAggregateInfoWindows(
        array $expected,
        array $infoWindows = array(),
        array $coordinates = array()
    ) {
        $map = $this->createMapMock();

        $this->infoWindowAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($infoWindows));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregateInfoWindows($map, $coordinates));
    }

    /**
     * @dataProvider aggregateMarkersProvider
     */
    public function testAggregateMarkers(array $expected, array $markers = array(), array $coordinates = array())
    {
        $map = $this->createMapMock();

        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregateMarkers($map, $coordinates));
    }

    /**
     * @dataProvider aggregatePolygonsProvider
     */
    public function testAggregatePolygons(array $expected, array $polygons = array(), array $coordinates = array())
    {
        $map = $this->createMapMock();

        $this->polygonAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($polygons));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregatePolygons($map, $coordinates));
    }

    /**
     * @dataProvider aggregatePolylinesProvider
     */
    public function testAggregatePolylines(array $expected, array $polylines = array(), array $coordinates = array())
    {
        $map = $this->createMapMock();

        $this->polylineAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($polylines));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregatePolylines($map, $coordinates));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(
        array $expected,
        array $bounds = array(),
        array $circles = array(),
        array $infoWindows = array(),
        array $markers = array(),
        array $polygons = array(),
        array $polylines = array(),
        Coordinate $center = null,
        array $coordinates = array()
    ) {
        $map = $this->createMapMock($center);

        $this->boundAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($bounds));

        $this->circleAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($circles));

        $this->infoWindowAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($infoWindows));

        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($markers));

        $this->polygonAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($polygons));

        $this->polylineAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($polylines));

        $this->assertEquals($expected, $this->coordinateAggregator->aggregate($map, $coordinates));
    }

    /**
     * Gets the aggregate bounds provider.
     *
     * @return array The aggregate bounds provider.
     */
    public function aggregateBoundsProvider()
    {
        $bound1 = $this->createBoundMock();

        $bound2 = $this->createBoundMock(
            $coordinate1 = $this->createCoordinateMock(),
            $coordinate2 = $this->createCoordinateMock()
        );

        $bound3 = $this->createBoundMock(
            $coordinate3 = $this->createCoordinateMock(),
            $coordinate4 = $this->createCoordinateMock()
        );

        $bound4 = $this->createBoundMock($coordinate1, $coordinate4);

        $simpleBounds = array($bound1, $bound2);
        $fullBounds = array($bound1, $bound2, $bound3, $bound4);

        $simpleCoordinates = array($coordinate1, $coordinate2);
        $fullCoordinates = array($coordinate1, $coordinate2, $coordinate3, $coordinate4);

        return array(
            array(array()),
            array($simpleCoordinates, $simpleBounds),
            array($fullCoordinates, $fullBounds),
            array($fullCoordinates, $fullBounds, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate circles provider.
     *
     * @return array The aggregate circles provider.
     */
    public function aggregateCirclesProvider()
    {
        $circle1 = $this->createCircleMock($coordinate1 = $this->createCoordinateMock());
        $circle2 = $this->createCircleMock($coordinate2 = $this->createCoordinateMock());
        $circle3 = $this->createCircleMock($coordinate1);

        $simpleCircles = array($circle1);
        $fullCircles = array($circle1, $circle2, $circle3);

        $simpleCoordinates = array($coordinate1);
        $fullCoordinates = array($coordinate1, $coordinate2);

        return array(
            array(array()),
            array($simpleCoordinates, $simpleCircles),
            array($fullCoordinates, $fullCircles),
            array($fullCoordinates, $fullCircles, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate info windows provider.
     *
     * @return array The aggregate info windows provider.
     */
    public function aggregateInfoWindowsProvider()
    {
        $infoWindow1 = $this->createInfoWindowMock($coordinate1 = $this->createCoordinateMock());
        $infoWindow2 = $this->createInfoWindowMock($coordinate2 = $this->createCoordinateMock());
        $infoWindow3 = $this->createInfoWindowMock($coordinate1);

        $simpleInfoWindows = array($infoWindow1);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3);

        $simpleCoordinates = array($coordinate1);
        $fullCoordinates = array($coordinate1, $coordinate2);

        return array(
            array(array()),
            array($simpleCoordinates, $simpleInfoWindows),
            array($fullCoordinates, $fullInfoWindows),
            array($fullCoordinates, $fullInfoWindows, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate markers provider.
     *
     * @return array The aggregate markers provider.
     */
    public function aggregateMarkersProvider()
    {
        $marker1 = $this->createMarkerMock($coordinate1 = $this->createCoordinateMock());
        $marker2 = $this->createMarkerMock($coordinate2 = $this->createCoordinateMock());
        $marker3 = $this->createMarkerMock($coordinate1);

        $simpleMarkers = array($marker1);
        $fullMarkers = array($marker1, $marker2, $marker3);

        $simpleCoordinates = array($coordinate1);
        $fullCoordinates = array($coordinate1, $coordinate2);

        return array(
            array(array()),
            array($simpleCoordinates, $simpleMarkers),
            array($fullCoordinates, $fullMarkers),
            array($fullCoordinates, $fullMarkers, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate polygons provider.
     *
     * @return array The aggregate polygons provider.
     */
    public function aggregatePolygonsProvider()
    {
        $polygon1 = $this->createPolygonMock($coordinates1 = array(
            $coordinate1 = $this->createCoordinateMock(),
            $this->createCoordinateMock(),
        ));

        $polygon2 = $this->createPolygonMock($coordinates2 = array(
            $this->createCoordinateMock(),
            $this->createCoordinateMock(),
        ));

        $polygon3 = $this->createPolygonMock(array($coordinate1, $coordinate5 = $this->createCoordinateMock()));

        $simplePolygons = array($polygon1);
        $fullPolygons = array($polygon1, $polygon2, $polygon3);

        $simpleCoordinates = $coordinates1;
        $fullCoordinates = array_merge($coordinates1, $coordinates2, array($coordinate5));

        return array(
            array(array()),
            array($simpleCoordinates, $simplePolygons),
            array($fullCoordinates, $fullPolygons),
            array($fullCoordinates, $fullPolygons, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate polylines provider.
     *
     * @return array The aggregate polylines provider.
     */
    public function aggregatePolylinesProvider()
    {
        $polyline1 = $this->createPolylineMock($coordinates1 = array(
            $coordinate1 = $this->createCoordinateMock(),
            $this->createCoordinateMock(),
        ));

        $polyline2 = $this->createPolylineMock($coordinates2 = array(
            $this->createCoordinateMock(),
            $this->createCoordinateMock(),
        ));

        $polyline3 = $this->createPolylineMock(array($coordinate1, $coordinate5 = $this->createCoordinateMock()));

        $simplePolylines = array($polyline1);
        $fullPolylines = array($polyline1, $polyline2, $polyline3);

        $simpleCoordinates = $coordinates1;
        $fullCoordinates = array_merge($coordinates1, $coordinates2, array($coordinate5));

        return array(
            array(array()),
            array($simpleCoordinates, $simplePolylines),
            array($fullCoordinates, $fullPolylines),
            array($fullCoordinates, $fullPolylines, $simpleCoordinates),
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $bound1 = $this->createBoundMock();

        $bound2 = $this->createBoundMock(
            $coordinate1 = $this->createCoordinateMock(),
            $coordinate2 = $this->createCoordinateMock()
        );

        $bound3 = $this->createBoundMock(
            $coordinate3 = $this->createCoordinateMock(),
            $coordinate4 = $this->createCoordinateMock()
        );

        $bound4 = $this->createBoundMock($coordinate1, $coordinate4);

        $circle1 = $this->createCircleMock($coordinate5 = $this->createCoordinateMock());
        $circle2 = $this->createCircleMock($coordinate6 = $this->createCoordinateMock());
        $circle3 = $this->createCircleMock($coordinate5);

        $infoWindow1 = $this->createInfoWindowMock($coordinate7 = $this->createCoordinateMock());
        $infoWindow2 = $this->createInfoWindowMock($coordinate8 = $this->createCoordinateMock());
        $infoWindow3 = $this->createInfoWindowMock($coordinate7);

        $marker1 = $this->createMarkerMock($coordinate9 = $this->createCoordinateMock());
        $marker2 = $this->createMarkerMock($coordinate10 = $this->createCoordinateMock());
        $marker3 = $this->createMarkerMock($coordinate9);

        $polygon1 = $this->createPolygonMock(array(
            $coordinate11 = $this->createCoordinateMock(),
            $coordinate12 = $this->createCoordinateMock(),
        ));

        $polygon2 = $this->createPolygonMock($coordinates2 = array(
            $coordinate13 = $this->createCoordinateMock(),
            $coordinate14 = $this->createCoordinateMock(),
        ));

        $polygon3 = $this->createPolygonMock(array($coordinate11, $coordinate15 = $this->createCoordinateMock()));

        $polyline1 = $this->createPolylineMock($coordinates1 = array(
            $coordinate16 = $this->createCoordinateMock(),
            $coordinate17 = $this->createCoordinateMock(),
        ));

        $polyline2 = $this->createPolylineMock($coordinates2 = array(
            $coordinate18 = $this->createCoordinateMock(),
            $coordinate19 = $this->createCoordinateMock(),
        ));

        $polyline3 = $this->createPolylineMock(array($coordinate16, $coordinate20 = $this->createCoordinateMock()));

        $mapCenter = $this->createCoordinateMock();

        $simpleBounds = array($bound1, $bound2);
        $fullBounds = array($bound1, $bound2, $bound3, $bound4);

        $simpleCircles = array($circle1);
        $fullCircles = array($circle1, $circle2, $circle3);

        $simpleInfoWindows = array($infoWindow1);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3);

        $simpleMarkers = array($marker1);
        $fullMarkers = array($marker1, $marker2, $marker3);

        $simplePolygons = array($polygon1);
        $fullPolygons = array($polygon1, $polygon2, $polygon3);

        $simplePolylines = array($polyline1);
        $fullPolylines = array($polyline1, $polyline2, $polyline3);

        $simpleCoordinates = array(
            $coordinate1,
            $coordinate2,
            $coordinate5,
            $coordinate7,
            $coordinate9,
            $coordinate11,
            $coordinate12,
            $coordinate16,
            $coordinate17,
        );

        $fullCoordinates = array(
            $coordinate1,
            $coordinate2,
            $coordinate3,
            $coordinate4,
            $coordinate5,
            $coordinate6,
            $coordinate7,
            $coordinate8,
            $coordinate9,
            $coordinate10,
            $coordinate11,
            $coordinate12,
            $coordinate13,
            $coordinate14,
            $coordinate15,
            $coordinate16,
            $coordinate17,
            $coordinate18,
            $coordinate19,
            $coordinate20,
        );

        return array(
            array(array()),
            array(
                $simpleCoordinates,
                $simpleBounds,
                $simpleCircles,
                $simpleInfoWindows,
                $simpleMarkers,
                $simplePolygons,
                $simplePolylines,
            ),
            array(
                $fullCoordinates,
                $fullBounds,
                $fullCircles,
                $fullInfoWindows,
                $fullMarkers,
                $fullPolygons,
                $fullPolylines,
            ),
            array(
                array_merge(array($mapCenter), $fullCoordinates),
                $fullBounds,
                $fullCircles,
                $fullInfoWindows,
                $fullMarkers,
                $fullPolygons,
                $fullPolylines,
                $mapCenter,
                $simpleCoordinates,
            ),
            array(
                array_merge(array($mapCenter), $fullCoordinates),
                $fullBounds,
                $fullCircles,
                $fullInfoWindows,
                $fullMarkers,
                $fullPolygons,
                $fullPolylines,
                $mapCenter,
                $simpleCoordinates,
            ),
        );
    }

    /**
     * Creates a bound mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west.
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east.
     *
     * @return \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject The bound mock.
     */
    protected function createBoundMock(Coordinate $southWest = null, Coordinate $northEast = null)
    {
        $bound = parent::createBoundMock();

        if ($southWest !== null) {
            $bound
                ->expects($this->any())
                ->method('getSouthWest')
                ->will($this->returnValue($southWest));
        }

        if ($northEast !== null) {
            $bound
                ->expects($this->any())
                ->method('getNorthEast')
                ->will($this->returnValue($northEast));
        }

        if ($southWest !== null && $northEast !== null) {
            $bound
                ->expects($this->any())
                ->method('hasCoordinates')
                ->will($this->returnValue(true));
        }

        return $bound;
    }

    /**
     * Creates an circle mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $center The center.
     *
     * @return \Ivory\GoogleMap\Overlays\Circle|\PHPUnit_Framework_MockObject_MockObject The circle mock.
     */
    protected function createCircleMock(Coordinate $center = null)
    {
        $circle = parent::createCircleMock();
        $circle
            ->expects($this->any())
            ->method('getCenter')
            ->will($this->returnValue($center));

        return $circle;
    }

    /**
     * Creates an info window mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position The position.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow|\PHPUnit_Framework_MockObject_MockObject The info window mock.
     */
    protected function createInfoWindowMock(Coordinate $position = null)
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('hasPosition')
            ->will($this->returnValue(true));

        $infoWindow
            ->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue($position));

        return $infoWindow;
    }

    /**
     * Creates a map mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $center The center.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(Coordinate $center = null)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock()));

        if ($center !== null) {
            $map
                ->expects($this->any())
                ->method('getCenter')
                ->will($this->returnValue($center));
        } else {
            $overlays
                ->expects($this->any())
                ->method('isAutoZoom')
                ->will($this->returnValue(true));
        }

        return $map;
    }

    /**
     * Creates a maker mock.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position The position.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(Coordinate $position = null)
    {
        $marker = parent::createMarkerMock();
        $marker
            ->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue($position));

        return $marker;
    }

    /**
     * Creates a polygon mock.
     *
     * @param array $coordinates The coordinates.
     *
     * @return \Ivory\GoogleMap\Overlays\Polygon|\PHPUnit_Framework_MockObject_MockObject The polygon mock.
     */
    protected function createPolygonMock(array $coordinates = array())
    {
        $polygon = parent::createPolygonMock();
        $polygon
            ->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue($coordinates));

        return $polygon;
    }

    /**
     * Creates a polyline mock.
     *
     * @param array $coordinates The coordinates.
     *
     * @return \Ivory\GoogleMap\Overlays\Polyline|\PHPUnit_Framework_MockObject_MockObject The polyline mock.
     */
    protected function createPolylineMock(array $coordinates = array())
    {
        $polyline = parent::createPolylineMock();
        $polyline
            ->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue($coordinates));

        return $polyline;
    }
}
