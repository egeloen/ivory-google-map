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

use Ivory\GoogleMap\Helper\Builder\AbstractHelperBuilder;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractHelperBuilder
     */
    private $helperBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helperBuilder = $this->createAbstractHelperBuilder();
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(Formatter::class, $this->helperBuilder->getFormatter());
        $this->assertInstanceOf(JsonBuilder::class, $this->helperBuilder->getJsonBuilder());
        $this->assertFalse($this->helperBuilder->hasSubscribers());
        $this->assertEmpty($this->helperBuilder->getSubscribers());
    }

    public function testInitialState()
    {
        $this->helperBuilder = $this->createAbstractHelperBuilder(
            $formatter = $this->createFormatterMock(),
            $jsonBuilder = $this->createJsonBuilderMock()
        );

        $this->assertSame($formatter, $this->helperBuilder->getFormatter());
        $this->assertSame($jsonBuilder, $this->helperBuilder->getJsonBuilder());
        $this->assertFalse($this->helperBuilder->hasSubscribers());
        $this->assertEmpty($this->helperBuilder->getSubscribers());
    }

    public function testFormatter()
    {
        $this->helperBuilder->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->helperBuilder->getFormatter());
    }

    public function testJsonBuilder()
    {
        $this->helperBuilder->setJsonBuilder($jsonBuilder = $this->createJsonBuilderMock());

        $this->assertSame($jsonBuilder, $this->helperBuilder->getJsonBuilder());
    }

    public function testSetSubscribers()
    {
        $this->helperBuilder->setSubscribers($subscribers = [$subscriber = $this->createEventSubscriberMock()]);
        $this->helperBuilder->setSubscribers($subscribers);

        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertTrue($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertSame($subscribers, $this->helperBuilder->getSubscribers());
    }

    public function testAddSubscribers()
    {
        $this->helperBuilder->setSubscribers($firstSubscribers = [$this->createEventSubscriberMock()]);
        $this->helperBuilder->addSubscribers($secondSubscribers = [$this->createEventSubscriberMock()]);

        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertSame(array_merge($firstSubscribers, $secondSubscribers), $this->helperBuilder->getSubscribers());
    }

    public function testAddSubscriber()
    {
        $this->helperBuilder->addSubscriber($subscriber = $this->createEventSubscriberMock());

        $this->assertTrue($this->helperBuilder->hasSubscribers());
        $this->assertTrue($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertSame([$subscriber], $this->helperBuilder->getSubscribers());
    }

    public function testRemoveSubscriber()
    {
        $this->helperBuilder->addSubscriber($subscriber = $this->createEventSubscriberMock());
        $this->helperBuilder->removeSubscriber($subscriber);

        $this->assertFalse($this->helperBuilder->hasSubscribers());
        $this->assertFalse($this->helperBuilder->hasSubscriber($subscriber));
        $this->assertEmpty($this->helperBuilder->getSubscribers());
    }

    /**
     * @param Formatter|null   $formatter
     * @param JsonBuilder|null $jsonBuilder
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractHelperBuilder
     */
    private function createAbstractHelperBuilder(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        return $this->getMockBuilder(AbstractHelperBuilder::class)
            ->setConstructorArgs([$formatter, $jsonBuilder])
            ->getMockForAbstractClass();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Formatter
     */
    private function createFormatterMock()
    {
        return $this->createMock(Formatter::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|JsonBuilder
     */
    private function createJsonBuilderMock()
    {
        return $this->createMock(JsonBuilder::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EventSubscriberInterface
     */
    private function createEventSubscriberMock()
    {
        return $this->createMock(EventSubscriberInterface::class);
    }
}
