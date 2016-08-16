<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Base\BoundCollector;
use Ivory\GoogleMap\Helper\Collector\Base\CoordinateCollector;
use Ivory\GoogleMap\Helper\Collector\Layer\HeatmapLayerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\CircleCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolygonCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CoordinateCollector
     */
    private $coordinateCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateCollector = new CoordinateCollector(
            new BoundCollector(new GroundOverlayCollector(), new RectangleCollector()),
            new CircleCollector(),
            new InfoWindowCollector($markerCollector = new MarkerCollector()),
            $markerCollector,
            new PolygonCollector(),
            new PolylineCollector(),
            new HeatmapLayerCollector()
        );
    }

    public function testBoundCollector()
    {
        $this->coordinateCollector->setBoundCollector($boundCollector = $this->createBoundCollectorMock());

        $this->assertSame($boundCollector, $this->coordinateCollector->getBoundCollector());
    }

    public function testCircleCollector()
    {
        $this->coordinateCollector->setCircleCollector($circleCollector = $this->createCircleCollectorMock());

        $this->assertSame($circleCollector, $this->coordinateCollector->getCircleCollector());
    }

    public function testInfoWindowCollector()
    {
        $infoWindowCollector = $this->createInfoWindowCollectorMock();
        $this->coordinateCollector->setInfoWindowCollector($infoWindowCollector);

        $this->assertSame($infoWindowCollector, $this->coordinateCollector->getInfoWindowCollector());
    }

    public function testMarkerCollector()
    {
        $this->coordinateCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->coordinateCollector->getMarkerCollector());
    }

    public function testPolygonCollector()
    {
        $this->coordinateCollector->setPolygonCollector($polygonCollector = $this->createPolygonCollectorMock());

        $this->assertSame($polygonCollector, $this->coordinateCollector->getPolygonCollector());
    }

    public function testPolylineCollector()
    {
        $this->coordinateCollector->setPolylineCollector($polylineCollector = $this->createPolylineCollectorMock());

        $this->assertSame($polylineCollector, $this->coordinateCollector->getPolylineCollector());
    }

    public function testHeatmapLayerCollector()
    {
        $heatmapLayerCollector = $this->createHeatmapLayerCollector();
        $this->coordinateCollector->setHeatmapLayerCollector($heatmapLayerCollector);

        $this->assertSame($heatmapLayerCollector, $this->coordinateCollector->getHeatmapLayerCollector());
    }

    public function testCollect()
    {
        $map = new Map();

        $this->assertSame([$map->getCenter()], $this->coordinateCollector->collect($map));
    }

    public function testCollectAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);

        $this->assertEmpty($this->coordinateCollector->collect($map));
    }

    public function testCollectBound()
    {
        $map = new Map();
        $map->getOverlayManager()->addRectangle(new Rectangle(new Bound(
            $southWest = new Coordinate(),
            $northEast = new Coordinate()
        )));

        $this->assertSame([$map->getCenter(), $southWest, $northEast], $this->coordinateCollector->collect($map));
    }

    public function testCollectCircle()
    {
        $map = new Map();
        $map->getOverlayManager()->addCircle(new Circle($center = new Coordinate()));

        $this->assertSame([$map->getCenter(), $center], $this->coordinateCollector->collect($map));
    }

    public function testCollectInfoWindow()
    {
        $map = new Map();
        $map->getOverlayManager()->addInfoWindow(new InfoWindow(
            'content',
            InfoWindowType::DEFAULT_,
            $position = new Coordinate()
        ));

        $this->assertSame([$map->getCenter(), $position], $this->coordinateCollector->collect($map));
    }

    public function testCollectMarker()
    {
        $map = new Map();
        $map->getOverlayManager()->addMarker($marker = new Marker($position = new Coordinate()));

        $this->assertSame([$map->getCenter(), $position], $this->coordinateCollector->collect($map));
    }

    public function testPolygon()
    {
        $map = new Map();
        $map->getOverlayManager()->addPolygon(new Polygon($coordinates = [new Coordinate()]));

        $this->assertSame(array_merge([$map->getCenter()], $coordinates), $this->coordinateCollector->collect($map));
    }

    public function testPolyline()
    {
        $map = new Map();
        $map->getOverlayManager()->addPolyline(new Polyline($coordinates = [new Coordinate()]));

        $this->assertSame(array_merge([$map->getCenter()], $coordinates), $this->coordinateCollector->collect($map));
    }

    public function testCollectHeatmapLayer()
    {
        $map = new Map();
        $map->getLayerManager()->addHeatmapLayer(new HeatmapLayer($coordinates = [new Coordinate()]));

        $this->assertSame(array_merge([$map->getCenter()], $coordinates), $this->coordinateCollector->collect($map));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BoundCollector
     */
    private function createBoundCollectorMock()
    {
        return $this->createMock(BoundCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|CircleCollector
     */
    private function createCircleCollectorMock()
    {
        return $this->createMock(CircleCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|InfoWindowCollector
     */
    private function createInfoWindowCollectorMock()
    {
        return $this->createMock(InfoWindowCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PolygonCollector
     */
    private function createPolygonCollectorMock()
    {
        return $this->createMock(PolygonCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PolylineCollector
     */
    private function createPolylineCollectorMock()
    {
        return $this->createMock(PolylineCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HeatmapLayerCollector
     */
    private function createHeatmapLayerCollector()
    {
        return $this->createMock(HeatmapLayerCollector::class);
    }
}
