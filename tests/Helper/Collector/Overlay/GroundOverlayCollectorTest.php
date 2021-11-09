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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayCollectorTest extends TestCase
{
    private GroundOverlayCollector $groundOverlayCollector;

    protected function setUp(): void
    {
        $this->groundOverlayCollector = new GroundOverlayCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addGroundOverlay($groundOverlay = new GroundOverlay('url', new Bound()));

        $this->assertSame([$groundOverlay], $this->groundOverlayCollector->collect($map));
    }
}
