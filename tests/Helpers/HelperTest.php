<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

/**
 * Helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\AbstractHelper */
    private $helper;

    /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $eventDispatcher;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = $this->createHelperMockBuilder()
            ->setConstructorArgs(array($this->eventDispatcher = $this->createSymfonyEventDispatcherMock()))
            ->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventDispatcher);
        unset($this->helper);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->eventDispatcher, $this->helper->getEventDispatcher());
    }

    public function testSetEventDispatcher()
    {
        $this->helper->setEventDispatcher($eventDispatcher = $this->createSymfonyEventDispatcherMock());

        $this->assertSame($eventDispatcher, $this->helper->getEventDispatcher());
    }
}
