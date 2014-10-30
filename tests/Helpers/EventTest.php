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
 * Event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\AbstractEvent */
    private $event;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->event = $this->createHelperEventMock();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->event);
    }

    public function testInheritance()
    {
        $this->assertSymfonyEventInstance($this->event);
    }

    public function testDefaultState()
    {
        $this->assertNull($this->event->getCode());
    }

    public function testAddCode()
    {
        $this->event->addCode($code1 = 'code1');
        $this->event->addCode($code2 = 'code2');

        $this->assertSame($code1.$code2, $this->event->getCode());
    }

    public function testSetCode()
    {
        $this->event->addCode('code1');
        $this->event->setCode($code = 'code2');

        $this->assertSame($code, $this->event->getCode());
    }
}
