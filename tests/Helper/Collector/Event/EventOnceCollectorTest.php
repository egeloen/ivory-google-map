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
use Ivory\GoogleMap\Helper\Collector\Event\EventOnceCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventOnceCollector
     */
    private $eventOnceCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventOnceCollector = new EventOnceCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getEventManager()->addEventOnce($event = new Event('handle', 'trigger', 'handle'));

        $this->assertSame([$event], $this->eventOnceCollector->collect($map));
    }
}
