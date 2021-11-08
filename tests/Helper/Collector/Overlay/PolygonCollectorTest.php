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

use Ivory\GoogleMap\Helper\Collector\Overlay\PolygonCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Polygon;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonCollectorTest extends TestCase
{
    private PolygonCollector $polygonCollector;

    protected function setUp(): void
    {
        $this->polygonCollector = new PolygonCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addPolygon($polygon = new Polygon());

        $this->assertSame([$polygon], $this->polygonCollector->collect($map));
    }
}
