<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

/**
 * Formatter subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FormatterSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber|\PHPUnit_Framework_MockObject_MockObject */
    private $formatterSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->formatterSubscriber = $this->createFormatterSubscriberMockBuilder()
            ->setConstructorArgs(array($this->formatter))
            ->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->formatterSubscriber);
    }

    public function testDefaultState()
    {
        $this->formatterSubscriber = $this->createFormatterSubscriberMock();

        $this->assertFormatterInstance($this->formatterSubscriber->getFormatter());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->formatterSubscriber->getFormatter());
    }

    public function testSetContainerFormatter()
    {
        $this->formatterSubscriber->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->formatterSubscriber->getFormatter());
    }
}
