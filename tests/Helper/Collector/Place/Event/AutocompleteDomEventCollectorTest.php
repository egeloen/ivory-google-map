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
use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteDomEventCollector;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteDomEventCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AutocompleteDomEventCollector
     */
    private $domEventCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEventCollector = new AutocompleteDomEventCollector();
    }

    public function testCollect()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addDomEvent($event = new Event('handle', 'trigger', 'handle'));

        $this->assertSame([$event], $this->domEventCollector->collect($autocomplete));
    }
}
