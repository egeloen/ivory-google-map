<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\Event\DomEventCollector;
use Ivory\GoogleMap\Map;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventCollectorTest extends TestCase
{
    private DomEventCollector $domEventCollector;

    protected function setUp(): void
    {
        $this->domEventCollector = new DomEventCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getEventManager()->addDomEvent($event = new Event('handle', 'trigger', 'handle'));

        $this->assertSame([$event], $this->domEventCollector->collect($map));
    }
}
