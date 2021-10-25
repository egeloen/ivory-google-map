<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Builder;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Helper\Builder\AbstractHelperBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperBuilderTest extends TestCase
{
    /**
     * @var AbstractHelperBuilder
     */
    private $helperBuilder;

    protected function setUp(): void
    {
        $this->helperBuilder = $this->createAbstractHelperBuilder();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->helperBuilder->hasSubscribers());
        $this->assertEmpty($this->helperBuilder->getSubscribers());
    }

    public function testSetSubscribers()
    {
        $this->assertSame(
            $this->helperBuilder,
            $this->helperBuilder->setSubscribers($subscribers = [$subscriber = $this->createEventSubscriberMock()])
        );

        $this->assertSame($this->helperBuilder, $this->helperBuilder->setSubscribers($subscribers));
        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertTrue($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertSame($subscribers, $this->helperBuilder->getSubscribers());
    }

    public function testAddSubscribers()
    {
        $this->assertSame(
            $this->helperBuilder,
            $this->helperBuilder->setSubscribers($firstSubscribers = [$this->createEventSubscriberMock()])
        );

        $this->assertSame(
            $this->helperBuilder,
            $this->helperBuilder->addSubscribers($secondSubscribers = [$this->createEventSubscriberMock()])
        );

        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertSame(array_merge($firstSubscribers, $secondSubscribers), $this->helperBuilder->getSubscribers());
    }

    public function testAddSubscriber()
    {
        $this->assertSame(
            $this->helperBuilder,
            $this->helperBuilder->addSubscriber($subscriber = $this->createEventSubscriberMock())
        );

        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertTrue($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertSame([$subscriber], $this->helperBuilder->getSubscribers());
    }

    public function testRemoveSubscriber()
    {
        $this->assertSame(
            $this->helperBuilder,
            $this->helperBuilder->addSubscriber($subscriber = $this->createEventSubscriberMock())
        );

        $this->assertSame($this->helperBuilder, $this->helperBuilder->removeSubscriber($subscriber));
        $this->assertFalse($this->helperBuilder->hasSubscribers());
        $this->assertFalse($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertEmpty($this->helperBuilder->getSubscribers());
    }

    /**
     * @return MockObject|AbstractHelperBuilder
     */
    private function createAbstractHelperBuilder()
    {
        return $this->getMockForAbstractClass(AbstractHelperBuilder::class);
    }

    /**
     * @return MockObject|EventSubscriberInterface
     */
    private function createEventSubscriberMock()
    {
        return $this->createMock(EventSubscriberInterface::class);
    }
}
