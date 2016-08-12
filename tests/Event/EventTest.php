<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @var string
     */
    private $instance;

    /**
     * @var string
     */
    private $trigger;

    /**
     * @var string
     */
    private $handle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->event = new Event(
            $this->instance = 'instance',
            $this->trigger = MouseEvent::CLICK,
            $this->handle = 'function () {}'
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->event);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('event', $this->event->getVariable());
        $this->assertSame($this->instance, $this->event->getInstance());
        $this->assertSame($this->trigger, $this->event->getTrigger());
        $this->assertSame($this->handle, $this->event->getHandle());
        $this->assertFalse($this->event->isCapture());
    }

    public function testInitialState()
    {
        $this->event = new Event($this->instance, $this->trigger, $this->handle, true);

        $this->assertStringStartsWith('event', $this->event->getVariable());
        $this->assertSame($this->instance, $this->event->getInstance());
        $this->assertSame($this->trigger, $this->event->getTrigger());
        $this->assertSame($this->handle, $this->event->getHandle());
        $this->assertTrue($this->event->isCapture());
    }

    public function testInstance()
    {
        $this->event->setInstance($instance = 'foo');

        $this->assertSame($instance, $this->event->getInstance());
    }

    public function testTrigger()
    {
        $this->event->setTrigger($trigger = MouseEvent::DBLCLICK);

        $this->assertSame($trigger, $this->event->getTrigger());
    }

    public function testHandle()
    {
        $this->event->setHandle($handle = 'function () { alert("handle"); }');

        $this->assertSame($handle, $this->event->getHandle());
    }

    public function testCaptureWithValidValue()
    {
        $this->event->setCapture(true);

        $this->assertTrue($this->event->isCapture());
    }
}
