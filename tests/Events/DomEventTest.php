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

use Ivory\GoogleMap\Events\DomEvent;

/**
 * Dom event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Events\DomEvent */
    private $domEvent;

    /** @var string */
    private $instance;

    /** @var string */
    private $eventName;

    /** @var string */
    private $handle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEvent = new DomEvent(
            $this->instance = 'instance',
            $this->eventName = 'eventName',
            $this->handle = 'handle'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->handle);
        unset($this->eventName);
        unset($this->instance);
        unset($this->event);
    }

    public function testInheritance()
    {
        $this->assertEventInstance($this->domEvent);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('event_', $this->domEvent->getVariable());
        $this->assertSame($this->instance, $this->domEvent->getInstance());
        $this->assertSame($this->eventName, $this->domEvent->getEventName());
        $this->assertSame($this->handle, $this->domEvent->getHandle());
        $this->assertFalse($this->domEvent->isCapture());
    }

    public function testInitialState()
    {
        $this->domEvent = new DomEvent(
            $this->instance,
            $this->eventName,
            $this->handle,
            true
        );

        $this->assertTrue($this->domEvent->isCapture());
    }

    public function testSetCapture()
    {
        $this->domEvent->setCapture(true);

        $this->assertTrue($this->domEvent->isCapture());
    }
}
