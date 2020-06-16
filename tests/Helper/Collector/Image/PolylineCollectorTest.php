<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Image;

use Ivory\GoogleMap\Helper\Collector\Image\PolylineCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Polyline;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineCollectorTest extends TestCase
{
    /**
     * @var PolylineCollector
     */
    private $polylineCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineCollector = new PolylineCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getOverlayManager()->addPolyline($polyline = new Polyline());

        $this->assertSame([$polyline], $this->polylineCollector->collect($map));
    }
}
