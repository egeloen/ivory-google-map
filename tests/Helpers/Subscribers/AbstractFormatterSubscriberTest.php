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
 * Abstract container formatter subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFormatterSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Formatters\ContainerFormatter|\PHPUnit_Framework_MockObject_MockObject */
    protected $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formatter = $this->createFormatterMock();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->formatter);
    }
}
