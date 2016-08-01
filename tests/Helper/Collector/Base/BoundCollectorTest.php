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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Collector\Base\BoundCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\GoogleMap\Overlay\Rectangle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BoundCollector
     */
    private $boundCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundCollector = new BoundCollector(new GroundOverlayCollector(), new RectangleCollector());
    }

    public function testGroundOverlayCollector()
    {
        $groundOverlayCollector = $this->createGroundOverlayCollectorMock();
        $this->boundCollector->setGroundOverlayCollector($groundOverlayCollector);

        $this->assertSame($groundOverlayCollector, $this->boundCollector->getGroundOverlayCollector());
    }

    public function testRectangleCollector()
    {
        $rectangleCollector = $this->createRectangleCollectorMock();
        $this->boundCollector->setRectangleCollector($rectangleCollector);

        $this->assertSame($rectangleCollector, $this->boundCollector->getRectangleCollector());
    }

    public function testCollect()
    {
        $this->assertEmpty($this->boundCollector->collect(new Map()));
    }

    public function testCollectAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);

        $this->assertSame([$map->getBound()], $this->boundCollector->collect($map));
    }

    public function testCollectGroundOverlay()
    {
        $map = new Map();
        $map->getOverlayManager()->addGroundOverlay(new GroundOverlay('url', $bound = new Bound()));

        $this->assertSame([$bound], $this->boundCollector->collect($map));
    }

    public function testCollectRectangle()
    {
        $map = new Map();
        $map->getOverlayManager()->addRectangle(new Rectangle($bound = new Bound()));

        $this->assertSame([$bound], $this->boundCollector->collect($map));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GroundOverlayCollector
     */
    private function createGroundOverlayCollectorMock()
    {
        return $this->createMock(GroundOverlayCollector::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RectangleCollector
     */
    private function createRectangleCollectorMock()
    {
        return $this->createMock(RectangleCollector::class);
    }
}
