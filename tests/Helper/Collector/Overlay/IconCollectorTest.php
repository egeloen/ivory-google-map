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

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconCollectorTest extends TestCase
{
    private IconCollector $iconCollector;

    protected function setUp(): void
    {
        $this->iconCollector = new IconCollector(new MarkerCollector());
    }

    public function testMarkerCollector()
    {
        $this->iconCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->iconCollector->getMarkerCollector());
    }

    public function testCollect()
    {
        $marker = new Marker(new Coordinate());
        $marker->setIcon($icon = new Icon());

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertSame([$icon], $this->iconCollector->collect($map));
    }

    /**
     * @return MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }
}
