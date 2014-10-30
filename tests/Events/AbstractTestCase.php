<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Events;

use Ivory\Tests\GoogleMap\Services\AbstractTestCase as TestCase;

/**
 * Events test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a dom event instance.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event.
     */
    protected function assertDomEventInstance($domEvent)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Events\DomEvent', $domEvent);
    }

    /**
     * Asserts an event instance.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The event.
     */
    protected function assertEventInstance($event)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Events\Event', $event);
    }
}
