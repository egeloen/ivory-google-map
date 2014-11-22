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
 * Abstract helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelperTest extends AbstractTestCase
{
    /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $eventDispatcher;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventDispatcher = $this->createSymfonyEventDispatcherMock();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventDispatcher);
    }
}
