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
use Ivory\GoogleMap\Helper\Collector\Overlay\IconSequenceCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\SymbolCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolCollectorTest extends TestCase
{
    private SymbolCollector $symbolCollector;

    protected function setUp(): void
    {
        $this->symbolCollector = new SymbolCollector(
            new MarkerCollector(),
            new IconSequenceCollector(new PolylineCollector())
        );
    }

    public function testMarkerCollector()
    {
        $this->symbolCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->symbolCollector->getMarkerCollector());
    }

    public function testIconSequenceCollector()
    {
        $iconSequenceCollector = $this->createIconSequenceCollectorMock();
        $this->symbolCollector->setIconSequenceCollector($iconSequenceCollector);

        $this->assertSame($iconSequenceCollector, $this->symbolCollector->getIconSequenceCollector());
    }

    public function testCollect()
    {
        $marker = new Marker(new Coordinate());
        $marker->setSymbol($markerSymbol = new Symbol(SymbolPath::CIRCLE));

        $iconSequence = new IconSequence($polylineSymbol = new Symbol(SymbolPath::CIRCLE));

        $polyline = new Polyline();
        $polyline->addIconSequence($iconSequence);

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);
        $map->getOverlayManager()->addPolyline($polyline);

        $this->assertSame([$markerSymbol, $polylineSymbol], $this->symbolCollector->collect($map));
    }

    /**
     * @return MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }

    /**
     * @return MockObject|IconSequenceCollector
     */
    private function createIconSequenceCollectorMock()
    {
        return $this->createMock(IconSequenceCollector::class);
    }
}
