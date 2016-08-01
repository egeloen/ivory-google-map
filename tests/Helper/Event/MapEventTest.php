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

use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapEvent
     */
    private $mapEvent;

    /**
     * @var Map|\PHPUnit_Framework_MockObject_MockObject
     */
    private $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
