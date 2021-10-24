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
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerShapeCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeCollectorTest extends TestCase
{
    /**
     * @var MarkerShapeCollector
     */
    private $markerShapeCollector;

    protected function setUp(): void
    {
        $this->markerShapeCollector = new MarkerShapeCollector(new MarkerCollector());
    }

    public function testMarkerCollector()
    {
        $this->markerShapeCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->markerShapeCollector->getMarkerCollector());
    }

    public function testCollect()
    {
        $marker = new Marker(new Coordinate());
        $marker->setShape($markerShape = new MarkerShape(MarkerShapeType::POLY, [1, 1, 1, 20, 18, 20, 18, 1]));

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertSame([$markerShape], $this->markerShapeCollector->collect($map));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }
}
