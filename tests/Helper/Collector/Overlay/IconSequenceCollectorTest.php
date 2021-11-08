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
use Ivory\GoogleMap\Helper\Collector\Overlay\IconSequenceCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequenceCollectorTest extends TestCase
{
    private IconSequenceCollector $iconSequenceCollector;

    protected function setUp(): void
    {
        $this->iconSequenceCollector = new IconSequenceCollector(new PolylineCollector());
    }

    public function testPolylineCollector()
    {
        $this->iconSequenceCollector->setPolylineCollector($polylineCollector = $this->createPolylineCollectorMock());

        $this->assertSame($polylineCollector, $this->iconSequenceCollector->getPolylineCollector());
    }

    public function testCollect()
    {
        $iconSequence = new IconSequence(new Symbol(SymbolPath::CIRCLE));

        $polyline = new Polyline();
        $polyline->addIconSequence($iconSequence);

        $map = new Map();
        $map->getOverlayManager()->addPolyline($polyline);

        $this->assertSame([$iconSequence], $this->iconSequenceCollector->collect($map));
    }

    /**
     * @return MockObject|PolylineCollector
     */
    private function createPolylineCollectorMock()
    {
        return $this->createMock(PolylineCollector::class);
    }
}
