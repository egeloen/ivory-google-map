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
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Map;
use Symfony\Component\EventDispatcher\Event;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapEventTest extends TestCase
{
    private StaticMapEvent $staticMapEvent;

    /**
     * @var Map|MockObject
     */
    private $map;

    protected function setUp(): void
    {
        $this->map = $this->createMapMock();
        $this->staticMapEvent = new StaticMapEvent($this->map);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(Event::class, $this->staticMapEvent);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->map, $this->staticMapEvent->getMap());
        $this->assertFalse($this->staticMapEvent->hasParameters());
        $this->assertSame([], $this->staticMapEvent->getParameters());
    }

    public function testInitialState()
    {
        $this->staticMapEvent = new StaticMapEvent($this->map, $parameters = ['foo' => 'bar']);

        $this->assertTrue($this->staticMapEvent->hasParameters());
        $this->assertSame($parameters, $this->staticMapEvent->getParameters());
    }

    public function testSetParameters()
    {
        $this->staticMapEvent->setParameters($parameters = [$parameter = 'foo' => $value = 'bar']);
        $this->staticMapEvent->setParameters($parameters);

        $this->assertTrue($this->staticMapEvent->hasParameters());
        $this->assertSame($parameters, $this->staticMapEvent->getParameters());
        $this->assertTrue($this->staticMapEvent->hasParameter($parameter));
        $this->assertSame($value, $this->staticMapEvent->getParameter($parameter));
    }

    public function testAddParameters()
    {
        $this->staticMapEvent->setParameters($firstParameters = ['foo' => 'bar']);
        $this->staticMapEvent->addParameters($secondParameters = ['baz' => 'bat']);

        $this->assertTrue($this->staticMapEvent->hasParameters());
        $this->assertSame(array_merge($firstParameters, $secondParameters), $this->staticMapEvent->getParameters());
    }

    public function testSetParameter()
    {
        $this->staticMapEvent->setParameter($parameter = 'foo', $value = 'bar');

        $this->assertTrue($this->staticMapEvent->hasParameters());
        $this->assertSame([$parameter => $value], $this->staticMapEvent->getParameters());
        $this->assertTrue($this->staticMapEvent->hasParameter($parameter));
        $this->assertSame($value, $this->staticMapEvent->getParameter($parameter));
    }

    public function testRemoveParameter()
    {
        $this->staticMapEvent->setParameter($parameter = 'foo', 'bar');
        $this->staticMapEvent->removeParameter($parameter);

        $this->assertFalse($this->staticMapEvent->hasParameters());
        $this->assertFalse($this->staticMapEvent->hasParameter($parameter));
    }

    public function testMissingParameter()
    {
        $this->assertNull($this->staticMapEvent->getParameter('foo'));
    }

    /**
     * @return MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
