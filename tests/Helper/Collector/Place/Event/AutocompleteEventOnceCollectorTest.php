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
use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventOnceCollector;
use Ivory\GoogleMap\Place\Autocomplete;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteEventOnceCollectorTest extends TestCase
{
    private AutocompleteEventOnceCollector $eventOnceCollector;

    protected function setUp(): void
    {
        $this->eventOnceCollector = new AutocompleteEventOnceCollector();
    }

    public function testCollect()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addEventOnce($event = new Event('handle', 'trigger', 'handle'));

        $this->assertSame([$event], $this->eventOnceCollector->collect($autocomplete));
    }
}
