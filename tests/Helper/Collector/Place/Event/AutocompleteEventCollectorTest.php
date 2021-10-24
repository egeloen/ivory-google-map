<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Place\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventCollector;
use Ivory\GoogleMap\Place\Autocomplete;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteEventCollectorTest extends TestCase
{
    /**
     * @var AutocompleteEventCollector
     */
    private $eventCollector;

    protected function setUp(): void
    {
        $this->eventCollector = new AutocompleteEventCollector();
    }

    public function testCollect()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addEvent($event = new Event('handle', 'trigger', 'handle'));

        $this->assertSame([$event], $this->eventCollector->collect($autocomplete));
    }
}
