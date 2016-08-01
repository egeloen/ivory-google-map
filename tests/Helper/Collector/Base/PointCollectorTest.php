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
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Collector\Base\PointCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PointCollector
     */
    private $pointCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointCollector = new PointCollector(new MarkerCollector());
    }

    public function testMarkerCollector()
    {
        $this->pointCollector->setMarkerCollector($markerCollector = $this->createMarkerCollectorMock());

        $this->assertSame($markerCollector, $this->pointCollector->getMarkerCollector());
    }

    public function testRender()
    {
        $this->assertEmpty($this->pointCollector->collect(new Map()));
    }

    public function testCollectMarker()
    {
        $marker = new Marker(new Coordinate());
        $marker->setIcon($icon = $this->createIcon());

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->assertSame(
            [$icon->getAnchor(), $icon->getOrigin()],
            $this->pointCollector->collect($map)
        );
    }

    /**
     * @return Icon
     */
    private function createIcon()
    {
        $icon = new Icon();
        $icon->setAnchor(new Point());
        $icon->setOrigin(new Point());

        return $icon;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MarkerCollector
     */
    private function createMarkerCollectorMock()
    {
        return $this->createMock(MarkerCollector::class);
    }
}
