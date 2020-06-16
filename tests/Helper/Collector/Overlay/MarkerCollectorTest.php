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
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCollectorTest extends TestCase
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerCollector = new MarkerCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addMarker($marker = new Marker(new Coordinate()));

        $this->assertSame([$marker], $this->markerCollector->collect($map));
    }
}
