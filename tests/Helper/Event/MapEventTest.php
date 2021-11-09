<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Event;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Map;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEventTest extends TestCase
{
    private MapEvent $mapEvent;

    /**
     * @var Map|MockObject
     */
    private $map;

    protected function setUp(): void
    {
        $this->map = $this->createMapMock();
        $this->mapEvent = new MapEvent($this->map);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractEvent::class, $this->mapEvent);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->map, $this->mapEvent->getMap());
    }

    /**
     * @return MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
