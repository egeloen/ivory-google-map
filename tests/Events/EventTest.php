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

use Ivory\GoogleMap\Events\Event;

/**
 * Event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Events\Event */
    private $event;

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
        $this->event = new Event(
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
        $this->assertVariableAssetInstance($this->event);
    }

    public function testInitialState()
    {
        $this->assertStringStartsWith('event_', $this->event->getVariable());
        $this->assertSame($this->instance, $this->event->getInstance());
        $this->assertSame($this->eventName, $this->event->getEventName());
        $this->assertSame($this->handle, $this->event->getHandle());
    }

    public function testSetInstance()
    {
        $this->event->setInstance($instance = 'foo');

        $this->assertSame($instance, $this->event->getInstance());
    }

    public function testSetEventName()
    {
        $this->event->setEventName($eventName = 'foo');

        $this->assertSame($eventName, $this->event->getEventName());
    }

    public function testSetHandle()
    {
        $this->event->setHandle($handle = 'foo');

        $this->assertSame($handle, $this->event->getHandle());
    }
}
