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

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Helper\Event\AbstractEvent;
use Symfony\Component\EventDispatcher\Event;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends TestCase
{
    /**
     * @var AbstractEvent
     */
    private $event;

    protected function setUp(): void
    {
        $this->event = $this->createAbstractEventMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(Event::class, $this->event);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->event->hasCode());
        $this->assertSame('', $this->event->getCode());
    }

    public function testSetCode()
    {
        $this->event->setCode($code = 'code');
        $this->event->setCode($code);

        $this->assertTrue($this->event->hasCode());
        $this->assertSame($code, $this->event->getCode());
    }

    public function testAddCode()
    {
        $this->event->setCode($firstCode = 'code1');
        $this->event->addCode($secondCode = 'code2');

        $this->assertTrue($this->event->hasCode());
        $this->assertSame($firstCode.$secondCode, $this->event->getCode());
    }

    /**
     * @return MockObject|AbstractEvent
     */
    private function createAbstractEventMock()
    {
        return $this->getMockForAbstractClass(AbstractEvent::class);
    }
}
