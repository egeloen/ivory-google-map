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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Collector\Base\SizeCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SizeCollector
     */
    private $sizeCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeCollector = new SizeCollector(
            new InfoWindowCollector($markerCollector = new MarkerCollector()),
            new IconCollector($markerCollector)
        );
    }

    public function testInfoWindowCollector()
    {
        $this->sizeCollector->setInfoWindowCollector($infoWindowCollector = $this->createInfoWindowCollectorMock());

        $this->assertSame($infoWindowCollector, $this->sizeCollector->getInfoWindowCollector());
    }

    public function testIconCollector()
    {
        $this->sizeCollector->setIconCollector($iconCollector = $this->createIconCollectorMock());

        $this->assertSame($iconCollector, $this->sizeCollector->getIconCollector());
    }

    public function testCollect()
    {
        $this->assertEmpty($this->sizeCollector->collect(new Map()));
    }

    public function testCollectInfoWindow()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setPixelOffset($pixelOffset = new Size());

        $map = new Map();
        $map->getOverlayManager()->addInfoWindow($infoWindow);

        $this->assertSame([$pixelOffset], $this->sizeCollector->collect($map));
    }

    public function testCollectMarker()
    {
        $icon = new Icon();
        $icon->setSize($size = new Size());
        $icon->setScaledSize($scaledSize = new Size());

        $marker = new Marker(new Coordinate());
        $marker->setIcon($icon);

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertSame([$size, $scaledSize], $this->sizeCollector->collect($map));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|InfoWindowCollector
     */
    private function createInfoWindowCollectorMock()
    {
        return $this->createMock(InfoWindowCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|IconCollector
     */
    private function createIconCollectorMock()
    {
        return $this->createMock(IconCollector::class);
    }
}
