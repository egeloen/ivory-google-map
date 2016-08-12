<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoWindowCollector
     */
    private $infoWindowCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowCollector = new InfoWindowCollector(new MarkerCollector());
    }

    public function testMarkerCollector()
    {
        $this->infoWindowCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->infoWindowCollector->getMarkerCollector());
    }

    public function testType()
    {
        $this->infoWindowCollector->setType($type = InfoWindowType::DEFAULT_);

        $this->assertSame($type, $this->infoWindowCollector->getType());
    }

    public function testCollect()
    {
        $defaultInfoWindow = new InfoWindow('content', InfoWindowType::DEFAULT_);
        $infoBox = new InfoWindow('content', InfoWindowType::INFO_BOX);

        $map = new Map();
        $map->getOverlayManager()->addInfoWindows([$defaultInfoWindow, $infoBox]);

        $this->assertSame([$defaultInfoWindow, $infoBox], $this->infoWindowCollector->collect($map));
    }

    public function testCollectMarker()
    {
        $marker = new Marker(new Coordinate());
        $marker->setInfoWindow(new InfoWindow('content'));

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertEmpty($this->infoWindowCollector->collect($map));
    }

    public function testCollectMarkerWithoutPosition()
    {
        $marker = new Marker(new Coordinate());
        $marker->setInfoWindow($infoWindow = new InfoWindow('content'));

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertSame([$infoWindow], $this->infoWindowCollector->collect($map, [], false));
    }

    public function testCollectWithType()
    {
        $this->infoWindowCollector->setType(InfoWindowType::DEFAULT_);

        $defaultInfoWindow = new InfoWindow('content', InfoWindowType::DEFAULT_);
        $infoBox = new InfoWindow('content', InfoWindowType::INFO_BOX);

        $map = new Map();
        $map->getOverlayManager()->addInfoWindows([$defaultInfoWindow, $infoBox]);

        $this->assertSame([$defaultInfoWindow], $this->infoWindowCollector->collect($map));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }
}
